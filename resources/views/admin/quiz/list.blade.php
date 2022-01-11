<x-app-layout>
    <x-slot name="header">
        Quizzes
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title" align="right">
                <a href="{{route('quizzes.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create
                    Quiz</a>
            </h5>
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" placeholder="quiz name" value="{{request()->get('title')}}" name="title"
                               class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select name="status" onchange="this.form.submit()" class="form-control">
                            <option value="">Choose Status</option>
                            <option @if(request()->get('status') == 'publish') selected @endif value="publish">Active
                            </option>
                            <option @if(request()->get('status') == 'draft') selected @endif value="draft">Draft
                            </option>
                            <option @if(request()->get('status') == 'passive') selected @endif value="passive">Passive
                            </option>
                        </select>
                    </div>
                    @if(request()->get('title') || request()->get('status'))
                        <div class="col-md-2">
                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary btn-sm">Reset</a>
                        </div>
                    @endif
                </div>
            </form>
            <br>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Quiz</th>
                    <th scope="col">Question count</th>
                    <th scope="col">Status</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Process</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quizzes as $item)
                    <tr>
                        <td scope="row">{{$item->title}}</td>
                        <td>{{$item->questions_count}}</td>
                        <td>
                            @switch($item->status)
                                @case('publish')
                                @if(!$item->finished_at)
                                    <span>Active</span>
                                @elseif($item->finished_at >now())
                                    <span>Active</span>
                                @else
                                    <span>Time is finished</span>
                                @endif
                                @break
                                @case('passive')
                                <span>Passive</span>
                                @break
                                @case('draft')
                                <span>Draft</span>
                                @break
                            @endswitch
                        </td>
                        <td>
                            <span title="{{$item->finished_at}}">
                                {{ $item->finished_at ? $item->finished_at->diffForHumans() : '-'}}
                            </span>
                        </td>
                        <td>
                            <a href="{{route('quizzes.details',$item->id)}}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-info-circle"></i>
                            </a>
                            @if(now() < $item->finished_at)
                                <a href="{{route('questions.index',$item->id)}}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-question"></i>
                                </a>
                            @endif
                            <a href="{{route('quizzes.edit',$item->id)}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="{{route('quizzes.destroy',$item->id)}}" class="btn btn-sm btn-danger">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$quizzes->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
