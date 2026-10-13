# Blog Application

A Laravel blog application with account registration, session-based login, a personal dashboard, and blog post management. Built with PHP, Blade templates, HTML, and custom CSS using the MVC architecture.

## Features

- **User registration:** Create an account with a name, unique email address, birthdate, and confirmed password.
- **Session-based authentication:** Log in and log out, with session regeneration after successful registration or login.
- **Password hashing:** Passwords are hashed with bcrypt and verified during login.
- **Personal dashboard:** View the signed-in user's name, email, and birthdate.
- **Post management:** Create, browse, view, edit, and delete posts through dedicated pages.
- **Post feed:** Browse posts in newest-first order, with relative timestamps and content previews.
- **Input validation:** Validate account details and post fields, with inline error messages.
- **Form protection:** Use Laravel CSRF tokens and HTTP method spoofing for update and delete forms.
- **User feedback:** Display success and error messages after actions.

All post routes require login. Edit and update actions check post ownership, while edit/delete controls are displayed for the post owner. See **Known limitations** for the current delete authorization issue.

## Technology Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP, Laravel |
| Templates | Laravel Blade |
| Interface | HTML, custom CSS, native JavaScript delete confirmation |
| Data access | Eloquent ORM and database migrations |
| Authentication | Custom session-based authentication and bcrypt |
| Database | Laravel database configuration; SQLite is the configured fallback |

The archive does not include `composer.json` or `composer.lock`, so the exact Laravel version and PHP requirements cannot be confirmed.

## Project Structure

| Path | Purpose |
| --- | --- |
| `app/Http/Controllers/UserController.php` | Registration, login, logout, and dashboard actions |
| `app/Http/Controllers/PostController.php` | Post CRUD actions and ownership checks |
| `app/Http/Middleware/EnsureAuthenticated.php` | Restricts access using the session's `user_id` |
| `app/Models/Auth/User.php` | User model used by registration and authentication |
| `app/Models/Post.php` | Post model and its relationship to the author |
| `database/migrations/` | Users, sessions, posts, cache, and queue table definitions |
| `resources/views/` | Shared layout, authentication forms, dashboard, and post pages |
| `routes/web.php` | Application routes |
| `tests/` | Starter feature and unit tests |

## Local Setup

### 1. Restore the missing project files

The supplied archive contains application source code but is not a complete runnable Laravel project. Before proceeding:

- Restore the original `composer.json`, `composer.lock`, `artisan`, and `.env.example` from the complete project.
- Rename the directory `public ` (with a trailing space) to `public`.
- Ensure `bootstrap/cache` and Laravel's storage directories exist and are writable, including `storage/framework/cache/data`, `storage/framework/sessions`, `storage/framework/views`, and `storage/logs`.

Use PHP and extensions compatible with the restored Composer requirements, Composer, and a database driver such as PDO SQLite or PDO MySQL. The current Blade layout uses inline CSS and does not require a frontend asset build to render its pages.

### 2. Install dependencies and configure the environment

Run these commands from the complete project root:

```bash
composer install
php -r "copy('.env.example', '.env');"
php artisan key:generate
```

Copy the example environment only if `.env` does not already exist.

For a local SQLite setup, create the database file without overwriting an existing database:

```bash
php -r "if (!file_exists('database/database.sqlite')) { touch('database/database.sqlite'); }"
```

Set these values in `.env`:

```dotenv
APP_NAME="Blog Application"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
SESSION_DRIVER=database
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

Remove any existing `DB_DATABASE` setting to use the configured fallback, `database/database.sqlite`, or set it to the absolute path of that file.

### 3. Create the tables and start the application

```bash
php artisan config:clear
php artisan migrate
php artisan serve
```

Open [http://127.0.0.1:8000](http://127.0.0.1:8000).

**Migration note:** `0001_01_01_000000_create_users_table.html` contains PHP but is not an active PHP migration. The later `2025_08_23_014316_create_users_table.php` creates the required users and sessions tables. Do not simply rename the `.html` file to `.php` or introduce a second default users migration: both would attempt to create overlapping tables.

## Usage

1. Open the homepage and select **SignUp**.
2. Enter your name, email, birthdate, password, and password confirmation. Passwords must contain at least six characters, and the birthdate must be before today.
3. After registration, view your account details on the dashboard.
4. Select **Posts**, then **Add new post**.
5. Enter a title of up to 255 characters and optional content, then save.
6. Select **Show** to read a post, or use your post's **Edit** and **Delete** controls.
7. Select **Logout** to end the session.

## Routes

| Method | Path | Purpose | Access |
| --- | --- | --- | --- |
| GET | `/` | Homepage | Public |
| GET / POST | `/register` | Registration form / submit | Public |
| GET / POST | `/login` | Login form / submit | Public |
| POST | `/logout` | Invalidate the session | No authentication middleware |
| GET | `/dashboard` | Account details | Signed-in users |
| GET | `/posts` | List posts | Signed-in users |
| GET | `/posts/create` | New post form | Signed-in users |
| POST | `/posts` | Save a post | Signed-in users |
| GET | `/posts/{post}` | Read a post | Signed-in users |
| GET | `/posts/{post}/edit` | Edit form | Post owner |
| PUT | `/posts/{post}` | Update a post | Post owner |
| DELETE | `/posts/{post}` | Delete a post | Signed-in users; ownership enforcement needs fixing |

## Known Limitations

- **Delete authorization:** `PostController::destroy()` calls `authorizeOwner()` but ignores its boolean result. A signed-in user could delete another user's post through a direct request. Enforce the ownership result before calling `delete()`; hiding the button alone is insufficient.
- **Incomplete project archive:** The missing dependency manifests and startup files must be restored before installation or runtime testing.
- **Authentication scope:** The application uses a custom `session('user_id')` flow. It does not implement administrator roles or a general role-based permission system.
- **Test coverage:** The supplied tests check the homepage response and a basic assertion only. Authentication, validation, and post permissions do not yet have dedicated tests.

## Testing

After restoring the complete Laravel project and its test configuration, run:

```bash
php artisan test
```

The setup steps and application behavior were documented from source inspection; the supplied archive could not be run as a complete application.
