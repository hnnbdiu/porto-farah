<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileSetting;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = ProfileSetting::first() ?? new ProfileSetting();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        $data = $request->validated();
        $setting = ProfileSetting::first() ?? new ProfileSetting();

        if ($request->hasFile('foto')) {
            if ($setting->foto && !Str::startsWith($setting->foto, 'http')) {
                Storage::disk('public')->delete($setting->foto);
            }
            $file = $request->file('foto');
            $imagePath = $file->getRealPath();
            $info = @getimagesize($imagePath);
            
            if ($info !== false) {
                $mime = $info['mime'];
                $source = null;
                
                if ($mime == 'image/jpeg') $source = @imagecreatefromjpeg($imagePath);
                elseif ($mime == 'image/png') $source = @imagecreatefrompng($imagePath);
                elseif ($mime == 'image/webp') $source = @imagecreatefromwebp($imagePath);
                
                if ($source) {
                    // Fix EXIF orientation for JPEG
                    if ($mime == 'image/jpeg' && function_exists('exif_read_data')) {
                        $exif = @exif_read_data($imagePath);
                        if (!empty($exif['Orientation'])) {
                            switch ($exif['Orientation']) {
                                case 3: $source = imagerotate($source, 180, 0); break;
                                case 6: $source = imagerotate($source, -90, 0); break;
                                case 8: $source = imagerotate($source, 90, 0); break;
                            }
                        }
                    }
                    
                    $width = imagesx($source);
                    $height = imagesy($source);
                    $maxWidth = 1000;
                    
                    if ($width > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = floor($height * ($maxWidth / $width));
                        $newImage = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($newImage, false);
                        imagesavealpha($newImage, true);
                        $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                        imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
                        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagedestroy($source);
                        $source = $newImage;
                    }
                    
                    $filename = Str::random(40) . '.webp';
                    $relativePath = 'settings/' . $filename;
                    $absolutePath = storage_path('app/public/' . $relativePath);
                    
                    if (!file_exists(dirname($absolutePath))) {
                        mkdir(dirname($absolutePath), 0755, true);
                    }
                    
                    imagewebp($source, $absolutePath, 90);
                    imagedestroy($source);
                    $data['foto'] = $relativePath;
                } else {
                    $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                    $data['foto'] = $file->storeAs('settings', $filename, 'public');
                }
            } else {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $data['foto'] = $file->storeAs('settings', $filename, 'public');
            }
        }

        if ($request->hasFile('cv')) {
            if ($setting->cv_path) {
                Storage::disk('public')->delete($setting->cv_path);
            }
            $file = $request->file('cv');
            $filename = 'cv_' . time() . '.pdf';
            $path = $file->storeAs('cv', $filename, 'public');
            $data['cv_path'] = $path;
        }

        // Fill existing values if not updated
        if (!isset($data['foto'])) $data['foto'] = $setting->foto;
        if (!isset($data['cv_path'])) $data['cv_path'] = $setting->cv_path;

        if ($setting->exists) {
            $setting->update($data);
        } else {
            ProfileSetting::create($data);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Pengaturan profil berhasil diperbarui.');
    }
}
