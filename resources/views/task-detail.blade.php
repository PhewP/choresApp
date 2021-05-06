@extends('layouts.base')
@section('content')
@livewire('task-details', ['task' => $task])
@endsection