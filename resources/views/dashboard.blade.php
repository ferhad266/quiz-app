<x-app-layout>
    <x-slot name="header">
        HomePage
    </x-slot>

    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($quizzes as $item)
                    <a href="{{route('quiz.detail',$item->slug)}}"
                       class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$item->title}}</h5>
                            <small>{{$item->finished_at ? $item->finished_at->diffForHumans().' finished.' : null}}</small>
                        </div>
                        <p class="mb-1">{{Str::limit($item->description,100)}}</p>
                        <small>{{$item->questions_count}}</small>
                    </a>
                @endforeach
                <div class="mt-2">
                    {{$quizzes->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Quiz Result
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($results as $result)
                        <li class="list-group-item">
                            <strong>{{$result->point}}</strong> -
                            <a href="{{route('quiz.detail', $result->quiz->slug)}}">
                                {{$result->quiz->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
