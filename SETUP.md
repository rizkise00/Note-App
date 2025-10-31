# Note App - Quick Start Guide

## Project Setup

This is a Note Application built with CodeIgniter 4 and Tailwind CSS.

### Prerequisites
- PHP 8.0+
- MySQL/MariaDB
- Composer
- Node.js & npm

### Installation Steps

1. **Clone or navigate to the project directory**
   ```bash
   cd c:\Project\Mini Project\note-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Configure database**
   - Edit `.env` file and update database credentials:
     ```
     database.default.hostname = localhost
     database.default.database = note_app
     database.default.username = root
     database.default.password = 
     ```
   - Create a MySQL database called `note_app`

5. **Run migrations**
   ```bash
   php spark migrate
   ```

6. **Build Tailwind CSS**
   ```bash
   npm run css:build
   ```

   Or to watch for changes during development:
   ```bash
   npm run css:watch
   ```

7. **Start the development server**
   ```bash
   php spark serve
   ```

8. **Access the application**
   - Open your browser and go to: `http://localhost:8080`

## Features

✅ **User Authentication**
   - Register new account
   - Secure login with password hashing
   - Logout functionality
   - Protected routes (filters prevent logged-in users from accessing login/register pages)

✅ **Note Management**
   - Create, view, and delete notes
   - Notes are stored per user
   - Responsive grid layout
   - Timestamp tracking

✅ **User Interface**
   - Modern design with Tailwind CSS
   - Responsive forms with validation
   - Beautiful gradient backgrounds
   - Smooth transitions and hover effects

## Project Structure

```
note-app/
├── app/
│   ├── Controllers/     # Application controllers
│   │   ├── Auth.php     # Authentication logic
│   │   └── Dashboard.php # Note management
│   ├── Models/          # Database models
│   │   ├── User.php
│   │   └── Note.php
│   ├── Views/           # View templates
│   │   ├── auth/        # Login & register pages
│   │   └── dashboard.php # Main note dashboard
│   ├── Filters/         # Route filters
│   │   ├── AuthFilter.php  # Require authentication
│   │   └── GuestFilter.php # Prevent logged-in access
│   ├── Database/        # Database migrations
│   │   └── Migrations/
│   └── Config/          # Configuration files
├── public/              # Web root
│   └── css/             # Compiled Tailwind CSS
├── .env                 # Environment configuration
└── tailwind.config.js   # Tailwind configuration
```

## Default Routes

- `GET /` → Redirects to `/auth/login`
- `GET /auth/login` → Login page (guest only)
- `GET /auth/register` → Register page (guest only)
- `POST /auth/do-login` → Process login
- `POST /auth/do-register` → Process registration
- `GET /auth/logout` → Logout (auth required)
- `GET /dashboard` → Dashboard with notes (auth required)
- `POST /note/create` → Create new note (auth required)
- `GET /note/delete/:id` → Delete note (auth required)

## Key Implementation Details

### Authentication Protection
- **GuestFilter**: Prevents logged-in users from accessing login/register pages (redirects to dashboard)
- **AuthFilter**: Prevents unauthenticated users from accessing protected routes (redirects to login)

### Database Schema
- **users table**: id, name, email, password, created_at, updated_at
- **notes table**: id, user_id (FK), title, content, created_at, updated_at

## Testing the Application

1. **Register a new account**
   - Go to `/auth/register`
   - Fill in name, email, password (min 6 characters)
   - Password confirmation must match
   - Email must be unique

2. **Login**
   - Go to `/auth/login`
   - Enter your registered email and password
   - On successful login, you'll be redirected to dashboard

3. **Create Notes**
   - In dashboard, fill in title and content
   - Click "Save Note"
   - Notes appear in grid below

4. **Delete Notes**
   - Click "Delete" button on any note card
   - Confirm deletion

5. **Logout**
   - Click "Logout" button in navigation
   - You'll be redirected to login page

## Important Security Features

✅ Password hashing using PHP's `password_hash()`
✅ Session-based authentication
✅ User-specific note access (users can only see their own notes)
✅ CSRF token validation (built into CodeIgniter)
✅ Input validation on all forms
✅ Route filters for access control

## Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check `.env` database credentials
- Ensure `note_app` database exists

### CSS Not Loading
- Run `npm run css:build` to compile Tailwind CSS
- Check if `public/css/output.css` exists
- Verify browser cache is cleared

### Port Already in Use
- Change port: `php spark serve --port 8081`

## Development Tips

- Watch Tailwind CSS changes: `npm run css:watch`
- Keep development server running in separate terminal
- Check browser console for JavaScript errors
- Use `php spark tinker` for debugging
