<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $appends = ['true_percent'];

    public function getTruePercentAttribute()
    {
        $answerCount = $this->answers()->count();
        $trueAnswer = $this->answers()->where('answer', $this->correct_answer)->count();
        return round((100 / $answerCount) * $trueAnswer);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function myAnswer()
    {
        return $this->hasOne(Answer::class)->where('user_id', auth()->id());
    }
}
