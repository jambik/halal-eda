@extends('admin.app')

@section('title')Салаты@endsection

@section('content')
	<h1 class="text-center">Салаты</h1>
	<p>
		<a href="{{ route('admin.salads.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
	</p>
	<table class="table table-responsive table-striped table-bordered table-items">
		<thead>
			<tr>
				<th>Id</th>
				<th>Фото</th>
				<th>Название</th>
				<th>Описание</th>
				<th>Состав</th>
				<th>Вес</th>
				<th>Цена</th>
				<th><i class="fa fa-edit text-primary"></i></th>
				<th><i class="fa fa-remove text-danger"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>@if ($item->image)<img src='/images/small/{{ $item->img_url.$item->image }}' alt='' />@endif</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->description }}</td>
					<td>{{ $item->consist }}</td>
					<td>{{ $item->weight }}</td>
					<td>{{ $item->price }}</td>
					<td><a href="{{ route('admin.salads.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
					<td>
						{!! Form::open(['url' => route('admin.salads.destroy', $item->id), 'method' => 'DELETE']) !!}
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы действительно хотите удалить запись #{{ $item->id }}');"><i class="fa fa-remove"></i></button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
