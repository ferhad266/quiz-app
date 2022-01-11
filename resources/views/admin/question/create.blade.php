<x-app-layout>
    <x-slot name="header">create question for {{$quiz->title}}</x-slot>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('questions.store',$quiz->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="titleId">Question</label>
                    <textarea name="question" class="form-control" id="descId"
                              rows="4">{{old('question')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="descId">Image</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleId">Answer I</label>
                            <textarea name="answer1" class="form-control" rows="2">{{old('answer1')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleId">Answer II</label>
                            <textarea name="answer2" class="form-control" rows="2">{{old('answer2')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleId">Answer III</label>
                            <textarea name="answer3" class="form-control" rows="2">{{old('answer3')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titleId">Answer IV</label>
                            <textarea name="answer4" class="form-control" rows="2">{{old('answer4')}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Correct Answer</label>
                    <select name="correct_answer" class="form-control">
                        <option @if(old('correct_answer')==='answer1') selected @endif  value="answer1">I. Answer</option>
                        <option @if(old('correct_answer')==='answer2') selected @endif  value="answer2">II. Answer</option>
                        <option @if(old('correct_answer')==='answer3') selected @endif  value="answer3">III. Answer</option>
                        <option @if(old('correct_answer')==='answer4') selected @endif  value="answer4">IV. Answer</option>
                    </select>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
