# Student Registration & Management System

A web-based Student Registration and Management System developed using PHP, MySQL, HTML, and CSS.

## Project Overview

This application allows students to register their personal and academic details, log in, view their profile, and update their information.

An administrator can manage registered students through an Admin Dashboard.

## Technologies Used

- HTML
- CSS
- PHP
- MySQL
- XAMPP
- JavaScript


## Project Structure

student_system/
│
├── index.php
├── register.php
├── login.php
├── logout.php
├── admin_dashboard.php
├── edit_student.php
├── delete_student.php
├── student_dashboard.php
├── edit_profile.php
├── forgot_password.php
├── style.css
│
├── config/
│   └── database.php
│
└── uploads/
    └── aadhaar/

## Main Features

### Student Registration
- Student registration form
- Name, Email, Password and Date of Birth
- Gender selection
- Qualification selection
- Interests
- Class, Subject and Marks
- Aadhaar PDF upload
- Duplicate email validation

### Login System
- Single login page for students and admin
- Role-based redirection
- Session-based authentication
- Forgot Password functionality

### Admin Dashboard
- View registered students
- Search/filter by Name
- Filter by Class
- Filter by Minimum and Maximum Age
- View uploaded Aadhaar PDF
- Edit student details
- Delete student records

### Student Dashboard
- View personal and academic details
- Display User ID
- Edit profile
- Replace Aadhaar PDF
- Logout

## CRUD Operations

The system implements CRUD operations:

- **Create:** Student registration
- **Read:** Student and Admin dashboards
- **Update:** Edit student/profile details
- **Delete:** Admin can delete student records

## Database

The project uses MySQL database:

```text
Database: student_system_db
Table: students
