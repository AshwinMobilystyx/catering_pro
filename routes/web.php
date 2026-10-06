<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PublicController,AuthController,CustomerController,EnquiryController,AdminController};

Route::get('/',[PublicController::class,'home'])->name('home');
Route::get('/about',[PublicController::class,'about'])->name('about');
Route::get('/services',[PublicController::class,'services'])->name('services');
Route::get('/services/{slug}',[PublicController::class,'service'])->name('services.show');
Route::get('/menu',[PublicController::class,'menu'])->name('menu');
Route::get('/packages',[PublicController::class,'packages'])->name('packages');
Route::get('/gallery',[PublicController::class,'gallery'])->name('gallery');
Route::get('/contact',[PublicController::class,'contact'])->name('contact');
Route::post('/contact',[EnquiryController::class,'store'])->name('contact.store');

Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'registerForm'])->name('register');
Route::post('/register',[AuthController::class,'register']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::prefix('customer')->middleware('customer')->group(function(){
 Route::get('/dashboard',[CustomerController::class,'dashboard'])->name('customer.dashboard');
 Route::get('/bookings',[CustomerController::class,'bookings'])->name('customer.bookings');
 Route::get('/bookings/create',[CustomerController::class,'createBooking'])->name('customer.bookings.create');
 Route::post('/bookings',[CustomerController::class,'storeBooking'])->name('customer.bookings.store');
 Route::get('/bookings/{booking}',[CustomerController::class,'showBooking'])->name('customer.bookings.show');
 Route::get('/food-tasting',[CustomerController::class,'tastingForm'])->name('customer.tasting.create');
 Route::post('/food-tasting',[CustomerController::class,'storeTasting'])->name('customer.tasting.store');
 Route::get('/food-tastings',[CustomerController::class,'tastings'])->name('customer.tastings');
 Route::get('/profile',[CustomerController::class,'profile'])->name('customer.profile');
 Route::post('/profile',[CustomerController::class,'updateProfile'])->name('customer.profile.update');
});

Route::get('/admin/login',[AuthController::class,'adminLoginForm'])->name('admin.login');
Route::post('/admin/login',[AuthController::class,'adminLogin']);
Route::post('/admin/logout',[AuthController::class,'adminLogout'])->name('admin.logout');

Route::prefix('admin')->middleware('admin')->group(function(){
 Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
 Route::get('/bookings',[AdminController::class,'bookings'])->name('admin.bookings');
 Route::post('/bookings/{booking}',[AdminController::class,'updateBooking'])->name('admin.bookings.update');
 Route::get('/calendar',[AdminController::class,'calendar'])->name('admin.calendar');
 Route::get('/food-tastings',[AdminController::class,'tastings'])->name('admin.tastings');
 Route::post('/food-tastings/{item}',[AdminController::class,'updateTasting'])->name('admin.tastings.update');
 Route::get('/enquiries',[AdminController::class,'enquiries'])->name('admin.enquiries');
 Route::post('/enquiries/{enquiry}',[AdminController::class,'updateEnquiry'])->name('admin.enquiries.update');
 Route::get('/customers',[AdminController::class,'customers'])->name('admin.customers');
 Route::get('/settings',[AdminController::class,'settings'])->name('admin.settings');
 Route::post('/settings',[AdminController::class,'updateSettings'])->name('admin.settings.update');

 Route::get('/banners',[AdminController::class,'banners'])->name('admin.banners');
 Route::post('/banners',[AdminController::class,'bannerStore']);
 Route::post('/banners/{banner}',[AdminController::class,'bannerUpdate'])->name('admin.banners.update');
 Route::delete('/banners/{banner}',[AdminController::class,'bannerDelete'])->name('admin.banners.delete');
 Route::get('/services',[AdminController::class,'services'])->name('admin.services');
 Route::post('/services',[AdminController::class,'serviceStore']);
 Route::post('/services/{item}',[AdminController::class,'serviceUpdate'])->name('admin.services.update');
 Route::delete('/services/{item}',[AdminController::class,'serviceDelete']);
 Route::get('/categories',[AdminController::class,'categories'])->name('admin.categories');
 Route::post('/categories',[AdminController::class,'categoryStore']);
 Route::delete('/categories/{item}',[AdminController::class,'categoryDelete']);
 Route::get('/foods',[AdminController::class,'foods'])->name('admin.foods');
 Route::post('/foods',[AdminController::class,'foodStore']);
 Route::post('/foods/{item}',[AdminController::class,'foodUpdate'])->name('admin.foods.update');
 Route::delete('/foods/{item}',[AdminController::class,'foodDelete']);
 Route::get('/packages',[AdminController::class,'packages'])->name('admin.packages');
 Route::post('/packages',[AdminController::class,'packageStore']);
 Route::post('/packages/{item}',[AdminController::class,'packageUpdate'])->name('admin.packages.update');
 Route::delete('/packages/{item}',[AdminController::class,'packageDelete']);
 Route::get('/gallery',[AdminController::class,'gallery'])->name('admin.gallery');
 Route::post('/gallery',[AdminController::class,'galleryStore']);
 Route::post('/gallery/{item}',[AdminController::class,'galleryUpdate'])->name('admin.gallery.update');
 Route::delete('/gallery/{item}',[AdminController::class,'galleryDelete']);
 Route::get('/videos',[AdminController::class,'videos'])->name('admin.videos');
 Route::post('/videos',[AdminController::class,'videoStore'])->name('admin.videos.store');
 Route::post('/videos/{item}',[AdminController::class,'videoUpdate'])->name('admin.videos.update');
 Route::delete('/videos/{item}',[AdminController::class,'videoDelete'])->name('admin.videos.delete');
 Route::get('/testimonials',[AdminController::class,'testimonials'])->name('admin.testimonials');
 Route::post('/testimonials',[AdminController::class,'testimonialStore']);
 Route::post('/testimonials/{item}',[AdminController::class,'testimonialUpdate'])->name('admin.testimonials.update');
 Route::delete('/testimonials/{item}',[AdminController::class,'testimonialDelete']);
});
