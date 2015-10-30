@extends('admin.app')

@section('title')Разное - Редактировать@endsection

@section('content')
	<h1 class="text-center">Редактировать</h1>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
			{!! Form::model($item, ['url' => route('admin.additions.update', $item->id), 'method' => 'PUT', 'files' => true]) !!}
				@include('admin.additions.form', ['submitButtonText' => 'Обновить'])
			{!! Form::close() !!}
		</div>
	</div>
@endsection
