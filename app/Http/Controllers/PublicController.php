<?php
namespace App\Http\Controllers;

use App\Models\{Service, FoodCategory, Package, Gallery, Video, Testimonial, AdditionalService, WebsiteSetting, HeroBanner};

class PublicController extends Controller
{
    public function home()
    {
        return view('home', ['banners' => HeroBanner::where('status', 1)->orderBy('sort_order')->get(), 'services' => Service::where('status', 1)->orderBy('sort_order')->get(), 'packages' => Package::where('status', 1)->latest()->take(3)->get(), 'gallery' => Gallery::where('status', 1)->orderBy('sort_order')->take(8)->get(), 'testimonials' => Testimonial::where('status', 1)->orderBy('sort_order')->take(6)->get()]);
    }

    public function services()
    {
        return view('public.services', ['services' => Service::where('status', 1)->orderBy('sort_order')->get()]);
    }

    public function service(string $slug)
    {
        return view('public.service', ['service' => Service::where('slug', $slug)->where('status', 1)->firstOrFail()]);
    }

    public function menu()
    {
        return view('public.menu', ['categories' => FoodCategory::with(['foods' => fn($q) => $q->where('status', 1)->orderBy('sort_order')])->where('status', 1)->orderBy('sort_order')->get()]);
    }

    public function packages()
    {
        return view('public.packages', ['packages' => Package::where('status', 1)->with('foods')->get()]);
    }

    public function gallery()
    {
        return view('public.gallery', ['gallery' => Gallery::where('status', 1)->orderBy('sort_order')->get(), 'videos' => Video::where('status', 1)->orderBy('sort_order')->get()]);
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }
}
