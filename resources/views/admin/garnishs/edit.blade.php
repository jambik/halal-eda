@extends('admin.app')

@section('title')Гарниры - Редактировать@endsection

@section('content')
	<h1 class="text-center">Редактировать</h1>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
			{!! Form::model($item, ['url' => route('admin.garnishs.update', $item->id), 'method' => 'PUT', 'files' => true]) !!}
				@include('admin.garnishs.form', ['submitButtonText' => 'Обновить'])
			{!! Form::close() !!}
		</div>
	</div>
@endsection
