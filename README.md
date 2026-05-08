# 🛠️ TomoTrack

Web application designed to manage stock, tool tracking, and movement between locations.

TomoTrack allows companies to register tools and materials, control stock levels, and track movements between different locations such as warehouses, construction sites, or settlements.

The project focuses on building a scalable backend-oriented system using Laravel as an API-first application, emphasizing modular architecture, maintainability, and real-world business logic.

## 🧰 Tech Stack 
- Laravel 
- Laravel Breeze API 
- Laravel Modules 
- MySQL / SQLite 

## 🎯 Purpose 
This project was built to practice: 
- API-first backend development with Laravel 
- Modular architecture using Laravel Modules 
- Inventory and stock management systems 
- Tool movement and traceability 
- Business-oriented application structure 
- Authentication and protected API endpoints 
- Scalable system design for future expansion 

## 🚧 Planned Features Current focus: 
- Tool and material management 
- Stock control 
- Movement history between locations 
- Warehouse / construction site tracking 

Possible future expansions: 
- Construction/project management 
- Employee management 
- Multi-company support (multi-tenant architecture)
- Permissions and role systems 
- Reports and analytics 

At the moment, the system is designed for a single company environment. 

--- 

# ⚙️ Installation 
Follow these steps to run the project locally.

## Requirements 
Make sure you have installed: 
- PHP 8+ 
- Composer 
- Node.js & npm 
- MySQL **or** SQLite 

--- 

## 1. Clone the repository
```bash
git clone https://github.com/marto07/tomo-track.git
cd tomo-track
```

## 2. Install dependencies

```bash
composer install
npm install
```

## 3. Configure environment Copy the example environment file:
```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

## 4. Configure database You can use MySQL or SQLite. Option A — MySQL Create a database and update .env:

```bash
DB_CONNECTION=mysql
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Option B — SQLite (recommended for quick setup) Update .env:

```bash
DB_CONNECTION=sqlite
```

## 5. Run migrations and optionally seed the database

```bash
php artisan migrate
php artisan db:seed # optional
```
## 6. Start development server
```bash
composer run dev
```

This will run the Laravel API server and Vite development server. 

# 🔐 Authentication 
This project uses Laravel Breeze API authentication. Basic features included: 
- Login Register 
- Token-based authentication 
- Protected API routes 
- Email verification