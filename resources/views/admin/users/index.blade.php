@extends('layouts.admin')

@section('title', 'Users')

@section('content name', 'Users')

@section('content')
	<x-success-message/>
	<livewire:users-table/>

@endsection