# Library Management System

![PHP](https://img.shields.io/badge/PHP-8.0+-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-purple.svg)

A complete web-based Library Management System built with PHP, MySQL, and Bootstrap for managing library operations including book tracking, member management, and transactions.

## Features

### User Roles
- **Admin**: Full system access (manage books, members, view reports)
- **Librarian**: Issue/return books, search functionality
- **Member**: View borrowed books, check fines, update profile

### Core Functionalities
- Book management (add/edit/delete)
- Member registration and management
- Book issuing and returning system
- Fine calculation for late returns
- CAPTCHA-protected authentication
- Responsive dashboard with statistics
- Email availability checking during signup
- Complaint submission system

## Technologies Used
- **Frontend**: HTML5, CSS3, Bootstrap, JavaScript, jQuery
- **Backend**: PHP 8.0+
- **Database**: MySQL 5.7+
- **Security**: MD5 password hashing, CAPTCHA verification
- **Libraries**: DataTables for reporting, CountUp.js for animations

## Installation

### Prerequisites
- Web server (Apache/Nginx)
- PHP 8.0+
- MySQL 5.7+
- Composer (for dependency management)

### Setup Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/As-Rahman/Library-Management-System.git
