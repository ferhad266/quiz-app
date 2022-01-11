<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Quiz extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    protected $dates = ['finished_at'];
    protected $guarded = [];
    protected $appends = ['details', 'myRank'];


    public function getMyRankAttribute()
    {
        $rank = 0;
        foreach ($this->results()->orderByDesc('point')->get() as $result) {
            $rank++;
            if (auth()->id() === $result->user_id) {
                return $rank;
            }
        }
    }

    public function getDetailsAttribute()
    {
        if ($this->results()->count() > 0) {
            return [
                'average' => round($this->results()->avg('point')),
                'join_count' => $this->results()->count()
            ];
        }
        return null;
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function topTen()
    {
        return $this->results()->orderByDesc('point')->take(10);
    }

    public function myResult()
    {
        return $this->hasOne(Result::class)->where('user_id', auth()->id());
    }

    public function getFinishedAtAttribute($date)
    {
        return $date ? Carbon::parse($date) : null;
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
