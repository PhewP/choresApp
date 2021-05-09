@extends('layouts.base')
@section('content')
@livewire('dashcomponent', ['user_id' => $user_id])
@endsection