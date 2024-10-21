<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = '1|3CQdsnimpnTfpC8LNjW06wG8F1jvrF5ZzKrtN81881beba35';

        $tokenParts = explode('|', $token);
        $tokenId = $tokenParts[0];

        // Create the token in the database
        PersonalAccessToken::create([
            'id' => $tokenId,
            'tokenable_type' => User::class,
            'tokenable_id' => $user->id,
            'name' => 'auth_token',
            'token' => hash('sha256', $tokenParts[1]),
            'abilities' => ['*'],
        ]);
    }
}
