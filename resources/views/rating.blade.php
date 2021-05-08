@extends('layouts.base')
@section('content')
@livewire('trate', ['task' => $task])
@endsection