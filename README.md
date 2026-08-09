# 🏁 Dagan360 Race Tracking System

Dagan360 is a web-based race checkpoint management application built with PHP, CodeIgniter 4, and MySQL. It helps event organizers manage runners, assign checkpoint watchers, record runner progress at checkpoints, and display a live leaderboard for participants and spectators.

## 🚀 Project Overview

The system is designed for timed race events where runners move through multiple checkpoints. Admin users manage the core race data, watcher users log runner arrivals at their assigned checkpoint, and the public can view the current standings through a dynamic leaderboard.

## 👥 User Roles

### Admin
- Manage runners, watchers, and checkpoints
- View the admin dashboard and race activity
- Review race logs and reports
- Update profile information

### Watcher
- Record runners as they pass a designated checkpoint
- View entries recorded for that checkpoint
- Edit or remove entries when needed

### Public Viewer
- View the live leaderboard from the homepage

## ✨ Key Features

| Feature | Description |
| --- | --- |
| Admin Dashboard | Monitor race activity, recent runner logs, and system overview. |
| Runner Management | Register, update, and remove runners from the database. |
| Watcher Management | Create watcher accounts and assign them to checkpoints. |
| Race Logging | Record runner progress at checkpoints in real time. |
| Live Leaderboard | Display the latest standings and checkpoint updates for the public. |
| Authentication | Secure login with role-based access for admin and watcher users. |

## 🏗️ System Architecture

The project follows the Model-View-Controller (MVC) architecture provided by CodeIgniter 4.

- Controllers handle requests, routing, and business logic.
- Models manage database operations for runners, checkpoints, race logs, and users.
- Views render the admin dashboard, watcher pages, and public leaderboard.
- Routes define how users access the admin, watcher, and public areas.

## 🛠️ Technologies Used

- PHP 8.1+
- CodeIgniter 4
- MySQL / MariaDB
- Composer
- HTML, CSS, and JavaScript

## 🗄️ Database

The application uses a MySQL database with the following main tables:

- checkpoints
- runners
- users
- race_logs

A ready-to-import database dump is available at [dagan360.sql](dagan360.sql).

## 🔐 Demo Credentials

Use the following account to access the administrator features:

| Account | Credentials |
| --- | --- |
| Username | admin |
| Password | password |
| Role | Administrator |

> Note: These credentials are intended for local/demo use only.

## 💻 Installation and Setup

### 1. Requirements

Make sure the following are installed:

- PHP 8.1 or higher
- Composer
- MySQL / MariaDB
- A local web server such as XAMPP or Laragon

### 2. Install dependencies

Run the following command in the project root:

```bash
composer install
```

### 3. Configure the environment

Update the database settings in the project .env file.

Example:

```env
database.default.hostname = localhost
database.default.database = dagan360
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 4. Create the database

Create a MySQL database named dagan360 and import [dagan360.sql](dagan360.sql).

You can do this with phpMyAdmin or from the terminal:

```bash
mysql -u root -p dagan360 < dagan360.sql
```

### 5. Start the application

Run:

```bash
php spark serve
```

Then open:

```text
http://localhost:8080
```

### 6. Log in

- Visit /auth
- Sign in with the seeded admin account from the SQL dump

## 🧭 Main Routes

- / - Public leaderboard
- /auth - Login page
- /admin - Admin dashboard
- /admin/runners - Runner management
- /admin/watchers - Watcher management
- /watcher - Watcher checkpoint entry screen

## 📸 Screenshots

- Login screen: [screenshots/login.png](screenshots/login.png)
- Public leaderboard: [screenshots/leaderboard.png](screenshots/leaderboard.png)

## 📄 License

This project is licensed under the terms described in [LICENSE](LICENSE).
