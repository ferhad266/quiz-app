<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            QuizSeeder::class,
            QuestionSeed::class,
            AnswerSeeder::class,
            ResultSeeder::class,
        ]);
    }
}
