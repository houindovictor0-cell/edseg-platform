# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

ED-SEG platform: a Laravel 12 web app for a doctoral school ("École Doctorale"). It serves public informational pages (school presentation, formation, admission, research, cooperation, news) plus an admin-only backoffice (`/admin/*`) — there is no public self-registration or doctorant/enseignant login; `Doctorant` and `Enseignant` are directory/archive records managed by the admin, not user accounts. Content is in French — model fields, route names, validation messages, and UI text all use French naming (e.g. `these`, `soutenance`, `candidature`, `filiere`/`specialite`).

## Commands

```bash
# Install & bootstrap (composer script)
composer setup            # composer install, .env, key:generate, migrate, npm install, npm run build

# Local dev (runs php serve + queue:listen + pail + vite concurrently)
composer dev

# PHP tests (PHPUnit, class-based; SQLite in-memory per phpunit.xml)
composer test              # clears config cache then runs php artisan test
php artisan test                                  # run full suite
php artisan test --filter=TestName                # run a single test
php artisan test tests/Feature/Auth/AuthenticationTest.php   # run one file

# Lint / format PHP
vendor/bin/pint            # Laravel Pint code style fixer

# Frontend
npm run dev                # Vite dev server
npm run build               # Vite production build

# Database
php artisan migrate
php artisan migrate:fresh --seed     # rebuild schema and run DatabaseSeeder
```

Default local DB driver is SQLite (`DB_CONNECTION=sqlite`); tests always run against `:memory:` SQLite regardless of `.env` (see `phpunit.xml`).

## Architecture

**Route structure** (`routes/web.php`): public marketing/content routes are grouped by section prefix (`ecole-doctorale/`, `formation/`, `admission/`, `recherche/`, `cooperation/`, `actualites/`) and map to plain controllers under `app/Http/Controllers/`. The authenticated area lives under a single `Route::middleware(['auth', 'approved'])` group, and everything under it sits in `Route::prefix('admin')->middleware('role:admin')` — admin CRUD screens are handled by controllers in `app/Http/Controllers/Admin/`. There is no public registration route and no doctorant/enseignant login area.

**Auth & authorization**: authentication is Laravel Breeze (session-based; see `routes/auth.php` and `app/Http/Controllers/Auth/`) but self-registration is disabled — accounts are only created by an existing admin via `admin.utilisateurs.store`. Authorization is managed by `spatie/laravel-permission` (`HasRoles` trait on `App\Models\User`); there is exactly one role, `admin`, seeded by `database/seeders/RoleSeeder.php` along with its permissions. Every `/admin/*` route additionally requires the `role:admin` middleware (Spatie's `RoleMiddleware`, aliased in `bootstrap/app.php`) as defense-in-depth beyond the single-role invariant.

**Approval gate**: `User.is_approved` still gates access via the `approved` middleware alias (`App\Http\Middleware\CheckApproved`) — an admin can create a not-yet-active account (`storeUtilisateur` with the "activate immediately" checkbox unchecked) and approve/reject it later (`approuverUtilisateur`/`rejeterUtilisateur`).

**Domain model shape**: `User` is the auth/identity record for admins only. `Doctorant` and `Enseignant` are directory/archive tables (nullable `user_id`, no login capability) managed entirely through `Admin\DoctorantAdminController` / `Admin\EnseignantAdminController` — `Doctorant.specialite_id` links to `Specialite` (the free-text `specialite` string column is kept in sync for backward-compat display), and `Enseignant` has a `specialites()` many-to-many (pivot `enseignant_specialite`) for "filières enseignées". Yearly result PDFs per doctorant live in `ResultatAnnuelDoctorant` (`resultats_annuels_doctorants`, one row per `annee_universitaire`); the thesis PDF itself is `These.fichier` / `DocumentThese`. Core academic entities: `These` (thesis, links a `Doctorant` to a directing `Enseignant`), `RapportAvancement` (progress reports, no longer submittable — the doctorant self-service dashboard was removed), `Publication` (enseignant-authored research works, tied to `enseignant_id`), `Candidature` (admission applications, not tied to a `User`), `Soutenance` (defense), `DocumentThese`, `ProjetRecherche`, `Laboratoire`, `AxeRecherche`, `Mention`/`Specialite` (renamed from `Filiere` — see migration `2026_08_14_072740_rename_filieres_to_specialites.php`), `Partenaire`, `Seminaire`, `Bourse`, `Actualite` (news), `Document` (public downloadable resources), `Archive` (polymorphic per-person timeline entries on `Doctorant`/`Enseignant` — controller exists but has no route/view, currently dead), `Message` (orphaned — the doctorant/enseignant messaging UI that used it was removed), `ChiffreCle`/`InfoEcole` (site content managed via admin single-record edit screens).

**Controller conventions**: admin controllers (`app/Http/Controllers/Admin/*`) follow a consistent index/store/edit/update/destroy shape without route-model binding (`findOrFail($id)` on plain `{id}` params, not implicit binding). File uploads use `$request->file(...)->store(<dir>, 'public'|'private')`; PDFs go through validated `mimes:pdf` rules with max sizes in KB. Every mutating admin/dashboard action calls `App\Helpers\Logger::log($action, $modelName, $modelId, $details)` to write an `ActivityLog` row — follow this pattern for new mutating actions so the admin activity feed and `voir-logs` permission stay meaningful. Emails (`app/Mail/*`) are dispatched inline in controllers wrapped in try/catch that logs failures via `\Log::error` rather than surfacing them to the user — mail failures must not block the underlying action (approval, candidature decision, etc.).

**Frontend**: Blade templates in `resources/views/`, organized as `pages/<section>/...` for public content, `dashboard/` for the member area, `layouts/` for shared shells (`app`, `guest`, `main`, `dashboard`, `navigation`), `emails/` for Mail views, and `components/` for Blade components (Breeze-provided plus custom ones like `page-hero`). Styling is Tailwind CSS v4 via `@tailwindcss/vite`; JS is Alpine.js; assets are bundled with Vite (`laravel-vite-plugin`), entry points `resources/css/app.css` and `resources/js/app.js`.
