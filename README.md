# Rick & Morty Log

Aplikasi mobile berbasis Flutter dan Laravel REST API untuk menjelajahi karakter dari serial Rick and Morty serta mengelola koleksi karakter secara pribadi.

Rick & Morty Log mengintegrasikan Rick and Morty Public API dengan backend Laravel untuk menyediakan fitur autentikasi, pengelompokan karakter, dan pencatatan koleksi berdasarkan akun pengguna.

## Repositories

Proyek ini terdiri dari dua repository yang saling terintegrasi:

| Repository                                                                                 | Teknologi | Deskripsi                                     |
| ------------------------------------------------------------------------------------------ | --------- | --------------------------------------------- |
| [rick-and-morty-log-backend](https://github.com/Rehan-Ramadhan/rick-and-morty-log-backend) | Laravel   | REST API, autentikasi, dan manajemen database |
| [rick-and-morty-log-app](https://github.com/Rehan-Ramadhan/rick-and-morty-log-app)         | Flutter   | Aplikasi frontend dan antarmuka pengguna      |

## Features

- **Authentication** — Registrasi, login, profil pengguna, dan logout menggunakan Laravel Sanctum.
- **Character Exploration** — Menjelajahi karakter Rick and Morty melalui Public API.
- **Character Details** — Menampilkan informasi karakter secara lengkap.
- **Dimension Management** — Mengelola kategori koleksi karakter.
- **Character Logs** — Menyimpan karakter beserta catatan pribadi.
- **User Data Isolation** — Memastikan setiap pengguna hanya dapat mengakses data koleksinya sendiri.
- **Collection Integration** — Menyimpan karakter dari Public API langsung ke koleksi pribadi.

## Tech Stack

### Backend

- PHP 8.3+
- Laravel 13
- Laravel Sanctum
- MySQL
- RESTful API

### Frontend

- Flutter
- Dart
- HTTP
- Shared Preferences

### External API

- [Rick and Morty API](https://rickandmortyapi.com/)

## Database Structure

Aplikasi menggunakan tiga tabel utama:

| Table        | Description                                     |
| ------------ | ----------------------------------------------- |
| `users`      | Menyimpan data akun pengguna                    |
| `dimensions` | Menyimpan kategori koleksi milik pengguna       |
| `char_logs`  | Menyimpan karakter dan catatan koleksi pengguna |

### Entity Relationships

- One User has many Dimensions.
- One User has many Character Logs.
- One Dimension has many Character Logs.
- Each Character Log belongs to one User and one Dimension.

## API Endpoints

### Authentication

| Method | Endpoint        | Description            | Access    |
| ------ | --------------- | ---------------------- | --------- |
| POST   | `/api/register` | Register account       | Public    |
| POST   | `/api/login`    | Login account          | Public    |
| GET    | `/api/user`     | Get authenticated user | Protected |
| POST   | `/api/logout`   | Logout account         | Protected |

### Dimensions

| Method    | Endpoint               | Description          |
| --------- | ---------------------- | -------------------- |
| GET       | `/api/dimensions`      | Get all dimensions   |
| POST      | `/api/dimensions`      | Create dimension     |
| GET       | `/api/dimensions/{id}` | Get dimension detail |
| PUT/PATCH | `/api/dimensions/{id}` | Update dimension     |
| DELETE    | `/api/dimensions/{id}` | Delete dimension     |

### Character Logs

| Method    | Endpoint              | Description              |
| --------- | --------------------- | ------------------------ |
| GET       | `/api/char-logs`      | Get all character logs   |
| POST      | `/api/char-logs`      | Create character log     |
| GET       | `/api/char-logs/{id}` | Get character log detail |
| PUT/PATCH | `/api/char-logs/{id}` | Update character log     |
| DELETE    | `/api/char-logs/{id}` | Delete character log     |

All protected endpoints require a valid Bearer Token obtained through Laravel Sanctum.

## Installation

### Requirements

- PHP 8.3 or later
- Composer
- MySQL
- Laravel 13 compatible environment

### 1. Clone Repository

```bash
git clone https://github.com/Rehan-Ramadhan/rick-and-morty-log-backend.git
```

```bash
cd rick-and-morty-log-backend
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
```

Configure the database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rick_morty_log
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations

```bash
php artisan migrate
```

### 6. Start Development Server

```bash
php artisan serve
```

Backend API will be available at:

```text
http://127.0.0.1:8000
```

## Project Architecture

```text
rick-morty-log-backend/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
├── database/
│   └── migrations/
├── routes/
│   ├── api.php
│   └── web.php
├── config/
├── public/
├── resources/
├── storage/
├── tests/
├── .env.example
├── artisan
└── composer.json
```

## Related Project

Frontend application:

**[Rick & Morty Log App - Flutter](https://github.com/Rehan-Ramadhan/rick-and-morty-log-app)**

## Developer

**Rehan Ramadhan**

XII Rekayasa Perangkat Lunak (RPL)

Developed as a Final Semester Practical Examination project for Mobile Application Programming and Web/API Programming.

---

_Rick & Morty Log — Explore characters, build your collection, and keep your own character logs._
