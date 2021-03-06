<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Quiz;

class MainController extends Controller
{
    public function dashboard()
    {
        $quizzes = Quiz::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('finished_at')->orWhere('finished_at', '>', now());
            })
            ->withCount('questions')
            ->paginate(5);

        $results = auth()->user()->results;

        return view('dashboard', ['quizzes' => $quizzes, 'results' => $results]);
    }

    public function quiz_detail($slug)
    {
        $quiz = Quiz::whereSlug($slug)
                ->with(['myResult', 'results', 'topTen.user'])
                ->withCount('questions')
                ->first() ?? abort(404, 'Quiz not found.');

        return view('quiz-detail', ['quiz' => $quiz]);
    }

    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)
                ->with('questions.myAnswer', 'myResult')
                ->first() ?? abort(404, 'This quiz not found.');

        if ($quiz->myResult) {
            return view('quiz-result', ['quiz' => $quiz]);
        }

        return view('quiz', ['quiz' => $quiz]);
    }

    public function result(Request $request, $slug)
    {
        $quiz = Quiz::with('questions')
                ->where('slug', $slug)
                ->first() ?? abort(404, 'Quiz not found');

        $correct = 0;

        if ($quiz->myResult) {
            abort(404, 'You already join this quiz.');
        }

        foreach ($quiz->questions as $question) {
            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer' => $request->post($question->id)
            ]);

            if ($question->correct_answer === $request->post($question->id)) {
                $correct += 1;
            }
        }

        $point = round((100 / count($quiz->questions)) * $correct);
        $wrong = count($quiz->questions) - $correct;

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => $point,
            'correct' => $correct,
            'wrong' => $wrong
        ]);

        return redirect()->route('quiz.detail', $quiz->slug)->withSuccess("Quiz was successfully finished. Score: " . $point);

    }
}
