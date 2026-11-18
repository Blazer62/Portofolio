<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'certificates' => Certificate::count(),
            'skills' => Skill::count(),
            'experiences' => Experience::count(),
            'testimonials' => Testimonial::count(),
            'posts' => Post::count(),
            'unread' => Message::where('is_read', false)->count(),
            'guestbook' => Message::guestbook()->count(),
        ];

        $messages = Message::latest()->take(6)->get();
        $projects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'messages', 'projects'));
    }
}
