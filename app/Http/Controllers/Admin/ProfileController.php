<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteProfile;
use App\Support\Media;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', [
            'profile' => SiteProfile::first() ?? new SiteProfile(),
        ]);
    }

    public function update(Request $request)
    {
        $profile = SiteProfile::first() ?? new SiteProfile();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'class' => 'nullable|string|max:50',
            'major' => 'nullable|string|max:150',
            'school' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'github' => 'nullable|string|max:500',
            'instagram' => 'nullable|string|max:500',
            'whatsapp' => 'nullable|string|max:500',
            'interests' => 'nullable|string',
            'career_goal' => 'nullable|string',
            'cv_summary' => 'nullable|string',
            'languages' => 'nullable|string',
            'photo_file' => 'nullable|image|max:4096',
            'cv_file' => 'nullable|file|mimes:pdf|max:8192',
        ]);

        unset($data['photo_file'], $data['cv_file']);

        if ($upload = Media::store($request->file('photo_file'))) {
            $data['photo'] = $upload;
        }

        if ($upload = Media::store($request->file('cv_file'))) {
            $data['cv_file'] = $upload;
        }

        $profile->fill($data)->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Informasi profil berhasil diperbarui.');
    }
}
