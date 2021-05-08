@if( isset($taskCreatedList) && !$taskCreatedList->isEmpty())
<h3>Tareas creadas</h3>
    @foreach($taskCreatedList as $task)
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
        Todavía no has creado ninguna tarea.
    </div>
    @endif

    @if( isset($taskAceptedList) && !$taskAceptedList->isEmpty())
    <h3>Tareas aceptadas</h3>
    @foreach($taskAceptedList as $task)
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
        Todavía no has aceptado ninguna tarea.
    </div>
    @endif
