@extends('admin.app')

@section('title')Напитки - Создать@endsection

@section('content')
	<h1 class="text-center">Создать</h1>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
			{!! Form::open(['url' => route('admin.drinks.store'), 'method' => 'POST', 'files' => true]) !!}
				@include('admin.drinks.form', ['submitButtonText' => 'Добавить'])
			{!! Form::close() !!}
		</div>
	</div>
@endsection
