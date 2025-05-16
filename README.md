# 🍽️ Restaurant Management Script

This is a restaurant management script built with Laravel. It includes core features such as food category handling, product management, basic ordering logic, and dashboard structure. It's ideal as a starter boilerplate for building POS or restaurant platforms.

---

## 🛠️ Tech Stack

- Laravel 8
- PHP 7.4+
- MySQL
- Blade (for views)
- Bootstrap (for frontend)

---

## 🚀 Features

- Category and Product management (CRUD)
- Menu listing with images and prices
- Add/Edit/Delete food items
- Basic dashboard layout (admin interface)
- User authentication (optional)
- Seeded demo data
- Responsive design (basic)

---

## 📦 Installation Guide

```bash
git clone https://github.com/hesham911/resturant-script.git
cd resturant-script
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
