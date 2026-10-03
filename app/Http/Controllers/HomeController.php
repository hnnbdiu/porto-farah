<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = ProfileSetting::first() ?? new ProfileSetting();
        $projects = Project::where('is_published', true)->latest()->get();
        $skills = Skill::orderBy('sort_order')->get();
        $achievements = Achievement::latest()->get();
        $artworks = \App\Models\Artwork::where('is_published', true)->orderBy('sort_order')->latest()->get();

        return view('home', compact('profile', 'projects', 'skills', 'achievements', 'artworks'));
    }

    public function storeMessage(Request $request)
    {
        // Rate limiting: 5 requests per hour per IP
        $key = 'contact_form_' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['error' => 'Terlalu banyak percobaan. Silakan coba lagi nanti.'], 429);
        }

        // Honeypot check
        if ($request->filled('website_url')) {
            // Spambot filled the hidden honeypot field
            return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim!']);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:150',
                'message' => 'required|string|max:5000',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 100 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email maksimal 150 karakter.',
                'message.required' => 'Pesan wajib diisi.',
                'message.max' => 'Pesan maksimal 5000 karakter.',
            ]);

            \App\Models\Message::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'body' => $validated['message'],
            ]);

            \Illuminate\Support\Facades\RateLimiter::hit($key, 3600);

            return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim, terima kasih!']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact form error: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti.'], 500);
        }
    }

    public function viewCv()
    {
        $setting = \App\Models\ProfileSetting::first();
        if (!$setting || !$setting->cv_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($setting->cv_path)) {
            abort(404, 'CV tidak ditemukan.');
        }

        $path = \Illuminate\Support\Facades\Storage::disk('public')->path($setting->cv_path);
        
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="CV_Farah_Raihanun_Badiu.pdf"',
            'X-Frame-Options' => 'SAMEORIGIN'
        ]);
    }

    public function downloadCv()
    {
        $setting = \App\Models\ProfileSetting::first();
        if (!$setting || !$setting->cv_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($setting->cv_path)) {
            abort(404, 'CV tidak ditemukan.');
        }

        $path = \Illuminate\Support\Facades\Storage::disk('public')->path($setting->cv_path);
        return response()->download($path, 'CV_Farah_Raihanun_Badiu.pdf', [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
