<div align="center">

# 🛡️ Boilerplate — Laravel Admin Panel

**A production-ready Laravel boilerplate for building admin panels with user management, role-based access control, and a clean Bootstrap UI.**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-11.x-3776AB?style=flat-square&logo=php&logoColor=white)](https://phpunit.de)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Running the Application](#-running-the-application)
- [Default Credentials](#-default-credentials)
- [Project Structure](#-project-structure)
- [Available Commands](#-available-commands)
- [Testing](#-testing)
- [Known Security Notes](#-known-security-notes)
- [Commit Convention](#-commit-convention)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🔍 Overview

**Boilerplate** is a fully-featured Laravel admin panel starter kit designed to accelerate development of back-office applications. It ships with authentication, user management, role & permission management, DataTables integration, Excel export, image handling, and more — all wired up and ready to go.

Stop writing boilerplate. Start building features.

---

## ✨ Features

- 🔐 **Authentication** — Login, registration, password reset, two-factor authentication (via Jetstream + Sanctum)
- 👥 **User Management** — CRUD for users with avatar upload and profile management
- 🛡️ **Role & Permission Management** — Full RBAC powered by Spatie Laravel Permission
- 📊 **DataTables** — Server-side paginated tables with search and sort (Yajra DataTables)
- 📤 **Excel Export** — Export data to `.xlsx` / `.csv` (Maatwebsite Excel)
- 🖼️ **Image Processing** — Upload and resize images (Intervention Image v3 + Imagick)
- ⚙️ **App Settings** — Dynamic application settings stored in the database
- 🌍 **Multilingual** — i18n support via `laravel-lang/common`
- 🐛 **Error Tracking** — Honeybadger integration for production error monitoring
- 📧 **Mail Drivers** — Mailgun and Postmark support out of the box
- 🎨 **Bootstrap UI** — Clean, responsive admin layout built with Bootstrap 5
- 🧪 **Full Test Suite** — PHPUnit 11 feature tests covering all CRUD + auth + RBAC

---

## 🧰 Tech Stack

### Core Framework

| Package | Version | Purpose |
|---------|---------|---------|
| [Laravel](https://laravel.com) | `^12.0` | PHP framework |
| [PHP](https://php.net) | `^8.2` | Runtime |
| [Laravel Jetstream](https://jetstream.laravel.com) | `^5.3` | Auth scaffolding |
| [Laravel Sanctum](https://laravel.com/docs/sanctum) | `^4.0` | API token authentication |

### Admin & UI

| Package | Version | Purpose |
|---------|---------|---------|
| [Laravel UI](https://github.com/laravel/ui) | `^4.5` | Bootstrap scaffolding |
| Bootstrap | `5.x` | CSS framework |
| [Yajra DataTables](https://yajrabox.com/docs/laravel-datatables) | `^12.0` | Server-side DataTables |
| [Yajra DataTables Oracle](https://github.com/yajra/laravel-datatables-oracle) | `^12.0` | DataTables query builder |

### Access Control & Auth

| Package | Version | Purpose |
|---------|---------|---------|
| [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) | `^6.0` | Roles & permissions |
| [Laravel Legacy Factories](https://github.com/laravel/legacy-factories) | `^1.4` | Model factories |

### Media & Files

| Package | Version | Purpose |
|---------|---------|---------|
| [Intervention Image](https://image.intervention.io) | `^3.0` | Image processing |
| [intervention/image-laravel](https://github.com/Intervention/image-laravel) | `^1.0` | Laravel integration |
| [Maatwebsite Excel](https://laravel-excel.com) | `^3.1` | Excel/CSV import & export |

### Utilities

| Package | Version | Purpose |
|---------|---------|---------|
| [GuzzleHTTP](https://docs.guzzlephp.org) | `^7.9` | HTTP client |
| [laravel-lang/common](https://laravel-lang.com) | `^6.0` | Translation files |
| [Honeybadger Laravel](https://docs.honeybadger.io/lib/php) | `^4.0` | Error monitoring |
| [Doctrine DBAL](https://www.doctrine-project.org/projects/dbal.html) | `^4.0` | Database abstraction |

### Mail Drivers

| Package | Version | Purpose |
|---------|---------|---------|
| [symfony/mailgun-mailer](https://symfony.com/doc/current/mailer.html) | `^7.0` | Mailgun transport |
| [symfony/postmark-mailer](https://symfony.com/doc/current/mailer.html) | `^7.0` | Postmark transport |

### Dev Dependencies

| Package | Version | Purpose |
|---------|---------|---------|
| [PHPUnit](https://phpunit.de) | `^11.0` | Testing framework |
| [Mockery](https://mockery.github.io) | `^1.6` | Mocking library |
| [Nunomaduro Collision](https://github.com/nunomaduro/collision) | `^8.0` | Better CLI error output |
| [Spatie Ignition](https://flareapp.io/ignition) | `^2.8` | Debug error page |

---

## 📦 Requirements

| Requirement | Minimum Version |
|-------------|----------------|
| PHP | `8.2+` |
| Composer | `2.x` |
| Node.js | `18+` |
| npm | `9+` |
| MySQL / MariaDB | `8.0+` / `10.4+` |
| ImageMagick | Latest |
| PHP Imagick extension | Latest |

### Install System Dependencies (Ubuntu/Debian)

```bash
sudo apt-get update
sudo apt-get install -y php8.2 php8.2-cli php8.2-fpm php8.2-mysql \
    php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-bcmath \
    php8.2-gd php8.2-intl php8.2-imagick \
    imagemagick libmagickwand-dev
```

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/unabomber87/boilerplate.git
cd boilerplate
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Copy Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

## ⚙️ Configuration

Edit your `.env` file with your local settings:

```dotenv
APP_NAME="Boilerplate"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=boilerplate
DB_USERNAME=root
DB_PASSWORD=

# Mail (choose one driver)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Optional: Mailgun
# MAIL_MAILER=mailgun
# MAILGUN_DOMAIN=your-domain.mailgun.org
# MAILGUN_SECRET=your-mailgun-key

# Optional: Postmark
# MAIL_MAILER=postmark
# POSTMARK_TOKEN=your-postmark-token

# Optional: Honeybadger error tracking
# HONEYBADGER_API_KEY=your-api-key
```

---

## 🗄️ Database Setup

### 1. Create the Database

```sql
CREATE DATABASE boilerplate CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Run Migrations

```bash
php artisan migrate
```

Tables created:

| Migration | Tables Created |
|-----------|---------------|
| `create_users_table` | `users` |
| `create_password_resets_table` | `password_resets` |
| `add_two_factor_columns_to_users_table` | Adds 2FA columns to `users` |
| `create_failed_jobs_table` | `failed_jobs` |
| `create_personal_access_tokens_table` | `personal_access_tokens` |
| `create_sessions_table` | `sessions` |
| `create_permission_tables` | `permissions`, `roles`, `model_has_roles`, `model_has_permissions`, `role_has_permissions` |
| `create_apps_table` | `apps` |
| `create_settings_table` | `settings` |

### 3. Seed the Database

```bash
php artisan db:seed
```

`DatabaseSeeder` → `InitSeeder` creates:

- Default **role**: `admin` (with all permissions)
- Default **permissions** for all modules: `permission`, `role`, `user`, `app`, `setting` × `list/create/update/delete`
- A default **admin user** (see [Default Credentials](#-default-credentials))
- Default **apps** and **settings** entries

### 4. Full Fresh Install (migrate + seed in one command)

```bash
php artisan migrate:fresh --seed
```

---

## 🏃 Running the Application

### Development

```bash
npm run dev          # Compile assets (watch mode)
php artisan serve    # Start the local server
```

Visit: [http://localhost:8000](http://localhost:8000)

### Production Build

```bash
npm run production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Storage Link (required for file uploads)

```bash
php artisan storage:link
```

### Fix Storage Permissions (Linux/macOS)

```bash
sudo chown -R www-data:www-data storage/ bootstrap/cache/
chmod -R 775 storage/ bootstrap/cache/
```

---

## 🔑 Default Credentials

After seeding, log in with:

| Field | Value |
|-------|-------|
| **Email** | `admin@boilerplate.com` |
| **Password** | `admin@boilerplate.com` |
| **Role** | `admin` |

> ⚠️ **Change the default password immediately in production!**

---

## 📁 Project Structure

```
boilerplate/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   ├── ConfirmPasswordController.php
│   │   │   │   └── VerificationController.php
│   │   │   ├── AppController.php        # App management + auto permission creation
│   │   │   ├── HomeController.php       # Dashboard
│   │   │   ├── PermissionController.php # Permission CRUD
│   │   │   ├── RoleController.php       # Role CRUD + permission sync
│   │   │   ├── SettingController.php    # App settings + file upload
│   │   │   └── UserController.php       # User CRUD + profile
│   │   └── Requests/                    # Form request validation classes
│   └── Models/
│       ├── App.php
│       ├── User.php                     # HasRoles (Spatie) + HasApiTokens (Sanctum)
│       └── Setting.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── InitSeeder.php               # Roles, permissions, default admin user
├── routes/
│   ├── web.php                          # All web routes (auth + CRUD resources)
│   └── api.php                          # Sanctum-protected API routes
├── tests/
│   └── Feature/
│       ├── DashboardTest.php
│       ├── UserTest.php
│       ├── RoleTest.php
│       ├── PermissionTest.php
│       └── AppControllerTest.php
├── .env.example
├── composer.json
└── phpunit.xml
```

---

## 🛠️ Available Commands

```bash
# Development
php artisan serve                    # Start dev server
npm run dev                          # Compile assets (watch)
npm run production                   # Compile & minify for production

# Database
php artisan migrate                  # Run pending migrations
php artisan migrate:fresh --seed     # Drop all tables, re-migrate, seed
php artisan db:seed                  # Run seeders only

# Cache Management
php artisan optimize:clear           # Clear all caches
php artisan config:cache             # Cache configuration
php artisan route:cache              # Cache routes
php artisan view:cache               # Cache views

# Maintenance
php artisan storage:link             # Create storage symlink
php artisan queue:work               # Start queue worker
php artisan tinker                   # Interactive REPL

# Testing
php artisan test                     # Run full test suite
php artisan test --filter RoleTest   # Run specific test class
./vendor/bin/phpunit                 # Run PHPUnit directly
```

---

## 🧪 Testing

Tests run against an **SQLite in-memory database** — no external database required.

### Test Stack

| Tool | Version | Purpose |
|------|---------|---------|
| [PHPUnit](https://phpunit.de) | 11.x | Test runner |
| Laravel Testing Helpers | built-in | HTTP assertions, `actingAs`, `RefreshDatabase` |
| SQLite (`:memory:`) | built-in | Fast isolated in-memory DB per test run |
| Spatie Permission | `^6.0` | RBAC setup in tests via `firstOrCreate` |

### Test Structure

```
tests/
└── Feature/
    ├── DashboardTest.php       # Auth redirect + root URL
    ├── UserTest.php            # Full CRUD + profile + password hashing
    ├── RoleTest.php            # Full CRUD + permission sync
    ├── PermissionTest.php      # CRUD + security notes
    └── AppControllerTest.php   # App CRUD + auto permission creation
```

### What Is Tested

#### Dashboard (`DashboardTest`)
- Root `/` displays login page
- Guest redirected from `/dashboard` to `/login`
- Authenticated user can access `/dashboard`

#### User CRUD (`UserTest`)
- Guest and unauthorized user redirected / receive 401 on all actions
- Admin can view index, create form, edit form
- Admin creates user → stored in DB with hashed password and role assigned
- Validation: `name`, `email`, `password`, `role` required; email must be unique
- Admin updates user name/email; password updated only when provided (`filled()` check)
- Password never changed on update if field is absent
- Admin deletes user → JSON response + record removed from DB
- Profile page accessible by any authenticated user

#### Role CRUD (`RoleTest`)
- Guest and unauthorized user blocked on all actions
- Admin can view index, create form, edit form
- Admin creates role with or without permissions
- Validation: `name` required
- Admin renames role and syncs permissions (old removed, new assigned)
- Updating with no permissions clears all permissions
- Admin deletes role → redirect to `/roles` (not JSON)
- Unknown role returns 404 (`findOrFail`)

#### Permission CRUD (`PermissionTest`)
- Guest blocked on all actions
- `index()` checks `can('permission.list')` → 401 if missing
- `create()` and `destroy()` have **no permission check** in current controller — documented as a known gap (see [Known Security Notes](#-known-security-notes))
- Admin creates permission → stored in DB
- Admin deletes permission → redirect to `/permissions`
- `edit()` redirects to `/permissions` for unknown ID (no `findOrFail`)

#### App CRUD (`AppControllerTest`)
- Full CRUD with permission checks
- Creating an app auto-creates 4 permissions: `{name}.list/create/update/delete`
- Deleting an app also deletes its associated permissions

### Running Tests

```bash
# Full suite
php artisan test

# By suite
php artisan test --testsuite=Feature

# Single class
php artisan test --filter UserTest
php artisan test --filter RoleTest

# Single method
php artisan test --filter "admin_can_create_a_new_user"

# With coverage (requires Xdebug or PCOV)
php artisan test --coverage

# Parallel (faster on multi-core)
php artisan test --parallel
```

### phpunit.xml Configuration

```xml
<server name="DB_CONNECTION" value="sqlite"/>
<server name="DB_DATABASE" value=":memory:"/>
<server name="MAIL_MAILER" value="array"/>
<server name="QUEUE_CONNECTION" value="sync"/>
<server name="SESSION_DRIVER" value="array"/>
<server name="BCRYPT_ROUNDS" value="4"/>
```

> `BCRYPT_ROUNDS=4` speeds up tests by reducing password hashing cost.

### Writing New Tests

All test classes extend `Tests\TestCase` and use `RefreshDatabase`. Always reset the Spatie cache in `setUp()`:

```php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class MyFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Always reset Spatie cache to avoid stale permission data between tests
        app()['cache']->forget(config('permission.cache.key'));

        Permission::firstOrCreate(['name' => 'something.list', 'guard_name' => 'web']);

        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $role->syncPermissions(['something.list']);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /** @test */
    public function it_does_something(): void
    {
        $this->actingAs($this->admin)
            ->get('/some-route')
            ->assertStatus(200);
    }
}
```

---

## 🔒 Known Security Notes

These gaps were identified during the test suite audit. They are documented here and should be addressed before going to production.

| Controller | Method | Issue |
|------------|--------|-------|
| `PermissionController` | `create()` | No `can('permission.create')` check — any authenticated user can access the form |
| `PermissionController` | `store()` | No `can('permission.create')` check + no `FormRequest` validation — any authenticated user can create permissions |
| `PermissionController` | `update()` | No `can('permission.update')` check |
| `PermissionController` | `destroy()` | No `can('permission.delete')` check — any authenticated user can delete permissions |
| `PermissionController` | `store()` | Uses plain `Request` with no validation rules — a `name` field is required but not enforced |

**Fix:** Add permission checks and a `PermissionRequest` FormRequest class to `PermissionController`, matching the pattern used in `AppController`, `RoleController`, and `UserController`.

---

## 📐 Commit Convention

This project follows **Conventional Commits**. Every commit message must follow this format:

```
<type>(<scope>): <short description>
```

### Types

| Type | When to use |
|------|-------------|
| `feat` | New feature or new controller/route |
| `fix` | Bug fix |
| `test` | Adding or fixing tests |
| `refactor` | Code change that neither fixes a bug nor adds a feature |
| `docs` | Documentation only (README, PHPDoc, inline comments) |
| `chore` | Dependency updates, config changes, tooling |
| `security` | Fixing a security vulnerability or adding a missing permission check |
| `style` | Code formatting, PSR-12 compliance (no logic change) |

### Scopes

Use the module name as scope: `auth`, `user`, `role`, `permission`, `app`, `setting`, `dashboard`, `tests`, `readme`.

### Examples

```bash
feat(user): add profile photo upload to UserController
fix(role): destroy() now returns redirect instead of 404 on missing role
test(role): fix assertRedirect on destroy + add Spatie cache reset in setUp
test(permission): document missing can() checks as known security gap
security(permission): add can() checks and PermissionRequest to PermissionController
docs(readme): update test coverage section and add known security notes
refactor(app): extract permission creation logic to AppService
chore: upgrade yajra/laravel-datatables to ^12.0
```

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feat/my-feature`
3. Write tests for your changes
4. Commit using Conventional Commits: `git commit -m 'feat(scope): description'`
5. Push to the branch: `git push origin feat/my-feature`
6. Open a Pull Request

Please follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards and write tests for every new feature or bug fix.

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

<div align="center">

Built with ❤️ using [Laravel](https://laravel.com) · [Bootstrap](https://getbootstrap.com) · [Spatie](https://spatie.be)

</div>
