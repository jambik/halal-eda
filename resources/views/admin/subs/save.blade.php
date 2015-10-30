@extends('admin.app')

@section('title')Подписка - Редактировать@endsection

@section('content')
	<h1 class="text-center">Подписка</h1>
	<p>&nbsp;</p>
	<div class="row">
		<div class="col-lg-12">
			{!! Form::open(['url' => route('saveSubs', $user->id), 'method' => 'POST', 'files' => true]) !!}
				@include('admin.subs.form')
			{!! Form::close() !!}
		</div>
	</div>

	@include('admin.subs.templates')
@endsection