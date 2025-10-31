# Note App - Personal Note-Taking Application

## Overview

Note App is a modern, secure web-based note-taking application built with CodeIgniter 4 and Tailwind CSS. It provides users with an intuitive platform to create, manage, organize, and pin their personal notes. The application features user authentication, real-time note management, and a clean, responsive user interface.

## Key Features

- **User Authentication**: Secure registration and login with password hashing
- **Note Management**: Create, read, update, and delete personal notes
- **Pin/Unpin Notes**: Mark important notes by pinning them to the top
- **Responsive Design**: Beautiful and intuitive UI built with Tailwind CSS
- **Session-Based Security**: Protected routes and authenticated user sessions
- **Color-Coded Elements**: Visual hierarchy with blue and indigo color scheme
- **Modal Forms**: Create and edit notes using modal dialogs

## Installation

### Prerequisites

- PHP 8.0 or higher (tested with PHP 8.2.12)
- Composer (PHP dependency manager)
- PostgreSQL database server
- Node.js and npm (for Tailwind CSS compilation)
- Git (optional, for cloning the repository)

### Step-by-Step Installation

1. **Navigate to the project directory**:
   ```bash
   cd c:\Project\Mini Project\note-app
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Configure environment variables**:
   - Copy the `.env` file or create one based on the example
   - Update database credentials:
     ```
     database.default.hostname=localhost
     database.default.database=note_app
     database.default.username=postgres
     database.default.password=your_password
     database.default.DBDriver=Postgre
     ```

5. **Create the database**:
   ```sql
   CREATE DATABASE note_app;
   ```

6. **Run database migrations**:
   ```bash
   php spark migrate
   ```

7. **Compile Tailwind CSS**:
   ```bash
   npm run build
   ```
   
   For development with watch mode:
   ```bash
   npm run dev
   ```

8. **Start the development server**:
   ```bash
   php spark serve
   ```
   
   The application will be available at `http://localhost:8080`

## Usage

1. Open your browser and navigate to `http://localhost:8080`
2. Create a new account by clicking the Register button
3. Login with your email and password
4. Create, edit, delete, and pin your notes from the dashboard
5. Click the star icon to pin/unpin important notes
6. Use the Edit and Delete buttons to manage your notes

## Project Structure

```
app/
├── Config/          # Configuration files
├── Controllers/     # Application controllers (Auth, Dashboard)
├── Filters/         # Route filters (AuthFilter, GuestFilter)
├── Models/          # Data models (User, Note)
├── Views/           # HTML templates
└── Database/Migrations/  # Database schema migrations

public/
├── css/             # Compiled CSS files
├── index.php        # Application entry point
└── robots.txt

writable/
├── cache/           # Cache storage
├── logs/            # Application logs
├── session/         # Session storage
└── uploads/         # User uploads
```

## Technology Stack

- **Backend**: PHP 8.2.12
- **Framework**: CodeIgniter 4.6.3
- **Frontend**: Tailwind CSS 4.1.16
- **Database**: PostgreSQL
- **Authentication**: Session-based with password hashing
- **Package Managers**: Composer (PHP) and npm (Node.js)

## Color Scheme

- **Navigation**: Blue background (blue-600) with white text
- **Note Cards**: White background with blue top border (blue-400)
- **Section Titles**: Blue text (blue-700)
- **Modal Headers**: Blue or Indigo background (blue-600, indigo-600)
- **Buttons**: Blue and Indigo shades (blue-500, indigo-500)
- **Success Messages**: Green background (green-100)
- **Error Messages**: Red background (red-100)

## API Routes

### Authentication Routes
- `GET /auth/login` - Login page
- `POST /auth/do-login` - Process login
- `GET /auth/register` - Registration page
- `POST /auth/do-register` - Process registration
- `GET /auth/logout` - Logout user

### Dashboard Routes (Authenticated)
- `GET /dashboard` - View all notes
- `POST /note/create` - Create a new note
- `POST /note/update/:id` - Update a note
- `POST /note/toggle-pin/:id` - Pin/unpin a note
- `POST /note/delete/:id` - Delete a note

## Server Requirements

PHP version 8.0 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [pgsql](http://php.net/manual/en/pgsql.installation.php) - Required for PostgreSQL database

The following extensions should be enabled:

- json (enabled by default)
- [libcurl](http://php.net/manual/en/curl.requirements.php) for HTTP requests

## Troubleshooting

### Database Connection Error
- Verify PostgreSQL is running
- Check database credentials in `.env` file
- Ensure the database exists

### CSS Not Loading
- Run `npm run build` to compile Tailwind CSS
- Check that `public/css/output.css` is generated

### Session Issues
- Ensure `writable/session` directory has proper permissions
- Clear browser cookies and try again

### Port Already in Use
- Change the port: `php spark serve --port=8081`

## License

This project is built with CodeIgniter 4. For more information, visit the [CodeIgniter documentation](https://codeigniter.com/user_guide/).

## Support

For issues and feature requests, please refer to the project documentation or the CodeIgniter 4 user guide.
