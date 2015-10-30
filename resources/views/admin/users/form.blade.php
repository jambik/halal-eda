<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-user"></i> Данные профиля
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('name', 'Имя:') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Пароль:') !!}
			{!! Form::text('password', null, ['class' => 'form-control']) !!}
			@if (isset($item)) <small>Если оставить пароль пустым, то он не изменится</small> @endif
		</div>
	</div>
</div>

<p>&nbsp;</p>
<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-address"></i> Контактные данные
	</div>
	<div class="panel-body">
		<div class="form-group">
			{!! Form::label('contact[name]', 'Контактное лицо:') !!}
			{!! Form::text('contact[name]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[phone]', 'Телефон:') !!}
			{!! Form::text('contact[phone]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[city]', 'Город:') !!}
			{!! Form::text('contact[city]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[metro]', 'Ближайшая станция метро:') !!}
			{!! Form::text('contact[metro]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[street]', 'Улица (проспект, переулок):') !!}
			{!! Form::text('contact[street]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[house]', 'Дом №:') !!}
			{!! Form::text('contact[house]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[corpus]', 'Корпус:') !!}
			{!! Form::text('contact[corpus]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[building]', 'Строение:') !!}
			{!! Form::text('contact[building]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[apartment]', 'Квартира (офис, комната):') !!}
			{!! Form::text('contact[apartment]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[entrance]', 'Подъезд:') !!}
			{!! Form::text('contact[entrance]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[floor]', 'Этаж:') !!}
			{!! Form::text('contact[floor]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[intercom]', 'Домофон:') !!}
			{!! Form::text('contact[intercom]', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('contact[comment]', 'Комментарий:') !!}
			{!! Form::textarea('contact[comment]', null, ['class' => 'form-control', 'rows' => 3]) !!}
		</div>
	</div>
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.users.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>