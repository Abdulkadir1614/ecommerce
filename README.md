🛒 SmartMart – E-Commerce Web Application
📌 Project Overview

SmartMart is a web-based e-commerce system developed to provide a secure and user-friendly online shopping experience.
The system supports customer shopping operations and administrator management functions, including product management, order processing, feedback handling, and report generation.

This project demonstrates the implementation of core e-commerce features using PHP, MySQL, Bootstrap, and JavaScript.

🎯 Objectives

To design and develop a functional e-commerce platform

To implement secure user authentication and role-based access

To provide an intuitive shopping and checkout process

To allow administrators to manage products, users, orders, and reports

To generate structured data for analysis and reporting

🧩 System Features

👤 Guest Features

View homepage and system introduction

Register a new user account

Login to the system

Browse categories (login required for shopping)


🛍️ Customer Features

Secure login and authentication

Browse products by category

Search for products

Add products to cart

View and manage cart items

Enter delivery information

Select payment method

Confirm orders

View order history

View detailed order items

Submit feedback with star rating

Update profile information

Reset password securely

Logout safely



👨‍💼 Admin Features

Secure admin login

View admin dashboard

Add, edit, and delete products

Assign categories to products

Manage product stock

View all customer orders

View order details

Manage users (remove users)

View customer feedback

Generate system reports

Manage admin profile

Reset admin password



🗂️ System Modules

Authentication Module

Product Management Module

Cart & Order Module

Payment & Delivery Module

Feedback Module

User Management Module

Admin Reporting Module


🛠️ Technologies Used

Technology	Purpose
PHP	Server-side scripting
MySQL	Database management
HTML5	Page structure
CSS3 / Bootstrap 5	Styling & responsive UI
JavaScript	Interactivity
XAMPP	Local server environment


🗃️ Database Structure (Main Tables)

users

products

orders

order_items

feedback

🔐 Security Features

Password hashing using password_hash()

Secure login with password_verify()

Prepared statements to prevent SQL injection

Role-based access control (Guest / User / Admin)

Session management and validation
