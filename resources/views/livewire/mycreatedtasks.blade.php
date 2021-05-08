<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-body">
                <div class="field">
                    <h3>TAREAS CREADAS</h3>
                    @if( isset($taskCreatedList) && !$taskCreatedList->isEmpty())

                    <div style="margin-bottom: 30px;">
                        <div class="card card-body">
                            <div class="field">
                                <h5>TAREAS ACTIVAS</h5>
                                @foreach($taskCreatedList as $task)
                                @if( $task->status == $active )
                                <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div style="margin-bottom: 30px;">
                        <div class="card card-body">
                            <div class="field">
                                <h5>TAREAS PENDIENTES</h5>
                                @foreach($taskCreatedList as $task)
                                @if($task->status == "pending")
                                <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                                <div class="ml-3 relative">
                                    <x-jet-dropdown align="center" width="48">
                                        <x-slot name="trigger">
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </x-slot>
                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                <button wire:click="deleteTask({{$task->id}})"> {{ __('Eliminar') }} </button>
                                            </div>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div style="margin-bottom: 30px;">
                        <div class="card card-body">
                            <div class="field">
                                <h5>TAREAS ACABADAS</h5>
                                @foreach($taskCreatedList as $task)
                                @if($task->status == "done")
                                <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-body">
                <div class="field">
                    <h3>TAREAS ACEPTADAS</h3>
                    @if( isset($taskAceptedList) && !$taskAceptedList->isEmpty())

                    <div style="margin-bottom: 30px;">
                        <div class="card card-body">
                            <div class="field">
                                <h5>TAREAS ACTIVAS</h5>
                                @foreach($taskAceptedList as $task)
                                @if( $task->status == $active )
                                <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                                @endif
                                @endforeach

                            </div>
                        </div>
                    </div>


                    <div style="margin-bottom: 30px;">
                        <div class="card card-body">
                            <div class="field">
                                <h5>TAREAS ACABADAS</h5>
                                @foreach($taskAceptedList as $task)
                                @if( $task->status != $active )
                                <a href="{{ route('task_detail', ['task'=>$task->id]) }}" class="underline">{{$task->title}}</a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>