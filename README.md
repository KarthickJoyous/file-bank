## Introduction

This Laravel project consists of two panels - User and Admin. Each panel has its own set of modules for various functionalities.

### User Panel Features

1. Registration
2. Email Verification
3. Forgot Password
4. Login
5. Profile
6. Update Profile
7. Two Factor Authentication
8. Change Password
9. Delete Account
10. Logout

### Admin Panel Features

1. Login
2. Forgot Password
3. Profile
4. Update Profile
5. Two Factor Authentication
6. Change Password
7. Delete Account
8. Logout

## Project Details

- Laravel version: 10
- PHP version: 8.2

## Setup Instructions

1. Clone the repository:

    ```bash
    git clone https://github.com/KarthickJoyous/base-template-app.git
    ```

2. Navigate to the project directory:

    ```bash
    cd base-template-app
    ```

3. Install dependencies:

    ```bash
    composer update
    ```

4. Copy the example environment file and configure your environment:

    ```bash
    cp .env.example .env
    ```

    Generate an application key:

    ```bash
    php artisan key:generate
    ```

    Configure your database connection and email keys in the `.env` file.

5. Create symbolic links for storage:

    ```bash
    php artisan storage:link
    ```

6. Run migrations with seed data:

    ```bash
    php artisan migrate --seed
    ```

7. Start the queue listener:

    ```bash
    php artisan queue:listen
    ```

8. Serve the application:

    ```bash
    php artisan serve
    ```

## Admin Panel Access

- Admin Panel URL: {{app_url}}/admin/login
- Email: demo@demo.com
- Password: Demo@123

## User Panel Access

- User Panel URL: {{app_url}}/login

### Email Verified User:

- Email: demo@demo.com
- Password: Demo@123

### Email Unverified User:

- Email: test@demo.com
- Password: Demo@123

Feel free to explore the features of both panels. Happy coding!