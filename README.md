# 🏡 Travella - Airbnb-Inspired Booking Platform

**Travella** is a Laravel-based web application that allows users to discover, list, and book accommodations across Malaysia — similar in concept to Airbnb. Built with a focus on modern UI and local usability.

---

## 🚀 Features

- 🔍 Search and filter listings by location and price
- 📸 Upload photos for each listing
- 🏷️ Status tracking for listings (active/inactive)
- 🢁 User authentication
- 🗂️ Admin dashboard
- 💬 Contact form
- 🗕️ Bookings system

---

## 🧑‍💻 Local Development Setup

### ✅ Prerequisites

Install the following:

- PHP ≥ 8.1
- Composer
- Node.js & npm
- MySQL or compatible DB
- Git
- Laravel CLI *(optional)*

---

### 📦 Installation Steps

1. **Clone the repository**

```bash
git clone https://github.com/your-username/travella.git
cd travella
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install frontend dependencies**

```bash
npm install
npm run dev
```

4. **Copy and set up **``** file**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Set your database credentials** in `.env`

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travella_db
DB_USERNAME=root
DB_PASSWORD=
```

6. **Import sample database (optional)**

You can use the provided sample SQL file located in `database/sample/travella_sample.sql`:

If using MySQL CLI:

```bash
mysql -u root -p travella_db < database/sample/travella_sample.sql
```

Or use phpMyAdmin to import the file.

7. **Run migrations (optional if using sample DB)**

```bash
php artisan migrate
```

8. **Serve the application**

```bash
php artisan serve
```

Then visit: [http://localhost:8000](http://localhost:8000)

---

