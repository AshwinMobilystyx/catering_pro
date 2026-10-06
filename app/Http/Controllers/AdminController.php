<?php

namespace App\Http\Controllers;

use App\Models\{User, Booking, FoodTastingRequest, Enquiry, Service, Food, Package, Gallery, Video, Testimonial, WebsiteSetting, FoodCategory, HeroBanner};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'customers' => User::where('role', 'customer')->count(),
                'bookings' => Booking::count(),
                'pending' => Booking::where('status', 'pending')->count(),
                'confirmed' => Booking::where('status', 'confirmed')->count(),
                'tastings' => FoodTastingRequest::where('status', 'pending')->count(),
                'enquiries' => Enquiry::where('status', 'new')->count(),
                'foods' => Food::count(),
                'services' => Service::count(),
            ],
            'bookings' => Booking::with('user')->latest()->take(10)->get(),
        ]);
    }

    public function bookings(Request $request): View
    {
        $query = Booking::with(['user', 'package'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date('date'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q
                    ->where('booking_no', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($user) => $user
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%"));
            });
        }

        return view('admin.bookings', ['bookings' => $query->paginate(15)->withQueryString()]);
    }

    public function updateBooking(Request $request, Booking $booking): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['pending', 'contacted', 'quotation_sent', 'confirmed', 'in_progress', 'completed', 'cancelled', 'rejected'])],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $booking->update($data);
        $booking->statusHistory()->create(['status' => $data['status'], 'note' => $data['admin_notes'] ?? null]);

        return $this->successResponse($request, 'Booking updated successfully.');
    }

    public function tastings(): View
    {
        return view('admin.tastings', ['items' => FoodTastingRequest::with('user')->latest()->paginate(15)]);
    }

    public function updateTasting(Request $request, FoodTastingRequest $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['pending', 'confirmed', 'rescheduled', 'completed', 'cancelled'])],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $item->update($data);
        return $this->successResponse($request, 'Tasting request updated successfully.');
    }

    public function enquiries(): View
    {
        return view('admin.enquiries', ['items' => Enquiry::latest()->paginate(15)]);
    }

    public function updateEnquiry(Request $request, Enquiry $enquiry): RedirectResponse|JsonResponse
    {
        $enquiry->update($request->validate([
            'status' => ['required', Rule::in(['new', 'read', 'replied'])],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]));

        return $this->successResponse($request, 'Enquiry updated successfully.');
    }

    public function customers(): View
    {
        return view('admin.customers', ['customers' => User::where('role', 'customer')->latest()->paginate(15)]);
    }

    public function settings(): View
    {
        return view('admin.settings', ['settings' => WebsiteSetting::pluck('value', 'key')]);
    }

    public function updateSettings(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'business_name' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'address' => ['nullable', 'string', 'max:500'],
            'about' => ['nullable', 'string', 'max:5000'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'about_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($data as $key => $value) {
            if (!in_array($key, ['logo', 'about_image'], true)) {
                WebsiteSetting::set($key, $value);
            }
        }

        foreach (['logo', 'about_image'] as $key) {
            if ($request->hasFile($key)) {
                $old = WebsiteSetting::get($key);
                $this->deletePublicFile($old);
                WebsiteSetting::set($key, $request->file($key)->store('website', 'public'));
            }
        }

        return $this->successResponse($request, 'Website settings saved successfully.');
    }

    public function calendar(): View
    {
        return view('admin.calendar', [
            'bookings' => Booking::with('user')
                ->whereBetween('event_date', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
                ->get(),
        ]);
    }

    public function banners(): View
    {
        return view('admin.crud.banners', ['items' => HeroBanner::orderBy('sort_order')->paginate(12)]);
    }

    public function bannerStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->bannerRules(true));
        $data['image'] = $this->storePublicFile($request, 'image', 'banners');
        $data['mobile_image'] = $this->storePublicFile($request, 'mobile_image', 'banners/mobile');
        $data['status'] = $request->boolean('status');

        HeroBanner::create($data);
        return $this->successResponse($request, 'Hero banner added successfully.');
    }

    public function bannerUpdate(Request $request, HeroBanner $banner): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->bannerRules(false));
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $this->deletePublicFile($banner->image);
            $data['image'] = $this->storePublicFile($request, 'image', 'banners');
        }
        if ($request->hasFile('mobile_image')) {
            $this->deletePublicFile($banner->mobile_image);
            $data['mobile_image'] = $this->storePublicFile($request, 'mobile_image', 'banners/mobile');
        }

        $banner->update($data);
        return $this->successResponse($request, 'Hero banner updated successfully.');
    }

    public function bannerDelete(Request $request, HeroBanner $banner): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($banner->image);
        $this->deletePublicFile($banner->mobile_image);
        $banner->delete();

        return $this->successResponse($request, 'Hero banner deleted successfully.');
    }

    public function services(): View
    {
        return view('admin.crud.services', ['items' => Service::orderBy('sort_order')->paginate(15)]);
    }

    public function serviceStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->serviceRules());
        $data['slug'] = $this->uniqueSlug(Service::class, $data['name']);
        $data['image'] = $this->storePublicFile($request, 'image', 'services');
        $data['status'] = $request->boolean('status', true);

        Service::create($data);
        return $this->successResponse($request, 'Service created successfully.');
    }

    public function serviceUpdate(Request $request, Service $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->serviceRules($item->id));
        $data['slug'] = $this->uniqueSlug(Service::class, $data['name'], $item->id);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $this->deletePublicFile($item->image);
            $data['image'] = $this->storePublicFile($request, 'image', 'services');
        }

        $item->update($data);
        return $this->successResponse($request, 'Service updated successfully.');
    }

    public function serviceDelete(Request $request, Service $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->image);
        $item->delete();
        return $this->successResponse($request, 'Service deleted successfully.');
    }

    public function categories(): View
    {
        return view('admin.crud.categories', ['items' => FoodCategory::orderBy('sort_order')->paginate(15)]);
    }

    public function categoryStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100'], 'description' => ['nullable', 'string', 'max:1000']]);
        $data['slug'] = $this->uniqueSlug(FoodCategory::class, $data['name']);
        FoodCategory::create($data);
        return $this->successResponse($request, 'Category created successfully.');
    }

    public function categoryDelete(Request $request, FoodCategory $item): RedirectResponse|JsonResponse
    {
        $item->delete();
        return $this->successResponse($request, 'Category deleted successfully.');
    }

    public function foods(): View
    {
        return view('admin.crud.foods', ['items' => Food::with('category')->latest()->paginate(15), 'categories' => FoodCategory::where('status', 1)->get()]);
    }

    public function foodStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->foodRules());
        $data['slug'] = $this->uniqueSlug(Food::class, $data['name']);
        $data['image'] = $this->storePublicFile($request, 'image', 'foods');
        $data['is_jain'] = $request->boolean('is_jain');
        $data['status'] = $request->boolean('status', true);

        Food::create($data);
        return $this->successResponse($request, 'Food item created successfully.');
    }

    public function foodUpdate(Request $request, Food $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->foodRules($item->id));
        $data['slug'] = $this->uniqueSlug(Food::class, $data['name'], $item->id);
        $data['is_jain'] = $request->boolean('is_jain');
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $this->deletePublicFile($item->image);
            $data['image'] = $this->storePublicFile($request, 'image', 'foods');
        }

        $item->update($data);
        return $this->successResponse($request, 'Food item updated successfully.');
    }

    public function foodDelete(Request $request, Food $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->image);
        $item->delete();
        return $this->successResponse($request, 'Food item deleted successfully.');
    }

    public function packages(): View
    {
        return view('admin.crud.packages', ['items' => Package::latest()->paginate(15), 'foods' => Food::where('status', 1)->get()]);
    }

    public function packageStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->packageRules());
        $data['slug'] = $this->uniqueSlug(Package::class, $data['name']);
        $data['image'] = $this->storePublicFile($request, 'image', 'packages');
        $data['status'] = $request->boolean('status', true);
        $package = Package::create($data);
        $package->foods()->sync($request->input('food_ids', []));

        return $this->successResponse($request, 'Package created successfully.');
    }

    public function packageUpdate(Request $request, Package $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->packageRules($item->id));
        $data['slug'] = $this->uniqueSlug(Package::class, $data['name'], $item->id);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            $this->deletePublicFile($item->image);
            $data['image'] = $this->storePublicFile($request, 'image', 'packages');
        }

        $item->update($data);
        $item->foods()->sync($request->input('food_ids', []));
        return $this->successResponse($request, 'Package updated successfully.');
    }

    public function packageDelete(Request $request, Package $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->image);
        $item->delete();
        return $this->successResponse($request, 'Package deleted successfully.');
    }

    public function testimonials(): View
    {
        return view('admin.crud.testimonials', ['items' => Testimonial::latest()->paginate(15)]);
    }

    public function testimonialStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->testimonialRules());
        $data['image'] = $this->storePublicFile($request, 'image', 'testimonials');
        $data['status'] = $request->boolean('status', true);
        Testimonial::create($data);
        return $this->successResponse($request, 'Testimonial added successfully.');
    }

    public function testimonialUpdate(Request $request, Testimonial $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->testimonialRules());
        $data['status'] = $request->boolean('status');
        if ($request->hasFile('image')) {
            $this->deletePublicFile($item->image);
            $data['image'] = $this->storePublicFile($request, 'image', 'testimonials');
        }
        $item->update($data);
        return $this->successResponse($request, 'Testimonial updated successfully.');
    }

    public function testimonialDelete(Request $request, Testimonial $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->image);
        $item->delete();
        return $this->successResponse($request, 'Testimonial deleted successfully.');
    }

    public function gallery(): View
    {
        return view('admin.crud.gallery', ['items' => Gallery::latest()->paginate(15)]);
    }

    public function galleryStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->galleryRules(true));
        $file = $request->file('file');
        $data['type'] = str_starts_with((string) $file->getMimeType(), 'video/') ? 'video' : 'image';
        $data['file_path'] = $file->store('gallery', 'public');
        $data['status'] = $request->boolean('status', true);
        Gallery::create($data);
        return $this->successResponse($request, 'Gallery media uploaded successfully.');
    }

    public function galleryUpdate(Request $request, Gallery $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->galleryRules(false));
        $data['status'] = $request->boolean('status');
        if ($request->hasFile('file')) {
            $this->deletePublicFile($item->file_path);
            $data['file_path'] = $request->file('file')->store('gallery', 'public');
            $data['type'] = str_starts_with((string) $request->file('file')->getMimeType(), 'video/') ? 'video' : 'image';
        }
        $item->update($data);
        return $this->successResponse($request, 'Gallery media updated successfully.');
    }

    public function galleryDelete(Request $request, Gallery $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->file_path);
        $item->delete();
        return $this->successResponse($request, 'Gallery media deleted successfully.');
    }

    public function videos(): View
    {
        return view('admin.crud.videos', ['items' => Video::latest()->paginate(15)]);
    }

    public function videoStore(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->videoRules(true));
        $data['video_path'] = $this->storePublicFile($request, 'video_file', 'videos');
        $data['thumbnail'] = $this->storePublicFile($request, 'thumbnail', 'videos/thumbnails');
        $data['status'] = $request->boolean('status', true);
        Video::create($data);
        return $this->successResponse($request, 'Video added successfully.');
    }

    public function videoUpdate(Request $request, Video $item): RedirectResponse|JsonResponse
    {
        $data = $request->validate($this->videoRules(false));
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('video_file')) {
            $this->deletePublicFile($item->video_path);
            $data['video_path'] = $this->storePublicFile($request, 'video_file', 'videos');
        }
        if ($request->hasFile('thumbnail')) {
            $this->deletePublicFile($item->thumbnail);
            $data['thumbnail'] = $this->storePublicFile($request, 'thumbnail', 'videos/thumbnails');
        }

        $item->update($data);
        return $this->successResponse($request, 'Video updated successfully.');
    }

    public function videoDelete(Request $request, Video $item): RedirectResponse|JsonResponse
    {
        $this->deletePublicFile($item->video_path);
        $this->deletePublicFile($item->thumbnail);
        $item->delete();
        return $this->successResponse($request, 'Video deleted successfully.');
    }

    private function bannerRules(bool $requiredImage): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'subtitle' => ['nullable', 'string', 'max:500'],
            'button_text' => ['nullable', 'string', 'max:50'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:50'],
            'secondary_button_url' => ['nullable', 'string', 'max:255'],
            'image' => [$requiredImage ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'mobile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function serviceRules(?int $ignoreId = null): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'price_from' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function foodRules(?int $ignoreId = null): array
    {
        return [
            'category_id' => ['required', 'exists:food_categories,id'],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:3000'],
            'diet_type' => ['required', Rule::in(['veg', 'non_veg', 'mixed'])],
            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'is_jain' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function packageRules(?int $ignoreId = null): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:3000'],
            'price_per_person' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'min_guests' => ['nullable', 'integer', 'min:1', 'max:100000'],
            'max_guests' => ['nullable', 'integer', 'gte:min_guests', 'max:100000'],
            'terms' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'food_ids' => ['nullable', 'array'],
            'food_ids.*' => ['integer', 'exists:foods,id'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function testimonialRules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:120'],
            'designation' => ['nullable', 'string', 'max:120'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'testimonial' => ['required', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function galleryRules(bool $requiredFile): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'category' => ['nullable', 'string', 'max:100'],
            'file' => [$requiredFile ? 'required' : 'nullable', 'file', 'mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime', 'max:51200'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function videoRules(bool $requiredFile): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'video_url' => ['nullable', 'url', 'max:1000'],
            'video_file' => [
                $requiredFile ? 'required_without:video_url' : 'nullable',
                'file',
                'mimetypes:video/mp4,video/webm,video/quicktime',
                'max:51200',
            ],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'status' => ['nullable', 'boolean'],
        ];
    }

    private function storePublicFile(Request $request, string $field, string $directory): ?string
    {
        return $request->hasFile($field) ? $request->file($field)->store($directory, 'public') : null;
    }

    private function deletePublicFile(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function uniqueSlug(string $model, string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 2;

        while ($model::query()->when($ignoreId, fn($q) => $q->whereKey('!=', $ignoreId))->where('slug', $slug)->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function successResponse(Request $request, string $message): RedirectResponse|JsonResponse
    {
        session()->flash('success', $message);
        session()->put('admin_last_action_at', now()->toIso8601String());

        $lastPageCookie = cookie('admin_last_page', url()->previous() ?: route('admin.dashboard'), 60 * 24 * 30);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message])->withCookie($lastPageCookie);
        }

        return back()->withCookie($lastPageCookie);
    }
}
