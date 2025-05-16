# Distributor Bening's Medan E-Commerce Platform

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-%23FF2D20.svg?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=fff)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?logo=bootstrap&logoColor=fff)

This is a web-based e-commerce application for **Distributor Bening's Medan, Sumatera Utara**. It is a digital transformation of the conventional sales process into an online system, supporting both **Business-to-Business (B2B)** and **Business-to-Customer (B2C)** models.

## 📦 Project Type

- **B2B (Business to Business)**: For business partners (Mitra), product prices vary based on their partnership level.
- **B2C (Business to Customer)**: General customers see standard retail prices.

## 🧩 Tech Stack

- PHP 8.3
- Laravel 8.83
- MySQL
- Blade (Laravel templating)
- Bootstrap 4.0

## 👥 User Interfaces

- **Customer UI**: Public-facing homepage for customers and partners.
- **Admin Dashboard**: Backend interface for managing the platform.

---

## 🌐 User Features

- 🛍️ View product listing
- 🔎 Product details with images and information
- 📁 Browse products by category
- ❤️ Add/remove wishlist items
- 🛒 Add/remove items in shopping cart
- 📦 Checkout process (no payment gateway), generates downloadable PDF invoice
- 🚚 View purchase/shipping history

---

## 🛠️ Admin Features

- 🎨 **Banners Management**: Create, update, delete homepage banners
- 📦 **Product Management**: Full CRUD operations on product catalog
- 🗂️ **Category Management**: Organize products by categories
- 📥 **Purchase Management**: CRUD for incoming stock from suppliers
- 🧾 **Sales Validation**: Manage and update sales statuses (Confirmed, Processed, Shipped, Succeeded, Canceled)
- 🧑‍🤝‍🧑 **Partnership Levels**: Define and manage partner levels
- 💸 **Partnership Prices**: Set different prices based on partnership level
- 🌍 **Partnership Regions**: Assign regions to partners
- 🏭 **Suppliers Management**: CRUD suppliers data
- 👤 **User Management**: Administer user accounts
- ⚙️ **General Settings**: Update application description, logo, and contact info

---

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before installing and running this project, make sure you have the following installed on your system:

- **PHP 8.3**
- **Composer** (latest version recommended). [Download Composer](https://getcomposer.org/download/)
- **MySQL** (Relational Database). [Download MySQL](https://dev.mysql.com/downloads/)
* **Git**: For version control. Download from [https://git-scm.com/](https://git-scm.com/).

Optional (Recommended for Development):

- Laravel CLI  
    ```sh
    composer global require laravel/installer
    ```

- Local server environment:
  - Laravel Sail (Docker-based)
  - XAMPP / MAMP / WAMP
  - Laravel Valet (for macOS)
  - Docker with PHP 8.3 and MySQL support

### 📄 Installing

1. Get the source code:

    ```sh
    git clone https://github.com/dimasspanjaitan/benings.git
    ```

2. Navigate to the Project Directory:

    ```sh
    cd benings
    ```

3. Install Dependencies:

    ```sh
    composer install
    ```

4. Environment Setup:

    ```sh
    php artisan key:generate
    ```

5. Create a MySQL database named `benings`

    You can do this via your MySQL client (phpMyAdmin, MySQL Workbench, or CLI):

    ```sh
    CREATE DATABASE benings;
    ```

6. Import the Database Structure and Data

    From your MySQL client or CLI, import the benings.sql file located in the project root:

    ```sh
    mysql -u your_username -p benings < benings.sql
    ```

7. Configure Environment File

    - Copy `.env.example` to `.env`

    - Update Database Credentials and Other Relevant Settings:

    ```sh
    DB_DATABASE=benings
    DB_USERNAME=your_name
    DB_PASSWORD=your_password
    ```

8. Serve the Application

    ```sh
    php artisan serve
    ```
    
    Access the Application: Open your web browser and navigate to http://localhost:3000.

## 🛠️ Built With

This project leverages the following technologies and libraries:

- [Laravel](https://laravel.com/) — PHP web framework used for backend development  
- [Bootstrap](https://getbootstrap.com/) — Frontend CSS framework for responsive design  
- [Start Bootstrap SB Admin 2 v4.1.1](https://startbootstrap.com/theme/sb-admin-2) — Admin dashboard template used for the admin UI  
- [BTX (Btx Laravel Package)](https://github.com/bachtiarpanjaitan/btx) — Laravel helper package for flexible utilities

## 🌐 Live Demo

You can access the live version of this project here:

🔗 [benings.basapadi.com](https://benings.basapadi.com)

## 👨‍💻 Authors

See also the list of [contributors](https://github.com/dimasspanjaitan/benings/graphs/contributors) who participated in this project.

## 📄 License

Distributed under the MIT License. See LICENSE for more information.

## 📬 Contact

- Email: dimasspanjaitan123@gmail.com
- Dimas S Panjaitan: [@dimass.panjaitan](https://instagram.com/dimass.panjaitan) - dimasspanjaitan123@gmail.com
- Project Link: [benings](https://github.com/dimasspanjaitan/benings.git)

## 🙏 Acknowledgments