# Financial Year Calculator

The Financial Year Calculator is a single-page Laravel application that determines the financial year based on the selected year and country (UK or Ireland). It also displays holidays occurring within that financial year, excluding weekends (Saturday and Sunday).

1. **Clone the repository**

```bash
git clone https://github.com/nihal-kp/financial-year-calculator.git
```

2. **Navigate into the project directory**

```bash
cd financial-year-calculator
```

3. **Install Dependencies**

```bash
composer install
```

4. **Set Up Environment File**

Copy the example environment file and edit the `.env` file to match your database configuration:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other necessary configuration.

5. **Generate Application Key**

```bash
php artisan key:generate
```

6. **Run Migrations**

```bash
php artisan migrate
```

7. **Serve the Application**

```bash
php artisan serve
```

You can now access the application at `http://localhost:8000`.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Contact

For any questions or issues, please contact [nihal44.kp@gmail.com](mailto:nihal44.kp@gmail.com).