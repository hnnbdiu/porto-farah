<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Http\Requests\Admin\AchievementRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest('date')->paginate(10);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(AchievementRequest $request)
    {
        $data = $request->validated();
        
        if (empty($data['summary'])) {
            $data['summary'] = Str::limit(strip_tags($data['description']), 120);
        }

        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = [];
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            
            $filename = Str::random(20);
            $pathFull = 'achievements/' . $filename . '.webp';
            $pathThumb = 'achievements/thumb_' . $filename . '.webp';

            if ($img->width() > 1800) {
                $img->scaleDown(width: 1800);
            }
            Storage::disk('public')->put($pathFull, $img->toWebp(92));

            $imgThumb = $manager->read($file);
            if ($imgThumb->width() > 900) {
                $imgThumb->scaleDown(width: 900);
            }
            Storage::disk('public')->put($pathThumb, $imgThumb->toWebp(85));

            $data['image'] = $pathFull;
        }

        Achievement::create($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Pencapaian berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    public function update(AchievementRequest $request, Achievement $achievement)
    {
        $data = $request->validated();

        if (empty($data['summary'])) {
            $data['summary'] = Str::limit(strip_tags($data['description']), 120);
        }

        if (!empty($data['tags'])) {
            $data['tags'] = array_map('trim', explode(',', $data['tags']));
        } else {
            $data['tags'] = [];
        }

        if ($request->hasFile('image')) {
            if ($achievement->image && Storage::disk('public')->exists($achievement->image)) {
                Storage::disk('public')->delete($achievement->image);
            }
            $thumbPath = str_replace('achievements/', 'achievements/thumb_', $achievement->image);
            if ($thumbPath && Storage::disk('public')->exists($thumbPath)) {
                Storage::disk('public')->delete($thumbPath);
            }

            $file = $request->file('image');
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file);
            
            $filename = Str::random(20);
            $pathFull = 'achievements/' . $filename . '.webp';
            $pathThumb = 'achievements/thumb_' . $filename . '.webp';

            if ($img->width() > 1800) {
                $img->scaleDown(width: 1800);
            }
            Storage::disk('public')->put($pathFull, $img->toWebp(92));

            $imgThumb = $manager->read($file);
            if ($imgThumb->width() > 900) {
                $imgThumb->scaleDown(width: 900);
            }
            Storage::disk('public')->put($pathThumb, $imgThumb->toWebp(85));

            $data['image'] = $pathFull;
        }

        $achievement->update($data);

        return redirect()->route('admin.achievements.index')->with('success', 'Pencapaian berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->image && Storage::disk('public')->exists($achievement->image)) {
            Storage::disk('public')->delete($achievement->image);
        }
        $thumbPath = str_replace('achievements/', 'achievements/thumb_', $achievement->image);
        if ($thumbPath && Storage::disk('public')->exists($thumbPath)) {
            Storage::disk('public')->delete($thumbPath);
        }
        $achievement->delete();

        return redirect()->route('admin.achievements.index')->with('success', 'Pencapaian berhasil dihapus.');
    }
}
