<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;

class PremiumSiteController extends Controller
{
    private function items(string $type)
    {
        return ContentItem::query()
            ->where('type', $type)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();
    }

    public function home()
    {
        $services = $this->items('service');
        $projects = $this->items('project');
        $testimonials = $this->items('testimonial');
        $plans = $this->items('plan');
        $faqs = $this->items('faq');
        $posts = $this->items('post')->take(3);

        return view('premium.home', compact('services', 'projects', 'testimonials', 'plans', 'faqs', 'posts'));
    }

    public function about()
    {
        return view('premium.about');
    }

    public function services()
    {
        $services = $this->items('service');
        return view('premium.services', compact('services'));
    }

    public function portfolio()
    {
        $projects = $this->items('project');
        return view('premium.portfolio', compact('projects'));
    }

    public function testimonials()
    {
        $testimonials = $this->items('testimonial');
        return view('premium.testimonials', compact('testimonials'));
    }

    public function pricing()
    {
        $plans = $this->items('plan');
        return view('premium.pricing', compact('plans'));
    }

    public function faq()
    {
        $faqs = $this->items('faq');
        return view('premium.faq', compact('faqs'));
    }

    public function blog()
    {
        $posts = $this->items('post');
        return view('premium.blog', compact('posts'));
    }

    public function contact()
    {
        return view('premium.contact');
    }
}

