# Purchase Invoice Management System

A modern and user-friendly Laravel-based application to manage purchase invoices.  
Easily handle categories, suppliers, products, and generate invoice summaries with tax, transport, and loading charges.

## 🚀 Features

- 📅 Create, view, edit, and delete purchase invoices  
- 🏷️ Manage product categories and suppliers  
- 📦 Add multiple products with quantity and price  
- 🧾 Auto-calculated gross, tax, and net totals  
- 🗒️ Add notes for each invoice  
- 📋 View invoice summaries with full details  
- ✨ Clean and modern UI with custom CSS (no Bootstrap)

## 🛠️ Built With

- [Laravel 10](https://laravel.com/)
- PHP 8+
- Custom CSS (No Bootstrap)
- MySQL / MariaDB

## 📸 Screenshots

![Create Invoice Screenshot](screenshots/create-invoice.png)
![Invoice List Page](screenshots/invoice-list.png)
![Invoice Detail Page](screenshots/invoice-detail.png)

## 📦 Installation

```bash
# Clone the repo
git clone https://github.com/ASHIF1208/purchase-invoice-laravel.git

# Navigate to project directory
cd purchase-invoice-laravel

# Install dependencies
composer install

# Copy .env and generate key
cp .env.example .env
php artisan key:generate

# Set your database credentials in .env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# Start the server
php artisan serve