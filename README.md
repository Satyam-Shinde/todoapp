# To-Do Management System

## Overview
The To-Do Management System is a web-based application that allows users to manage their daily tasks. It provides features to add, edit, remove, and view tasks, ensuring a smooth task management experience.

---

## Requirements
To successfully set up and run this project, ensure the following prerequisites are met:

- **Operating System**: Windows 10 or later.
- **XAMPP**:
  - PHP version: 7.4 or higher
  - MySQL version: 5.7 or higher
  - Apache Server
- **Browser**: Any modern browser (e.g., Chrome, Firefox, Edge).

---

## Installation and Setup

### Step 1: Extract the Project
1. Download the project files as a ZIP archive.
2. Extract the folder into the following directory:

### Step 2: Import the SQL Files
1. Open the XAMPP Control Panel and start the **MySQL Server**.
2. Navigate to `http://localhost/phpmyadmin` in your browser.
3. Create a new database (e.g., `todo_app`).
4. Import the provided SQL file into the newly created database:
- Click on the database.
- Go to the **Import** tab.
- Upload the SQL file (e.g., `todo_app.sql`).
- Click **Go**.

### Step 3: Start Apache and MySQL Server
1. Open the XAMPP Control Panel.
2. Start the following services:
- Apache Server
- MySQL Server

### Step 4: Run the Project
1. Open your browser.
2. Navigate to the project URL:
Replace `<project-folder-name>` with the name of the extracted folder.

---

## Features
- **User Registration**: Sign up with your email and password.
- **Login System**: Secure user authentication.
- **Task Management**:
- Add tasks.
- Edit tasks.
- Remove tasks.
- View all tasks.
- **User-Specific Data**: Tasks are stored and displayed per user.

---

## File Structure
- **`config/`**: Contains database configuration and login/signup handling scripts.
- **`Dashboard.php`**: Main dashboard page for managing tasks.
- **`login.php`**: User login page.
- **`signup.php`**: User registration page.
- **`logout.php`**: Handles user logout.

---

## Notes
- Ensure the `Apache` and `MySQL` services are running in XAMPP before accessing the application.
- Use the same database credentials as configured in the `config` directory scripts.

---

## Support
If you encounter any issues, please feel free to contact the project maintainer or refer to the documentation provided.

---

## License
This project is licensed under the [MIT License](LICENSE).

---

Enjoy using the To-Do Management System!
