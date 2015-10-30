@extends('admin.app')

@section('title')Второе - Создать@endsection

@section('content')
	<h1 class="text-center">Создать</h1>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
			{!! Form::open(['url' => route('admin.meal2.store'), 'method' => 'POST', 'files' => true]) !!}
				@include('admin.meal2.form', ['submitButtonText' => 'Добавить'])
			{!! Form::close() !!}
		</div>
	</div>
@endsection
