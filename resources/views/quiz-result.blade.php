<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Result
    </x-slot>

    <div class="card">
        <div class="card-body">

            <h3>Score: <strong>{{$quiz->myResult->point}}</strong></h3>
            <div class="alert bg-light">
                <i class="fa fa-circle"></i> Your choose <br>
                <i class="fa fa-check text-success"></i> Correct answer <br>
                <i class="fa fa-times text-danger"></i> Wrong answer
            </div>

            @foreach($quiz->questions as $question)
                @if($question->correct_answer == $question->myAnswer['answer'])
                    <i class="fa fa-check text-success"></i>
                @else
                    <i class="fa fa-times text-danger"></i>
                @endif
                <strong> #{{$loop->iteration}}. </strong>
                {{$question->question}}
                @if($question->image)
                    <img style="width: 45%" src="{{asset($question->image)}}" alt="" class="img-responsive">
                @endif
                <br>
                <small>Participants were given <strong>{{$question->true_percent}}%</strong> correct answer to this
                    question.</small>

                <div class="form-check mt-2">
                    @if('answer1' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif('answer1' == $question->myAnswer->answer)
                        <i class="fa fa-circle"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{$question->id}}1">
                        {{$question->answer1}}
                    </label>
                </div>

                <div class="form-check">
                    @if('answer2' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif('answer2' == $question->myAnswer->answer)
                        <i class="fa fa-circle"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{$question->id}}2">
                        {{$question->answer2}}
                    </label>
                </div>

                <div class="form-check">
                    @if('answer3' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif('answer3' == $question->myAnswer->answer)
                        <i class="fa fa-circle"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{$question->id}}3">
                        {{$question->answer3}}
                    </label>
                </div>

                <div class="form-check">
                    @if('answer4' == $question->correct_answer)
                        <i class="fa fa-check text-success"></i>
                    @elseif('answer4' == $question->myAnswer->answer)
                        <i class="fa fa-circle"></i>
                    @endif
                    <label class="form-check-label" for="quiz{{$question->id}}4">
                        {{$question->answer4}}
                    </label>
                </div>

                @if(!$loop->last)
                    <hr>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
