<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p class="card-text">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz->myRank)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Affirmative
                                <span class="text-success">{{$quiz->myRank}}</span>
                            </li>
                        @endif
                        @if($quiz->myResult)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Score
                                <span style="color: #41464b">{{$quiz->myResult->point}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Correct
                                <span style="color: green">{{$quiz->myResult->correct}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Wrong
                                <span style="color: red">{{$quiz->myResult->wrong}}</span>
                            </li>
                        @endif
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
                        @if($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Finished Time
                                <span title="{{$quiz->finished_at}}">{{$quiz->finished_at->diffForHumans() }}</span>
                            </li>
                        @endif
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
                    @if($quiz->myResult)
                        <a href="{{route('quiz.join',$quiz->slug)}}" style="width: 100%" class="btn btn-warning btn-sm">Show
                            Quiz</a>
                    @elseif($quiz->finished_at > now())
                        <a href="{{route('quiz.join',$quiz->slug)}}" style="width: 100%" class="btn btn-primary btn-sm">Join
                            Quiz</a>
                    @endif
                </div>
            </div>
            </p>
        </div>
    </div>
</x-app-layout>
