# Simple Cashier System

A basic point-of-sale (POS) cashier system built with Laravel, featuring product management and sales processing capabilities.

## Table of Contents
- [Overview](#overview)
- [Software Development Life Cycle (SDLC)](#software-development-life-cycle-sdlc)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)

## Overview

This is a simple cashier system designed for small businesses to manage products and process sales transactions. The system provides a clean, barebones interface using Bootstrap CSS for a responsive and user-friendly experience.

## Software Development Life Cycle (SDLC)

This project followed the traditional SDLC methodology with the following phases:

### 1. **Planning Phase**
- **Objective**: Create a simple cashier system with basic CRUD functionality
- **Scope Definition**: 
  - Product management (Create, Read, Update, Delete)
  - Sales processing with shopping cart
  - Sales history and receipt generation
  - Simple, barebones UI design
- **Requirements Gathering**:
  - Functional Requirements: CRUD operations, cashier interface, stock management
  - Non-functional Requirements: Simple UI, external CSS usage, responsive design
- **Technology Stack Selection**: Laravel framework, MySQL database, Bootstrap CSS

### 2. **Analysis Phase**
- **System Analysis**:
  - Identified core entities: Products, Sales, Sale Items
  - Defined relationships between entities
  - Analyzed business workflows for sales processing
- **Database Design**:
  - Products table: id, name, price, stock, description, timestamps
  - Sales table: id, total_amount, timestamps
  - Sale_items table: id, sale_id, product_id, quantity, price, timestamps
- **User Story Definition**:
  - As a store owner, I want to manage product inventory
  - As a cashier, I want to process sales transactions
  - As a manager, I want to view sales history

### 3. **Design Phase**
- **Architecture Design**:
  - MVC (Model-View-Controller) pattern using Laravel
  - Database schema with proper foreign key relationships
  - RESTful routing structure
- **UI/UX Design**:
  - Bootstrap-based responsive design
  - Simple navigation with Products, Cashier, and Sales History
  - Interactive shopping cart interface
  - Clean receipt layout with print functionality
- **Component Design**:
  - Models: Product, Sale, SaleItem with proper relationships
  - Controllers: ProductController (resource), SaleController (custom methods)
  - Views: Blade templates with external Bootstrap CSS

### 4. **Implementation Phase**
- **Environment Setup**:
  - Laravel framework installation and configuration
  - Database connection setup
  - Migration files creation
- **Backend Development**:
  ```bash
  # Models and Migrations
  php artisan make:model Product --migration
  php artisan make:model Sale --migration
  php artisan make:model SaleItem --migration
  
  # Controllers
  php artisan make:controller ProductController --resource
  php artisan make:controller SaleController
  ```
- **Frontend Development**:
  - Blade template creation with Bootstrap CDN
  - Interactive JavaScript for shopping cart functionality
  - Responsive design implementation
- **Database Implementation**:
  - Migration execution
  - Sample data seeding for testing

### 5. **Testing Phase**
- **Unit Testing**: Model relationships and controller methods
- **Integration Testing**: Full workflow testing from product creation to sales processing
- **User Acceptance Testing**: Manual testing of all CRUD operations
- **Browser Testing**: Cross-browser compatibility verification
- **Functional Testing Scenarios**:
  - ✅ Create, edit, update, delete products
  - ✅ Add products to shopping cart
  - ✅ Process sales with stock validation
  - ✅ Generate and print receipts
  - ✅ View sales history

### 6. **Deployment Phase**
- **Local Development Server**: `php artisan serve`
- **Database Migration**: `php artisan migrate:fresh`
- **Sample Data Creation**: Product seeding via Tinker
- **Route Verification**: `php artisan route:list`
- **Application Testing**: Browser verification at `http://127.0.0.1:8000`

### 7. **Maintenance Phase**
- **Documentation**: Comprehensive README with setup instructions
- **Code Comments**: Inline documentation for complex logic
- **Version Control**: Git repository with meaningful commit messages
- **Future Enhancements**: Identified areas for improvement
  - User authentication system
  - Advanced reporting features
  - Barcode scanning capability
  - Multi-location support

## Features

### Product Management
- ✅ Add new products with name, price, stock, and description
- ✅ View all products in a responsive table
- ✅ Edit existing product information
- ✅ Delete products from inventory
- ✅ View detailed product information

### Cashier Interface
- ✅ Interactive product selection
- ✅ Shopping cart with quantity controls
- ✅ Real-time total calculation
- ✅ Stock validation during checkout
- ✅ Clear cart functionality

### Sales Management
- ✅ Process sales transactions
- ✅ Automatic stock deduction
- ✅ Sales history tracking
- ✅ Receipt generation
- ✅ Print receipt functionality

### User Interface
- ✅ Bootstrap-based responsive design
- ✅ Clean navigation menu
- ✅ Alert notifications for user feedback
- ✅ Mobile-friendly interface

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js (optional, for asset compilation)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd jokisatu
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   - Configure database credentials in `.env` file
   - Create database
   ```bash
   php artisan migrate:fresh
   ```

5. **Seed sample data**
   ```bash
   php artisan tinker
   ```
   ```php
   App\Models\Product::create(['name' => 'Coffee', 'price' => 3.50, 'stock' => 100, 'description' => 'Fresh brewed coffee']);
   App\Models\Product::create(['name' => 'Sandwich', 'price' => 8.99, 'stock' => 50, 'description' => 'Ham and cheese sandwich']);
   App\Models\Product::create(['name' => 'Soda', 'price' => 2.25, 'stock' => 75, 'description' => 'Refreshing cola drink']);
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

7. **Access application**
   Open browser and navigate to `http://127.0.0.1:8000`

## Usage

### Managing Products
1. Navigate to "Products" from the main menu
2. Click "Add Product" to create new items
3. Use "Edit" button to modify existing products
4. Use "Delete" button to remove products (with confirmation)

### Processing Sales
1. Go to "Cashier" from the main menu
2. Click "Add to Cart" on desired products
3. Adjust quantities using +/- buttons
4. Click "Process Sale" when ready
5. View generated receipt
6. Option to print receipt or start new sale

### Viewing Sales History
1. Access "Sales History" from the menu
2. View all completed transactions
3. Click "View Receipt" to see transaction details

## Project Structure

```
jokisatu/
├── app/
│   ├── Http/Controllers/
│   │   ├── ProductController.php    # Product CRUD operations
│   │   └── SaleController.php       # Sales processing
│   └── Models/
│       ├── Product.php              # Product model with relationships
│       ├── Sale.php                 # Sale model
│       └── SaleItem.php             # Sale item model
├── database/
│   └── migrations/
│       ├── create_products_table.php
│       ├── create_sales_table.php
│       └── create_sale_items_table.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php            # Main layout with Bootstrap
│   ├── products/                    # Product management views
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── sales/                       # Sales management views
│       ├── index.blade.php
│       ├── cashier.blade.php
│       └── receipt.blade.php
├── routes/
│   └── web.php                      # Application routes
└── README.md                        # This file
```

## Technologies Used

- **Backend**: Laravel 12.x (PHP Framework)
- **Frontend**: Blade Templates, Bootstrap 5.3.0 (CDN)
- **Database**: MySQL/MariaDB
- **JavaScript**: Vanilla JS for cart functionality
- **Styling**: Bootstrap CSS (External CDN)
- **Version Control**: Git

## Routes

| Method | URI | Action | Description |
|--------|-----|--------|-------------|
| GET | / | Redirect to products | Home page redirect |
| GET | /products | ProductController@index | List all products |
| GET | /products/create | ProductController@create | Show create form |
| POST | /products | ProductController@store | Store new product |
| GET | /products/{product} | ProductController@show | Show product details |
| GET | /products/{product}/edit | ProductController@edit | Show edit form |
| PUT | /products/{product} | ProductController@update | Update product |
| DELETE | /products/{product} | ProductController@destroy | Delete product |
| GET | /cashier | SaleController@cashier | Cashier interface |
| POST | /sales/process | SaleController@processSale | Process sale |
| GET | /sales | SaleController@index | Sales history |
| GET | /sales/{sale}/receipt | SaleController@receipt | Show receipt |

## Database Schema

### Products Table
```sql
id (bigint, primary key)
name (varchar)
price (decimal 10,2)
stock (integer)
description (text, nullable)
created_at (timestamp)
updated_at (timestamp)
```

### Sales Table
```sql
id (bigint, primary key)
total_amount (decimal 10,2)
created_at (timestamp)
updated_at (timestamp)
```

### Sale Items Table
```sql
id (bigint, primary key)
sale_id (foreign key → sales.id)
product_id (foreign key → products.id)
quantity (integer)
price (decimal 10,2)
created_at (timestamp)
updated_at (timestamp)
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## Development Guidelines

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add comments for complex logic
- Test all functionality before committing
- Maintain responsive design principles

---

**Project Status**: ✅ Complete and Functional  
**Last Updated**: September 22, 2025  
**Version**: 1.0.0
