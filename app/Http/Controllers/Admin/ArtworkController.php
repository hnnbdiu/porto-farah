<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Http\Requests\Admin\ArtworkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::orderBy('sort_order')->latest()->paginate(24);
        return view('admin.artworks.index', compact('artworks'));
    }

    public function create()
    {
        return view('admin.artworks.create');
    }

    public function store(ArtworkRequest $request)
    {
        $images = $request->file('images');
        $titles = $request->input('titles', []);
        $descriptions = $request->input('descriptions', []);
        $category = $request->input('category');
        
        ini_set('memory_limit', '512M');
        $manager = new ImageManager(new Driver());

        foreach ($images as $index => $image) {
            try {
                // Randomize name
                $filename = uniqid('art_') . '_' . time();

                // Save original
                $pathOriginal = 'originals/' . $filename . '.' . $image->getClientOriginalExtension();
                Storage::put($pathOriginal, file_get_contents($image));

                // Read image from file
                $img = $manager->read($image);
                
                $pathFull = 'artworks/' . $filename . '.webp';
                $pathThumb = 'artworks/thumb_' . $filename . '.webp';

                // Resize for full size (max width 2560)
                if ($img->width() > 2560) {
                    $img->scaleDown(width: 2560);
                }
                $fullData = $img->toWebp(90);
                Storage::disk('public')->put($pathFull, $fullData);
                unset($fullData);

                // Thumbnail (width 900)
                $imgThumb = $manager->read($image);
                if ($imgThumb->width() > 900) {
                    $imgThumb->scaleDown(width: 900);
                }
                $thumbData = $imgThumb->toWebp(85);
                Storage::disk('public')->put($pathThumb, $thumbData);
                
                unset($img);
                unset($imgThumb);
                unset($thumbData);
                gc_collect_cycles();

                $title = $titles[$index] ?? '';
                if (empty(trim($title))) {
                    // Get filename without extension, replace special chars with space, ucwords
                    $title = ucwords(str_replace(['_', '-'], ' ', pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)));
                    // truncate to 120 chars if needed
                    $title = substr($title, 0, 120);
                }

                Artwork::create([
                    'title' => $title,
                    'description' => $descriptions[$index] ?? null,
                    'category' => $category,
                    'image_path' => $pathFull,
                    'thumbnail_path' => $pathThumb,
                    'is_published' => true,
                    'sort_order' => Artwork::max('sort_order') + 1,
                ]);
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal memproses gambar ' . $image->getClientOriginalName() . '. Gambar mungkin terlalu besar atau memori tidak cukup.');
            }
        }

        return redirect()->route('admin.artworks.index')->with('success', count($images) . ' gambar berhasil diunggah.');
    }

    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.edit', compact('artwork'));
    }

    public function update(ArtworkRequest $request, Artwork $artwork)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            try {
                ini_set('memory_limit', '512M');
                $image = $request->file('image');
                
                $filename = uniqid('art_') . '_' . time();
                
                $pathOriginal = 'originals/' . $filename . '.' . $image->getClientOriginalExtension();
                Storage::put($pathOriginal, file_get_contents($image));

                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);
                
                $pathFull = 'artworks/' . $filename . '.webp';
                $pathThumb = 'artworks/thumb_' . $filename . '.webp';

                if ($img->width() > 2560) {
                    $img->scaleDown(width: 2560);
                }
                $fullData = $img->toWebp(90);
                Storage::disk('public')->put($pathFull, $fullData);
                unset($fullData);

                $imgThumb = $manager->read($image);
                if ($imgThumb->width() > 900) {
                    $imgThumb->scaleDown(width: 900);
                }
                $thumbData = $imgThumb->toWebp(85);
                Storage::disk('public')->put($pathThumb, $thumbData);
                
                unset($img);
                unset($imgThumb);
                unset($thumbData);
                gc_collect_cycles();
            } catch (\Throwable $e) {
                return back()->with('error', 'Gagal memproses gambar. Gambar mungkin terlalu besar atau memori tidak cukup.');
            }

            // Delete old images
            if ($artwork->image_path && Storage::disk('public')->exists($artwork->image_path)) {
                Storage::disk('public')->delete($artwork->image_path);
            }
            if ($artwork->thumbnail_path && Storage::disk('public')->exists($artwork->thumbnail_path)) {
                Storage::disk('public')->delete($artwork->thumbnail_path);
            }

            $data['image_path'] = $pathFull;
            $data['thumbnail_path'] = $pathThumb;
        }

        $artwork->update($data);
        return redirect()->route('admin.artworks.index')->with('success', 'Karya berhasil diperbarui.');
    }

    public function destroy(Artwork $artwork)
    {
        if ($artwork->image_path && Storage::disk('public')->exists($artwork->image_path)) {
            Storage::disk('public')->delete($artwork->image_path);
        }
        if ($artwork->thumbnail_path && Storage::disk('public')->exists($artwork->thumbnail_path)) {
            Storage::disk('public')->delete($artwork->thumbnail_path);
        }
        $artwork->delete();
        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $orders = $request->input('orders', []);
        foreach ($orders as $id => $order) {
            Artwork::where('id', $id)->update(['sort_order' => $order]);
        }
        return response()->json(['success' => true]);
    }
}
