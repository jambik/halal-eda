<div class="hidden">
	{{-- Шаблон выбора обеда --}}
	<div class="ask-lunch text-center" id="askLunchTemplate">
		<div>
			<select onchange="selectLunch(this)" data-placeholder="- Выберите обед -" class="form-control input-sm">
				<option value=""></option>
				@foreach ($lunchs as $val)
					<option
							value="{{ $val->id }}"
							data-image="{{ $val->image }}"
							data-img_url="{{ $val->img_url }}"
							data-img_size="{{ $val->img_size['xs'] }}"
							data-name="{{ $val->name }}"
							data-description="{{ $val->description }}"
							data-price="{{ $val->price }}"
							data-meal1="{{ $val->meal1 ? $val->meal1->name : '' }}"
							data-meal1-id="{{ $val->meal1 ? $val->meal1->id : '' }}"
							data-meal1-price="{{ $val->meal1 ? $val->meal1->price : '' }}"
							data-meal2="{{ $val->meal2 ? $val->meal2->name : '' }}"
							data-meal2-id="{{ $val->meal2 ? $val->meal2->id : '' }}"
							data-meal2-price="{{ $val->meal2 ? $val->meal2->price : '' }}"
							data-garnish="{{ $val->garnish ? $val->garnish->name : '' }}"
							data-garnish-id="{{ $val->garnish ? $val->garnish->id : '' }}"
							data-garnish-price="{{ $val->garnish ? $val->garnish->price : '' }}"
							data-salad="{{ $val->salad ? $val->salad->name : '' }}"
							data-salad-id="{{ $val->salad ? $val->salad->id : '' }}"
							data-salad-price="{{ $val->salad ? $val->salad->price : '' }}"
							data-drink="{{ $val->drink ? $val->drink->name : '' }}"
							data-drink-id="{{ $val->drink ? $val->drink->id : '' }}"
							data-drink-price="{{ $val->drink ? $val->drink->price : '' }}"
							data-additions="@foreach($val->additions as $a) <div>{{ $a->name }} {{ $a->price ? ' - <strong>'.$a->price.' руб.</strong>' : '' }}</div> @endforeach"
							data-additions-ids="{{ implode(',', $val->addition_list) }}">
						{{ $val->name }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="or">или</div>
		<div><a href="#" class="btn btn-info" onclick="return createLunch(this);"><i class="fa fa-plus"></i> Создайте свой обед</a></div>
	</div>

	{{-- Шаблон создание обеда --}}
	<div class="create-lunch" id="createLunchTemplate">

		<input type="text" id="name" placeholder="Название обеда" data-default="Мой обед" value="Мой Обед" class="form-control" />
		<div class="height-10"></div>

		<select id="meal1" data-placeholder="- Первое -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
			<option value="" label="-"></option>
			@foreach ($meal1 as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>
		<div class="height-10"></div>

		<select id="meal2" data-placeholder="- Второе -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
			<option value=""></option>
			@foreach ($meal2 as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>
		<div class="height-10"></div>

		<select id="garnish" data-placeholder="- Гарнир -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
			<option value=""></option>
			@foreach ($garnishs as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>
		<div class="height-10"></div>

		<select id="salad" data-placeholder="- Салат -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
			<option value=""></option>
			@foreach ($salads as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>
		<div class="height-10"></div>

		<select id="drink" data-placeholder="- Напиток -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
			<option value=""></option>
			@foreach ($drinks as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>
		<div class="height-10"></div>

		<select id="additions" multiple="multiple" data-placeholder="- Дополнительно -" onchange="calculateLunch(this)" class="form-control">
			@foreach ($additions as $val)
				<option value="{{ $val->id }}" data-image="{{ $val->image }}" data-img_url="{{ $val->img_url }}" data-img_size="{{ $val->img_size['xs'] }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
			@endforeach
		</select>

		<div class="lunch_total">Стоимость обеда: <span>0</span> руб.</div>

		<div class="text-center">
			<button class="btn btn-success" onclick="return saveLunch(this);"><i class="fa fa-check"></i> Сохранить обед</button>
			<button class="btn btn-default" onclick="return removeCreateLunch(this);"><i class="fa fa-cancel"></i> Отменить</button>
		</div>
	</div>

	{{-- Шаблон добавленной формы обеда --}}
	<div class="selected-lunch" id="selectedLunchTemplate">
		<div class="lunch-inner">
			<div class="lunch-name"></div>
			<div class="lunch-body">
				<div class="lunch-part">
					<span class="lunch-part-name">Первое:</span>
					<span class="meal1-name"></span>
					<input type="hidden" name="meal1[]" value="">
				</div>
				<div class="lunch-part">
					<span class="lunch-part-name">Второе:</span>
					<span class="meal2-name"></span>
					<input type="hidden" name="meal2[]" value="">
				</div>
				<div class="lunch-part">
					<span class="lunch-part-name">Гарнир:</span>
					<span class="garnish-name"></span>
					<input type="hidden" name="garnish[]" value="">
				</div>
				<div class="lunch-part">
					<span class="lunch-part-name">Салат:</span>
					<span class="salad-name"></span>
					<input type="hidden" name="salad[]" value="">
				</div>
				<div class="lunch-part">
					<span class="lunch-part-name">Напиток:</span>
					<span class="drink-name"></span>
					<input type="hidden" name="drink[]" value="">
				</div>
				<div class="lunch-part">
					<span class="lunch-part-name">Разное:</span>
					<span class="additions-name"></span>
					<input type="hidden" name="additions[]" value="">
				</div>
			</div>
			<div class="lunch-summary">
				<div class="price-block">
					<div class="lunch-price">
						<div>Цена:</div>
						<div><span></span> руб.</div>
						<input type="hidden" name="price[]" />
					</div>
				</div>
				<div class="quantity-block">
					<div class="lunch-quantity">
						<span>Количество:</span>
						<span class="quantity">
							<select name="quantity[]" onchange="calculateSet()">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
						</span>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="lunch-remove"><span onclick="removeSelectedLunch(this);"><i class="fa fa-remove"></i> удалить обед</span></div>
			</div>
		</div>
		<input type="hidden" class="input-name" name="name[]" />
		<input type="hidden" class="input-day" name="day[]" />
		<input type="hidden" class="input-id" name="id[]" />
	</div>

</div>

<div class="modal fade" id="contactsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::model($user, ['url' => route('contacts'), 'method' => 'POST', 'id' => 'form_contacts']) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Контактные данные</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[name]', 'Контактное лицо (фирма):') !!}
							{!! Form::text('contact[name]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[phone]', 'Телефон:') !!}
							{!! Form::text('contact[phone]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[city]', 'Город:') !!}
							{!! Form::text('contact[city]', $user && isset($user->contact->city) ? $user->contact->city : 'Москва', ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[metro]', 'Ближайшее метро:') !!}
							{!! Form::text('contact[metro]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[street]', 'Улица (проспект, переулок):') !!}
							{!! Form::text('contact[street]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-6 col-md-6 col-sm-6">
							{!! Form::label('contact[house]', 'Дом №:') !!}
							{!! Form::text('contact[house]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[corpus]', 'Корпус:') !!}
							{!! Form::text('contact[corpus]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[building]', 'Строение:') !!}
							{!! Form::text('contact[building]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[apartment]', 'Квартира (офис):') !!}
							{!! Form::text('contact[apartment]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[entrance]', 'Подъезд:') !!}
							{!! Form::text('contact[entrance]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[floor]', 'Этаж:') !!}
							{!! Form::text('contact[floor]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-4 col-md-4 col-sm-4">
							{!! Form::label('contact[intercom]', 'Домофон:') !!}
							{!! Form::text('contact[intercom]', null, ['class' => 'form-control']) !!}
						</div>

						<div class="form-group col-lg-12 col-md-12 col-sm-12">
							{!! Form::label('contact[comment]', 'Комментарий:') !!}
							{!! Form::textarea('contact[comment]', null, ['class' => 'form-control', 'rows' => 3]) !!}
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="return contactsUpdate(this)">Сохранить</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>