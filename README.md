# Job Board - Laravel Job Portal

A modern job board application built with Laravel that connects job seekers with employers. This platform allows users to browse jobs, apply for positions, and enables companies to post job opportunities.

## 🎯 Project Overview

This is a comprehensive job portal that serves three main user types:

-   **Job Seekers**: Browse and apply for jobs, manage profiles
-   **Employers/Companies**: Post job listings, manage applications
-   **Administrators**: Manage the platform, approve company requests, manage tags

## ✨ Features

### For Job Seekers

-   Browse available job listings with advanced search
-   Apply to jobs with one click
-   Create and manage user profiles
-   Add skills/tags to profile
-   View job details and company information

### For Employers/Companies

-   Post new job listings with detailed information
-   Manage job applications and view applicants
-   Edit and delete job postings
-   Featured job options for better visibility

### For Administrators

-   Approve/reject company registration requests
-   Manage job tags and categories
-   Platform oversight and management

### General Features

-   Advanced search functionality for jobs and companies
-   Tag-based job categorization
-   Responsive design with Tailwind CSS
-   User authentication and authorization
-   Role-based access control

## 🛠️ Technologies Used

### Backend

-   **Laravel 12** - PHP web framework
-   **PHP 8.2+** - Server-side language
-   **MySQL/SQLite** - Database
-   **Laravel Eloquent** - ORM for database operations

### Frontend

-   **Tailwind CSS 4** - Utility-first CSS framework
-   **Vite** - Build tool and development server
-   **Blade Templates** - Laravel's templating engine
-   **Axios** - HTTP client for API requests

### Development Tools

-   **Laravel Sail** - Docker development environment
-   **Laravel Pint** - PHP code style fixer
-   **PHPUnit** - Testing framework
-   **Laravel Pail** - Application debugging

## 📋 Prerequisites

Before running this project, make sure you have the following installed:

-   **PHP 8.2 or higher**
-   **Composer** (PHP package manager)
-   **Node.js** (for frontend assets)
-   **MySQL** or **SQLite** database
-   **Git**

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd pixel-positions
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database

Edit the `.env` file and set your database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Or for SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run build
```

### 8. Start the Development Server

```bash
# Start Laravel development server
php artisan serve

# Or use the combined development script
composer run dev
```

The application will be available at `http://localhost:8000`

## 📡 API Endpoints

### Public Routes

-   `GET /` - Home page with featured jobs
-   `GET /jobs` - Browse all jobs
-   `GET /jobs/{job}` - View specific job details
-   `GET /companies` - Browse companies
-   `POST /search` - General search functionality
-   `POST /jobs/search` - Search jobs specifically
-   `POST /companies/search` - Search companies specifically

### Authentication Routes

-   `GET /register` - User registration form
-   `POST /register` - Register new user
-   `GET /login` - Login form
-   `POST /login` - User login
-   `DELETE /logout` - User logout

### Protected Routes (Require Authentication)

#### User Routes (Role: user)

-   `POST /jobs/{job}/apply` - Apply for a job
-   `GET /companies/request` - Request to become a company
-   `POST /companies/request` - Submit company request

#### Company Routes (Role: company)

-   `GET /job/create` - Create job form
-   `POST /job/create` - Store new job

#### Admin Routes (Role: admin)

-   `GET /admin` - Admin dashboard
-   `POST /tag/store` - Create new tag
-   `GET /admin/company-requests` - View company requests
-   `PATCH /admin/company-requests/{request}/approve` - Approve company request
-   `PATCH /admin/company-requests/{request}/reject` - Reject company request

#### Common Protected Routes

-   `GET /profile` - User profile
-   `GET /profile/{user}` - View specific user profile
-   `PATCH /profile` - Update profile
-   `PATCH /profile/tags` - Update profile tags
-   `GET /companies/{company}` - View company details
-   `GET /job/applications/{job}` - View job applicants
-   `GET /job/{job}/edit` - Edit job form
-   `PATCH /job/{job}` - Update job
-   `DELETE /job/{job}` - Delete job

## 🗄️ Database Structure

### Main Tables

-   **users** - User accounts with roles (user, company, admin)
-   **jobs** - Job listings with details
-   **employers** - Company/employer information
-   **tags** - Skills and job categories
-   **applications** - Job applications (pivot table)
-   **company_requests** - Pending company registration requests

### Key Relationships

-   Users can have different roles (user, company, admin)
-   Jobs belong to employers
-   Jobs can have multiple tags
-   Users can apply to multiple jobs
-   Companies must be approved by admins

## 🎨 Frontend Structure

The application uses:

-   **Blade templates** for server-side rendering
-   **Tailwind CSS** for styling
-   **Component-based architecture** with reusable UI components
-   **Responsive design** for mobile and desktop
