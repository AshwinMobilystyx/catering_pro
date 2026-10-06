# Catering Pro — Laravel 12

A production-structured Laravel 12 catering website with a customer booking flow and an admin CMS.

## Included
- Premium responsive public homepage and content pages
- Admin-managed hero banners with desktop/mobile images
- Admin-managed services, food categories, menu items, packages, gallery and testimonials
- Video CMS supporting both uploaded MP4/WebM/MOV files and hosted URLs
- AJAX admin forms with CSRF protection and JSON validation responses
- SweetAlert toast/confirmation UI
- Field-level server validation feedback
- Back navigation with session/cookie fallback
- Session flash messages and admin activity timestamp
- Customer registration/login and booking flow
- Food tasting requests, enquiries, booking status and calendar
- Website settings, logo/about image and social/WhatsApp details
- Responsive admin sidebar and polished form/table UI

## Setup
1. Copy `.env.example` to `.env` and configure MySQL.
2. Run `composer install` only if the `vendor` directory is not already present.
3. Generate the application key:
   `php artisan key:generate`
4. Run migrations:
   `php artisan migrate`
5. Create the storage link:
   `php artisan storage:link`
6. Clear cached files:
   `php artisan optimize:clear`
7. Start the local server:
   `php artisan serve`

Do not use `php artisan migrate:fresh` on an existing database unless you intentionally want to delete its data.

## Video uploads
The video CMS accepts either a hosted URL or an uploaded MP4/WebM/MOV file. The application validates uploads at 50 MB and stores files on the public disk. `public/.user.ini` contains matching PHP upload limits for Apache/PHP environments that support per-directory INI settings.

If your PHP installation does not apply `.user.ini`, update `upload_max_filesize` and `post_max_size` in the active `php.ini` and restart Apache.
