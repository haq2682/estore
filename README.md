<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo">
</p>

<h1 align="center">eStore — Multi-Vendor E-Commerce Platform</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.3%20%7C%208.0-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-8.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License">
</p>

## Summary

**eStore** is a full-stack, multi-vendor e-commerce web application built on the Laravel 8 framework. It allows regular users to browse a shared product catalog, search and filter items, manage a shopping cart and wishlist, checkout, and track orders — while approved **sellers** get their own dashboard to list products, manage inventory, fulfil orders, and view sales analytics. New sellers are onboarded through an approval workflow where existing sellers review and grant seller-status requests. The app ships with role-based authorization, database-backed notifications, transactional emails, and a Bootstrap/jQuery storefront theme, and is intended as a learning/portfolio-grade reference implementation of a marketplace built the "Laravel way" (Eloquent ORM, Blade components, Gates, Notifications, Form Requests).

---

## Table of Contents

1. [About the Project](#about-the-project)
2. [Feature List](#feature-list)
3. [Tech Stack](#tech-stack)
4. [Minimum System Requirements](#minimum-system-requirements)
5. [Environment Setup](#environment-setup)
6. [Environment Variables](#environment-variables)
7. [Project / File Structure](#project--file-structure)
8. [Demo Video](#demo-video)
9. [Data Model Overview](#data-model-overview)
10. [Useful Artisan & NPM Commands](#useful-artisan--npm-commands)
11. [Notes for Contributors](#notes-for-contributors)
12. [License](#license)

---

## About the Project

eStore models a two-sided marketplace on top of a single Laravel application (no separate frontend/backend split — server-rendered Blade views styled with a Bootstrap-based storefront template).

There are two primary user experiences:

- **Buyers** — register/login (with mandatory e-mail verification), browse products by category, search, sort by name/price, view discounted items, read/write product comments, maintain a wishlist and cart, checkout with a shipping address and card details, receive an order confirmation e-mail, and track an order's status by order number.
- **Sellers** — any registered user can submit a request to become a seller; an existing seller reviews pending requests and grants the `seller` role. Once granted, the user unlocks a seller dashboard (protected by a `seller-dashboard` Gate) to create/edit/delete their own products, view and update the status of orders placed against their products, see a "sold items" list, and view month-by-month sales figures (quantity + revenue) rendered from the `sales` table using Carbon date ranges. Sellers also receive in-app (database) notifications when a product is ordered or commented on.

Authorization is role-based: `roles` and `users` are linked through a `role_user` pivot table, and a single `seller-dashboard` Gate (`app/Providers/AuthServiceProvider.php`) checks `User::userHasRole('seller')` to protect every seller-only route.

## Feature List

**Storefront / Buyer**
- Home page with recently added, best-selling, and discounted products
- Category browsing with pagination and sorting (name, price low→high, price high→low)
- Full-text style product search (`LIKE` query on product name)
- Product detail page with image gallery, overview, category-based recommendations, and comments/reviews
- Wishlist (add/remove per product)
- Shopping cart (add, remove, increment/decrement quantity, running subtotal)
- Checkout flow capturing shipping address and payment details, with server-side validation
- Automatic, unique order number generation per checkout
- Order tracking by order number with live order status
- Static content pages: FAQ, Shipping, Returns, Policies, Contact (with e-mail delivery)

**Authentication & Account**
- Registration, login, logout, password reset/confirmation, and mandatory e-mail verification (Laravel UI + Laravel's built-in `Auth::routes(['verify' => true])`)
- User profile management: update info, avatar, password, and shipping address

**Seller**
- Seller-request workflow (request → review → grant/deny by an existing seller)
- Seller dashboard with monthly sales chart data (units sold & revenue per month)
- Product CRUD (create/edit/delete) with multi-image upload and validation
- Order management: view incoming orders, update order status, view fulfilled ("sold") items
- In-app database notifications for new orders and new product comments, with "mark all as read" / "clear all"

**Platform**
- Role-based access control via Eloquent relationships + Laravel Gates
- Transactional e-mail (order confirmation, contact form submissions)
- CORS support for API consumption (`fruitcake/laravel-cors`)
- Token-based API authentication scaffolding via Laravel Sanctum (`/api/user`)
- CSRF protection, request validation via Form Requests (`CommentRequest`, `PasswordRequest`)

## Tech Stack

| Layer | Technology | Why it was chosen |
|---|---|---|
| Backend framework | **Laravel 8** (PHP ^7.3 \| ^8.0) | Batteries-included MVC framework — routing, Eloquent ORM, migrations, validation, mailing, queues and notifications all come out of the box, which keeps a marketplace-sized app (auth, catalog, cart, orders, seller dashboard) maintainable without stitching together many packages. |
| ORM / Database | **Eloquent ORM** + **MySQL** | Eloquent's expressive relationship API (`belongsTo`, `hasMany`, `belongsToMany`) maps cleanly onto the marketplace domain (Users ↔ Roles, Products ↔ Categories/Orders/Sales/Wishlists). MySQL is a free, widely-supported RDBMS with strong Laravel/tooling support. |
| Authentication & Authorization | **Laravel UI** (scaffolding), **Laravel Sanctum**, **Gates** | Laravel UI provides ready-made Bootstrap auth views (login/register/password reset/verification) so the auth flow didn't need to be hand-rolled. Sanctum adds lightweight, cookie/token-based API authentication for future first-party API/SPA clients. Gates give a simple, explicit way to express the single `seller-dashboard` authorization rule without the overhead of a full policy-per-model setup. |
| Notifications | **Laravel Notifications (database channel)** | Lets order-placed and new-comment events reach sellers as in-app notifications without building a custom notification table/model from scratch, and can be extended to mail/broadcast channels later with no schema changes. |
| Mail | **Laravel Mail** (SMTP, e.g. Mailhog in dev) | Standardized way to send order confirmations and contact-form messages using swappable drivers (SMTP/SES/etc.) via a single `MAIL_MAILER` config. |
| HTTP client | **Guzzle** | Bundled dependency of Laravel used for any outbound HTTP calls (e.g. future third-party/payment integrations). |
| Frontend templating | **Blade** with reusable layout components (`components/home-master`, `components/seller-master`, etc.) | Server-rendered views avoid the operational overhead of a separate SPA/build pipeline while still allowing component reuse across the buyer/seller/auth sections of the site. |
| Frontend build tooling | **Laravel Mix 6** (Webpack wrapper) | Compiles/bundles `resources/js` and `resources/css` with a minimal, Laravel-conventional API (`mix.js().postCss()`), avoiding raw Webpack configuration. |
| UI/theme | **Bootstrap**, **jQuery**, plus plugin set (Owl Carousel, Slick, ElevateZoom, Magnific Popup, Revolution Slider, Bootstrap Datetimepicker, Bootstrap Select, jQuery Bar Rating, Font Awesome / Ionicons) | A pre-built, responsive storefront theme (product sliders, zoomable product images, star ratings, lightboxes) accelerates building an e-commerce-grade UI without designing every widget from scratch. |
| Date/time handling | **Carbon** (via `nesbot/carbon`) | Used to compute per-month sales boundaries (`Carbon::create(...)->endOfMonth()`) for the seller sales dashboard. |
| Testing | **PHPUnit**, **Mockery**, **FakerPHP** | Laravel's default testing stack — PHPUnit for Unit/Feature test suites, Mockery for mocking collaborators, Faker for generating realistic seed/test data (used in `database/factories`). |
| Dev tooling | **Laravel Sail**, **Ignition**, **Collision**, **StyleCI (laravel preset)** | Sail offers an optional Docker-based local environment; Ignition/Collision provide readable error pages and CLI stack traces during development; StyleCI enforces the Laravel PHP coding style on the codebase. |

## Minimum System Requirements

These are the minimum resources to comfortably **run and develop** the application locally (compiling assets, running `artisan serve`/queue workers, and a MySQL instance). Production sizing will depend on expected traffic.

| Resource | Minimum | Recommended |
|---|---|---|
| CPU | 1 vCPU / single core | 2 vCPUs or more (asset compilation and Composer install are noticeably faster) |
| RAM | 512 MB | 2 GB+ (Node/Webpack builds and MySQL both benefit from headroom) |
| Disk space | ~500 MB (app + `vendor/` + `node_modules/`) | 1–2 GB (including logs, uploaded product images, and DB data) |
| PHP | 7.3 or 8.0+ | 8.0+ |
| PHP extensions | BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, GD or Imagick (for image handling) | same |
| Database | MySQL 5.7+ or MariaDB 10.3+ | MySQL 8.x |
| Composer | 2.x | 2.x (latest) |
| Node.js / npm | Node 14+ / npm 6+ | Node 16 LTS+ |
| Web server | PHP built-in server (`artisan serve`) for local dev | Nginx or Apache with PHP-FPM for production |

## Environment Setup

```bash
# 1. Clone the repository
git clone <repository-url> estore
cd estore

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Copy the environment file and generate the app key
cp .env.example .env
php artisan key:generate

# 5. Configure your database credentials in .env (see table below),
#    then create the database itself, e.g.:
#    mysql -u root -p -e "CREATE DATABASE estore CHARACTER SET utf8mb4;"

# 6. Run migrations (add --seed to also seed demo users/products)
php artisan migrate --seed

# 7. Create the public storage symlink (needed if you serve uploaded files via storage/)
php artisan storage:link

# 8. Compile front-end assets
npm run dev      # one-off development build
# npm run watch  # rebuild automatically on file changes
# npm run prod   # minified production build

# 9. Serve the application
php artisan serve
# App will be available at http://127.0.0.1:8000
```

For local outgoing mail during development, point `MAIL_HOST`/`MAIL_PORT` at a tool like [Mailhog](https://github.com/mailhog/MailHog) or [Mailpit](https://github.com/axllent/mailpit) so verification/order/contact e-mails can be inspected without a real SMTP provider.

## Environment Variables

Copy `.env.example` to `.env` and configure the following:

| Variable | Purpose | Notes |
|---|---|---|
| `APP_NAME` | Display name of the app | Shown in e-mails and page titles |
| `APP_ENV` | `local`, `staging`, `production` | Controls error verbosity, debug tooling |
| `APP_KEY` | Encryption key used for sessions/cookies | Generate with `php artisan key:generate`; never commit a real value |
| `APP_DEBUG` | `true`/`false` | Set to `false` in production |
| `APP_URL` | Base URL of the app | Used for generating absolute links (e.g. e-mail verification links) |
| `LOG_CHANNEL`, `LOG_DEPRECATIONS_CHANNEL`, `LOG_LEVEL` | Logging configuration | Defaults (`stack` / `debug`) are fine for local dev |
| `DB_CONNECTION` | Database driver | `mysql` by default |
| `DB_HOST` / `DB_PORT` | Database host/port | `127.0.0.1:3306` for local MySQL |
| `DB_DATABASE` | Database name | Must exist before running migrations |
| `DB_USERNAME` / `DB_PASSWORD` | Database credentials | |
| `BROADCAST_DRIVER` | Event broadcasting driver | `log` by default; set to `pusher` to enable real-time broadcasting |
| `CACHE_DRIVER` | Cache backend | `file` by default; use `redis`/`memcached` for multi-server setups |
| `FILESYSTEM_DRIVER` | Default filesystem disk | `local` by default; product images are also stored under `public/images/products/<seller>` |
| `QUEUE_CONNECTION` | Queue driver for notifications/mail | `sync` runs jobs immediately; use `database`/`redis` + a queue worker in production |
| `SESSION_DRIVER` / `SESSION_LIFETIME` | Session storage & timeout (minutes) | |
| `MEMCACHED_HOST` | Memcached host | Only needed if `CACHE_DRIVER=memcached` |
| `REDIS_HOST` / `REDIS_PASSWORD` / `REDIS_PORT` | Redis connection | Only needed if using Redis for cache/queue/session |
| `MAIL_MAILER` | Mail transport | `smtp` by default |
| `MAIL_HOST` / `MAIL_PORT` | SMTP server | `mailhog`/`1025` for local dev |
| `MAIL_USERNAME` / `MAIL_PASSWORD` / `MAIL_ENCRYPTION` | SMTP credentials/encryption | Required for real providers (e.g. SES, Mailgun, Gmail SMTP) |
| `MAIL_FROM_ADDRESS` / `MAIL_FROM_NAME` | Default "from" identity | Order/contact e-mails currently also hardcode sender addresses in code |
| `AWS_ACCESS_KEY_ID` / `AWS_SECRET_ACCESS_KEY` / `AWS_DEFAULT_REGION` / `AWS_BUCKET` / `AWS_USE_PATH_STYLE_ENDPOINT` | AWS S3 credentials | Only needed if switching `FILESYSTEM_DRIVER` to `s3` for product image storage |
| `PUSHER_APP_ID` / `PUSHER_APP_KEY` / `PUSHER_APP_SECRET` / `PUSHER_APP_CLUSTER` | Pusher credentials | Only needed if enabling real-time broadcasting |
| `MIX_PUSHER_APP_KEY` / `MIX_PUSHER_APP_CLUSTER` | Front-end (Mix-exposed) Pusher config | Mirrors the Pusher key/cluster so JS can subscribe to broadcast channels |

## Project / File Structure

```
estore/
├── app/
│   ├── Console/                # Artisan Kernel (scheduled commands)
│   ├── Exceptions/              # Global exception handler
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/            # Login, Register, Password reset/confirm, Verification
│   │   │   ├── ProductController.php    # Catalog, search, details, discounts
│   │   │   ├── CategoryController.php   # Category creation
│   │   │   ├── CartController.php       # Cart CRUD & checkout page
│   │   │   ├── OrderController.php      # Checkout, tracking, seller order management
│   │   │   ├── WishlistController.php   # Wishlist CRUD
│   │   │   ├── CommentController.php    # Product comments
│   │   │   ├── SellerController.php     # Seller dashboard, products, orders, notifications
│   │   │   ├── UserController.php       # Profile, address, seller requests
│   │   │   ├── RoleController.php       # Role-related actions
│   │   │   ├── SaleController.php       # Sales records
│   │   │   ├── AddressController.php    # Shipping addresses
│   │   │   └── Controller.php           # Base controller + static pages (FAQ, shipping, contact...)
│   │   ├── Middleware/           # Auth guards, EnsureSeller ("seller"), CSRF, trimming, etc.
│   │   └── Requests/             # CommentRequest, PasswordRequest (form validation)
│   ├── Models/                   # Eloquent models: User, Product, Category, Cart, Order,
│   │                              #  OrderStatus, Role, Sale, SellerRequest, Wishlist, Comment, Address
│   ├── Notifications/            # OrderPlaced, CommentedOnProduct (database channel)
│   └── Providers/                # App/Auth/Broadcast/Event/Route service providers (incl. Gates)
├── bootstrap/                    # Framework bootstrap file & cache
├── config/                       # app, auth, cors, database, mail, sanctum, session, etc.
├── database/
│   ├── factories/                # UserFactory, ProductFactory (Faker-based)
│   ├── migrations/                # Schema for users, products, categories, carts, orders, roles, ...
│   └── seeders/                  # DatabaseSeeder
├── public/                       # Web root: entry point, compiled assets, theme plugins & images
│   ├── assets/, css/, js/, sass/, scss/   # Compiled/theme assets
│   ├── images/                    # Static + uploaded product/user/category images
│   └── plugins/                   # Bootstrap, jQuery, Owl Carousel, Slick, ElevateZoom, etc.
├── resources/
│   ├── css/ & js/                 # Source assets compiled by Laravel Mix
│   ├── lang/                      # Localization strings
│   └── views/
│       ├── auth/                  # Login/Register/Password views
│       ├── components/            # Shared Blade layout components (home/seller/profile/error masters)
│       ├── emails/                 # Order confirmation & contact e-mail templates
│       ├── errors/                 # 403/404/419/500 error pages
│       ├── products/               # Listing, details, search, discount, tracking views
│       ├── seller/                 # Dashboard, product CRUD, orders, notifications, requests
│       ├── user/                   # Cart, checkout, order success, profile
│       └── layouts/                # Base app layout
├── routes/
│   ├── web.php                    # Storefront, auth, buyer & seller routes
│   ├── api.php                    # Sanctum-protected API routes
│   ├── channels.php               # Broadcast channel authorization
│   └── console.php                # Artisan closures/commands
├── storage/                       # Logs, framework cache, uploaded/user files
├── tests/                         # Unit & Feature PHPUnit test suites
├── .env.example                   # Environment variable template
├── composer.json / composer.lock  # PHP dependencies
├── package.json / package-lock.json # JS dependencies
├── webpack.mix.js                 # Laravel Mix build configuration
├── phpunit.xml                    # PHPUnit configuration
├── .styleci.yml                   # StyleCI (Laravel preset) configuration
└── artisan                        # Artisan CLI entry point
```
## Demo Video

[Here is the project demo video](https://www.facebook.com/share/v/1F2cEMtnns/)

## Data Model Overview

Core Eloquent relationships (see `app/Models/`):

- **User** `hasMany` Products, Comments, Carts, Orders, Wishlists, Sales · `hasOne` Address, SellerRequest · `belongsToMany` Roles
- **Product** `belongsTo` User (seller), Category · `hasMany` Carts, Orders, Wishlists, Sales
- **Category** `hasMany` Products
- **Order** `belongsTo` User, Product, OrderStatus
- **Cart** / **Wishlist** `belongsTo` User, Product
- **Sale** `belongsTo` User (seller), records `quantity`, `sold_to`, `total` per transaction — powers the seller's monthly sales dashboard
- **Role** `belongsToMany` User (via `role_user` pivot) — currently used for the `seller` role, checked through `User::userHasRole()` and the `seller-dashboard` Gate
- **SellerRequest** `belongsTo` User — pending requests reviewed/granted by existing sellers

## Useful Artisan & NPM Commands

```bash
php artisan migrate:fresh --seed   # Rebuild the database from scratch with demo data
php artisan route:list             # Inspect all registered routes
php artisan tinker                 # Interactive REPL against the app/models
php artisan queue:work             # Process queued notifications/mail (if QUEUE_CONNECTION != sync)
php artisan test                   # Run the PHPUnit test suite (tests/Unit, tests/Feature)

npm run watch                      # Recompile assets on change during development
npm run prod                       # Production (minified) asset build
```

## Notes for Contributors

- Coding style follows the **Laravel** preset (see `.styleci.yml`); run your PHP through `laravel/pint` or PHP-CS-Fixer with the Laravel ruleset before submitting changes if you have it available locally.
- Product images are currently written to `public/images/products/<seller-name>/` from `ProductController@add`; ensure that directory is writable by the web server.
- The `seller-dashboard` Gate (`app/Providers/AuthServiceProvider.php`) is the single source of truth for seller-only authorization — extend it (or add policies) rather than duplicating role checks in controllers.
- Checkout does not integrate a real payment gateway; card fields are collected and validated but not charged — wire up a provider (e.g. Stripe) before using this in production.
- E-mail verification is mandatory (`Auth::routes(['verify' => true])`); make sure a working mail driver is configured or new accounts won't be able to complete verification locally.

## License

This project is built on the [Laravel framework](https://laravel.com), which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
