    <div>
        @if(isset($taskListId) && count($taskListId) > 0)
        @foreach($taskListId as $taskId)
        <div>
            @livewire('task-card', ['taskId'=> $taskId], key($taskId))
        </div>
        @endforeach
        @if(isset($taskList))
        {{$taskLists->render()}}
        @endif
        @else
        <div style="margin-bottom: 30px;">
            <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border">
                <div class="feed-text px-2">
                    <div>
                        Todavía no hay tareas creadas en su provincia! sea el primero!
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>