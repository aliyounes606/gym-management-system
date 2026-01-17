# 🏋️‍♂️Gym Management System

## 📝 Introduction
**Gym Management System** is a Laravel-based web application that helps manage gym operations such as courses, trainers, categories, and sessions. It provides a clean API and Blade views with unified responses, making the system scalable, maintainable, and easy to use for both administrators and users.

## 📸 Screenshots

![ Welcome Page ](docs/images/1.png)
![login page ](docs/images/2.png)
![admin dashbord](docs/images/3.png)
![admin stats](docs/images/4.png)
![trainer dashboard](docs/images/5.png)
![Training Sections](docs/images/6.png)
![meal section](docs/images/7.png)
![review section](docs/images/8.png)
## 📝 Project Review

The Gym Management System is a full-stack Laravel application designed to manage all core gym operations,
including user management, trainers, gym sessions, bookings, attendance,
meal plans, reviews, and monthly reports.
It provides a web-based admin dashboard and a RESTful API for members and trainers.
The system focuses on scalability, security, and real-world business logic.

## ⚙️ Project Properties

-   🧱 Framework: Laravel 12
-   💻 Programming Language: PHP 8.2
-   🏗 Architecture: MVC (Model-View-Controller)
-   🔐 Authentication: Laravel Sanctum
-   🧩 Authorization: Role-Based Access Control (Spatie Laravel Permission)
-   🗄 Database: MySQL
-   🔗 API Type: RESTful API
-   🎨 Frontend: Blade Templates with Tailwind CSS
-   📄 Reporting: PDF Generation (DomPDF)
-   🤖 External Services: Telegram Bot API

## 📦 Installation

1. 📥 Clone the repository:

    ```bash
    git clone https://github.com/aliyounes606/gym-management-system.git
    ```

2. 📂 Navigate to the project directory:

    ```bash
    cd gym-management-system
    ```

3. 📦 Install backend dependencies:

    ```bash
    composer install
    ```

4. 🎨 Install frontend dependencies:

    ```bash
    npm install
    ```

    ## 🛠 Setup

5. 📄 Create environment file:

    ```bash
    cp .env.example .env
    ```

6. 🔑 Generate application key:

    ```bash
    php artisan key:generate
    ```

7. 🗄 Configure database credentials inside the .env file.

8. 📊 Run database migrations and seeders:

    ```bash
    php artisan migrate --seed
    ```

9. 🔗 Create storage symbolic link:

    ```bash
    php artisan storage:link
    ```

    ## ▶️ Run the Application

🚀 Start the Laravel development server:

```bash
php artisan serve
```

🎨 Compile frontend assets:

```bash
npm run dev
```

## 📦 Packup

Before submitting or deploying the project:

🧹 Clear and cache configuration:

```bash
php artisan config:cache
```

🛣 Cache application routes:

```bash
php artisan route:cache
```

👁 Cache compiled views:

```bash
php artisan view:cache
```

⚠️ Ensure production environment settings:
APP_ENV=production
APP_DEBUG=false

---

## 🔐 Sample Credentials

You can use the following credentials to test the system's different roles:

| Role | Email | Password |
| **Admin** | admin@gym.com | 12345678 |
 
## 🤖 Telegram Bot Token :

TELEGRAM_BOT_TOKEN=8258617852:AAGKhHi27UdPSoJtjLzz46O5Z-HIvXEiSIM

## 🤝 Support & Contributions
This project was developed and documented by the following team members:

* **Lilian:** Managed sessions, courses, and project visuals.
* **Amr:** Handled booking system, payments, and table of contents.
* **Kinda:** Managed equipment, media, and system setup guide.
* **Ali:** Developed authentication, ratings, and API documentation.
* **Mahmoud:** Developed meal planning system and project credentials.

---

## 🏆 Acknowledgments

### 🎉 Special Thanks

**Focal X Agency**
We are deeply grateful for their unwavering commitment to student growth and for providing such valuable learning opportunities.

###  Mentors

* **Mr. Hashim Othman:** For his exceptional technical guidance, clarifying complex concepts, and providing inspirational mentorship.
* **Mr. Ayham Ibrahim:** For his continuous support and encouragement throughout the entire development phase.

###  Supervisors

* **Ms. Nourhan Almohammed & Ms. Muna Alrays:** For their dedicated technical support and consistent daily follow-up.

###  Focal X Team
A huge thank you to the entire **Focal X Team** for building and supporting this educational journey.

**Special recognition to CEO and Founder:** **Alaa Darwish**
