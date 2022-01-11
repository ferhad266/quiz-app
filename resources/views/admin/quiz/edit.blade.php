<x-app-layout>
    <x-slot name="header">Update Quiz</x-slot>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('quizzes.update',$quiz->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="titleId">Title</label>
                    <input type="text" name="title" id="titleId" class="form-control" required
                           value="{{$quiz->title}}">
                </div>

                <div class="form-group">
                    <label for="descId">Description</label>
                    <textarea name="description" class="form-control" id="descId"
                              rows="4">{{$quiz->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option @if($quiz->questions_count < 4) disabled @endif
                        @if($quiz->status === 'publish') selected @endif value="publish">
                            Active
                        </option>
                        <option @if($quiz->status === 'passive') selected @endif value="passive">
                            Passive
                        </option>
                        <option @if($quiz->status === 'draft') selected @endif value="draft">
                            Draft
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="isFinished" @if($quiz->finished_at) checked @endif>
                    <label>End Time</label>
                </div>

                <div class="form-group" id="endTimeId" @if(!$quiz->finished_at) style="display: none;" @endif>
                    <input type="datetime-local" name="finished_at" class="form-control"
                           @if($quiz->finished_at) value="{{date('Y-m-d\TH:i',strtotime($quiz->finished_at))}}" @endif>
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success btn-sm btn-block">edit</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script>
            $('#isFinished').change(function () {
                if ($('#isFinished').is(':checked')) {
                    $('#endTimeId').show();
                } else {
                    $('#endTimeId').hide();
                }
            });
        </script>
    </x-slot>
</x-app-layout>
