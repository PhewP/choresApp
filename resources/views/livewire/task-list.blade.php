    @if( isset($taskList) && !$taskList->isEmpty())
    @foreach($taskList as $task)
    <div style="margin-bottom: 30px;">
        <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
            <div class="feed-text px-2">
                <div>
                    <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div>
        Todavía no hay tareas creadas en su provincia! sea el primero!
    </div>
    @endif