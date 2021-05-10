@extends('layouts.base')
@section('content')
@if(auth()->user()->id == $task->creator_id || auth()->user()->id == $task->performer_id)
@livewire('task-details', ['task' => $task])
@else
<div>
    <div class="flex-row align-items-center p-2 bg-white border">
        <div class="feed-text px-2">
            <div class="container">
                <center>
                    Tarea no disponible
                </center>
            </div>
        </div>
    </div>
</div>
@endif
@endsection