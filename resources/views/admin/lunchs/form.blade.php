<div class="form-group">
	{!! Form::label('name', 'Название:') !!}
	{!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('description', 'Описание:') !!}
	{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
	{!! Form::label('meal1_id', 'Первое:') !!}
	{!! Form::select('meal1_id', [0 => ''] + $meal1, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('meal2_id', 'Второе:') !!}
	{!! Form::select('meal2_id', [0 => ''] + $meal2, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('garnish_id', 'Второе (гарнир):') !!}
	{!! Form::select('garnish_id', [0 => ''] + $garnishs, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('salad_id', 'Салат:') !!}
	{!! Form::select('salad_id', [0 => ''] + $salads, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('drink_id', 'Напиток:') !!}
	{!! Form::select('drink_id', [0 => ''] + $drinks, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('addition_list', 'Разное:') !!}
	<select name="addition_list[]" id="addition_list" multiple="multiple" class="form-control select_item">
		@foreach ($additions as $val)
			<option @if($val->selected)selected="selected"@endif value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}">{{ $val->name }}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	{!! Form::label('price', 'Цена:') !!}
	{!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::label('image', 'Фото:') !!}
	{!! Form::file('image', ['class' => 'form-control']) !!}
</div>

@if (isset($item) && $item->image)
	<img src='/images/medium/{{ $item->img_url.$item->image }}' alt='' />
	<p>&nbsp;</p>
@endif

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.lunchs.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>