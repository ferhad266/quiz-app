<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeed extends Seeder
{

    public function run()
    {
        Question::factory(100)->create();
    }
}
