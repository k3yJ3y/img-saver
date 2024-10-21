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

### 1. Generate Authentication Token

The token was generated in the database seeder

Use this Bearer token to authenticate with the API:
```bash
1|3CQdsnimpnTfpC8LNjW06wG8F1jvrF5ZzKrtN81881beba35
```

Or you can generate a new one using Laravel Tinker:

```bash
php artisan tinker
```

Create a token for the test user (email: test@example.com):
```php
$user = App\Models\User::where('email', 'test@example.com')->first();
$token = $user->createToken('auth_token')->plainTextToken;
echo $token; // Copy this token for use in API requests
```

### 2. Upload an Image

You can use tools like cURL, Postman, or any other similar tool to upload an image (accepted formats: jpeg, png, jpg, gif, svg, webp; maximum size: 2048KB).

#### Using cURL

```bash
curl -X POST http://127.0.0.1:8000/api/v1/upload-image \
  -H "Authorization: Bearer 1|3CQdsnimpnTfpC8LNjW06wG8F1jvrF5ZzKrtN81881beba35" \
  -H "Accept: */*" \ or `Accept: application/json` \
  -F "title={IMAGE_TITLE}" \
  -F "description={IMAGE_DESCRIPTION}" \
  -F "image=@/path/to/your/image.jpg"
```

Replace `{IMAGE_TITLE}`, `{IMAGE_DESCRIPTION}`, and `/path/to/your/image.jpg` with your actual values.

#### Using Postman

1. Set the request method to `POST`
2. Enter the URL: `http://127.0.0.1:8000/api/v1/upload-image`
3. Set the following headers:
   - `Authorization: Bearer 1|3CQdsnimpnTfpC8LNjW06wG8F1jvrF5ZzKrtN81881beba35`
   - `Accept: */*` or `Accept: application/json`
4. In the Body tab, select `form-data` and add the following key-value pairs:
   - `title`: Your image title
   - `description`: Your image description
   - `image`: Select File and choose your image


### 3. Response

The API will return a JSON response with the following structure:

```json
{
  "success": "true or false indicating whether the request was successful",
  "message": "A message describing the result of the request",
  // and if the request is successful, the data will be returned in the following structure
  "data": { 
    "file_type": "The type of the uploaded file (e.g., jpeg, png)",
    "file_size": "The size of the uploaded file in bytes",
    "file_path": "The path where the uploaded file is stored",
    "file_url": "The URL to access the uploaded file"
  } 
}
```
