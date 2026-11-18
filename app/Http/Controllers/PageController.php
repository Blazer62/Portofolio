<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\SiteProfile;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('portfolio', [
            'projects' => Project::orderBy('sort_order')->orderByDesc('id')->get(),
            'skills' => Skill::orderBy('sort_order')->get()->groupBy('type'),
            'educations' => Education::orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('sort_order')->get()->groupBy('type'),
            'certificates' => Certificate::orderByDesc('year')->orderBy('sort_order')->get(),
            'testimonials' => Testimonial::orderBy('sort_order')->orderByDesc('id')->get(),
            'posts' => Post::whereNotNull('published_at')->orderByDesc('published_at')->take(3)->get(),
        ]);
    }

    public function showProject(Project $project)
    {
        $related = Project::where('id', '!=', $project->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'related'));
    }

    public function blog()
    {
        return view('blog.index', [
            'posts' => Post::whereNotNull('published_at')->orderByDesc('published_at')->paginate(9),
        ]);
    }

    public function showPost(Post $post)
    {
        $related = Post::where('id', '!=', $post->id)
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'related'));
    }

    public function cv()
    {
        return view('cv', [
            'profile' => SiteProfile::first(),
            'skills' => Skill::orderBy('sort_order')->get()->groupBy('type'),
            'educations' => Education::orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('sort_order')->get()->groupBy('type'),
            'certificates' => Certificate::orderByDesc('year')->get(),
        ]);
    }
}
