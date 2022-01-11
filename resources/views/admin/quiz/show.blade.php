<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p class="card-text">
            <h5 class="card-title" align="left" style="display: inline-block;">
                <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    Back
                </a>
            </h5>
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz->details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Joiner count
                                <span>{{$quiz->details['join_count']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Average score
                                <span>{{$quiz->details['average']}}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Question count
                            <span>{{$quiz->questions_count}}</span>
                        </li>
                    </ul>

                    @if(count($quiz->topTen) > 0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                    Top 10
                                </h5>
                                <ul class="list-group">
                                    @foreach($quiz->topTen as $result)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <b>{{$loop->iteration}}.</b>
                                            <img src="{{$result->user->profile_photo_url}}" class="w-8 h-8 rounded-full"
                                                 alt="">
                                            <span
                                                @if(auth()->id() == $result->user_id) class="text-success" @endif>{{$result->user->name}}</span>
                                            <span>{{$result->point}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    {{$quiz->description}}
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Name Surname</th>
                            <th scope="col">Score</th>
                            <th scope="col">Correct</th>
                            <th scope="col">Wrong</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                            <tr>
                                <td>{{$result->user->name}}</td>
                                <td>{{$result->point}}</td>
                                <td style="color: green;">{{$result->correct}}</td>
                                <td style="color: red;">{{$result->wrong}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </p>
        </div>
    </div>
</x-app-layout>
