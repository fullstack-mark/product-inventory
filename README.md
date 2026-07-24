# Product Inventory

A Simple Product Inventory built with Laravel 13, Vue 3, Vite, Tailwind CSS, and MySQL for technical assessment.

# Features

# Products

- View all products
- Add product
- Edit product
- Enable product
- Disable product

# Orders

- Display Order ID
- Display Product Name
- Display Price
- Display total order amount


# Tech Stack

# Backend

- Laravel 13
- PHP 8
- MySQL

# Frontend

- Vue 3
- Vite
- Axios
- Tailwind CSS


# Requirements (Any local web server: XAMPP, Laragon, WAMP etc.)

My current local web server: XAMPP

- Open XAMPP, Run Mysql and Apache

- Visit PhpMyAdmin to your web browser: 
    - http://localhost/phpmyadmin/   

- Create DATABASE: product_inventory


# Installation

# Clone repository

```bash
git clone https://github.com/fullstack-mark/product-inventory
```

Backend

```bash
cd backend

composer install

cp .env.example .env

php artisan key:generate
```

Update your `.env` database configuration.

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

Start Laravel:

```bash
php artisan serve
```

Frontend

```bash
cd frontend

npm install

npm run dev
```

# API Endpoints

# Products

| Method | Endpoint |
|---------|----------|
| GET | /api/products |
| POST | /api/products |
| PUT | /api/products/{id} |
| PATCH | /api/products/{id}/enable |
| PATCH | /api/products/{id}/disable |

# Orders

| Method | Endpoint |
|---------|----------|
| GET | /api/orders |

---

# Project Structure
Inside Product-Inventory
```
backend/
frontend/
README.md
.gitignore
```

# Author
Mark Cabael