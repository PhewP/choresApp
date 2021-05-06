<div style="margin-bottom: 30px;">
    <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
        <div class="feed-text px-2">
            @foreach($taskList as $task)
                <div>
                    <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                </div>
            @endforeach
        </div>
    </div>
</div>