<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} questions.
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title" align="left" style="display: inline-block;">
                <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
            </h5>
            <h5 class="card-title" align="right" style="display: inline-block;">
                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i>
                    Create Question
                </a>
            </h5>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Image</th>
                    <th scope="col">I. Answer</th>
                    <th scope="col">II. Answer</th>
                    <th scope="col">III.Answer</th>
                    <th scope="col">IV. Answer</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col" style="width:100px;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($quiz->questions as $question)
                    <tr>
                        <td scope="row">{{$question->question}}</td>
                        <td>
                            @if($question->image)
                                <a href="{{asset($question->image)}}" class="btn btn-sm btn-light"
                                   target="_blank">View</a>
                            @endif
                        </td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td class="text-success">{{substr($question->correct_answer, -1)}}.- answer</td>
                        <td>
                            <a href="{{route('questions.edit',[$quiz->id,$question->id])}}"
                               class="btn btn-sm btn-primary"><i
                                    class="fa fa-pen"></i></a>
                            <a href="{{route('questions.destroy',[$quiz->id,$question->id])}}"
                               class="btn btn-sm btn-danger"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
