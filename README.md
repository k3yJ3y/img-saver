# Laravel Image Upload API

This is a simple Laravel API for uploading images. It allows authenticated users to upload images.

## Features

- Upload images with a title & description.
- Retrieve uploaded image data.

## Requirements

- PHP 8.x
- Laravel 11.x
- MySQL

## Installation

1. Clone the repository and navigate to the project directory
    ```bash
    git clone https://github.com/k3yJ3y/img-saver.git
    cd img-saver
    ```
2. Copy the .env.example file to .env and configure it
    ```bash
    cp .env.example .env
    ```
   Then open the .env file and adjust the settings, particularly the database configuration.

3. Install dependencies
    ```bash
    composer install
    ```
4. Generate application key
    ```bash
    php artisan key:generate
    ```
5. Run migrations
    ```bash
    php artisan migrate
    ```
6. Seed the database
    ```bash
    php artisan db:seed
    ```
7. Run the server
    ```bash
    php artisan serve
    ```

## Usage

1. Open tinker
    ```bash
    php artisan tinker
    ```
2. Create a token and copy it (by seeding the database you created the user with email test@example.com)
    ```php
    $user = App\Models\User::where('email', 'test@example.com')->first();
    $token = $user->createToken('auth_token')->plainTextToken;
    ```
3. Use curl or postman to create a post request to the endpoint using the token use the following settings
    - Method: POST
    - URL: http://127.0.0.1:8000/api/v1/upload-image
    - Headers:
        - Authorization: Bearer {created token}
        - Content-Type: multipart/form-data;
        - Accept: application/json
        - Body:
            - title: {image title}
            - description: {image description}
            - image: {image file}

you can use curl like this

```bash
curl -X POST http://127.0.0.1:8000/api/v1/upload-image -H "Authorization: Bearer {created token}" -H "Content-Type: multipart/form-data" -H "Accept: application/json" -F "title={image title}" -F "description={image description}" -F "image=@/path/to/image.jpg"
```
