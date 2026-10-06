# Catering Pro - Laravel 12

## Local setup

1. Create a MySQL database named `catering_pro` in XAMPP/phpMyAdmin.
2. Copy `.env.example` to `.env` and set your DB credentials.
3. From the project folder run:

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan optimize:clear
php artisan serve
```

Open: `http://127.0.0.1:8000`

### Admin
`http://127.0.0.1:8000/admin/login`

Seeded admin:
- Email: `admin@catering.test`
- Password: `password`

### Customer
`http://127.0.0.1:8000/login`

Seeded customer:
- Email: `customer@catering.test`
- Password: `password`

## Website CMS

Admin can manage:
- Multiple homepage hero banners (desktop/mobile image, headline, subtitle, buttons, order, publish/hide)
- Website logo and About image
- Services and service images
- Foods/menu and food images
- Packages and package images
- Gallery images/videos and replacements
- Testimonials and profile images
- YouTube/Vimeo videos
- Contact, WhatsApp and social links
- Homepage fallback copy
- Bookings, calendar, food tasting requests, enquiries and customers

## After adding the new Hero Banner migration to an existing installation

Run:

```bash
php artisan migrate
php artisan storage:link
php artisan optimize:clear
```

If you want the demo records on an existing database, run `php artisan db:seed`.
