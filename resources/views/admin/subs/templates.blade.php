<div class="hidden">
	{{-- Шаблон выбора обеда --}}
	<div class="ask-lunch text-center" id="askLunchTemplate">
		<div>
			<select onchange="selectLunch(this)" data-placeholder="- Выберите обед -" class="form-control">
				<option value=""></option>
				@foreach ($lunchs as $val)
					<option
							value="{{ $val->id }}"
							data-name="{{ $val->name }}"
							data-description="{{ $val->description }}"
							data-price="{{ $val->price }}"
							data-meal1="{{ $val->meal1 ? $val->meal1->name : '-' }}"
							data-meal1-id="{{ $val->meal1 ? $val->meal1->id : '' }}"
							data-meal2="{{ $val->meal2 ? $val->meal2->name : '-' }}"
							data-meal2-id="{{ $val->meal2 ? $val->meal2->id : '' }}"
							data-garnish="{{ $val->garnish ? $val->garnish->name : '-' }}"
							data-garnish-id="{{ $val->garnish ? $val->garnish->id : '' }}"
							data-salad="{{ $val->salad ? $val->salad->name : '-' }}"
							data-salad-id="{{ $val->salad ? $val->salad->id : '' }}"
							data-drink="{{ $val->drink ? $val->drink->name : '-' }}"
							data-drink-id="{{ $val->drink ? $val->drink->id : '' }}"
							data-additions="{{ implode(', ', $val->addition_names) ?: '-' }}"
							data-additions-ids="{{ implode(',', $val->addition_list) }}">
						{{ $val->name }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="or">или</div>
		<div><a href="#" onclick="return createLunch(this);"><i class="fa fa-plus"></i> Создайте свой обед</a></div>
	</div>

	{{-- Шаблон создание обеда --}}
	<div class="create-lunch" id="createLunchTemplate">
		<div class="row">
			<div class="col-lg-2">
				<div class="lunch-part-name">Название обеда:</div>
				<input type="text" id="name" placeholder="Название обеда" data-default="Мой обед" value="Мой Обед" class="form-control" />
			</div>
			<div class="col-lg-2">
				<div class="lunch-part-name">Первое:</div>
				<select id="meal1" data-placeholder="- Выберите первое -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
					<option value="" label="-"></option>
					@foreach ($meal1 as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<div class="lunch-part-name">Второе:</div>
				<select id="meal2" data-placeholder="- Выберите второе -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
					<option value=""></option>
					@foreach ($meal2 as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
				<select id="garnish" data-placeholder="- Выберите гарнир -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
					<option value=""></option>
					@foreach ($garnishs as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<div class="lunch-part-name">Салат:</div>
				<select id="salad" data-placeholder="- Выберите салат -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
					<option value=""></option>
					@foreach ($salads as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<div class="lunch-part-name">Напиток:</div>
				<select id="drink" data-placeholder="- Выберите напиток -" data-allow-clear="true" onchange="calculateLunch(this)" class="form-control">
					<option value=""></option>
					@foreach ($drinks as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<div class="lunch-part-name">Разное:</div>
				<select id="additions" multiple="multiple" data-placeholder="- Выберите из списка -" onchange="calculateLunch(this)" class="form-control">
					@foreach ($additions as $val)
						<option value="{{ $val->id }}" data-description="{{ $val->description }}" data-price="{{ $val->price }}">{{ $val->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<hr />
		<div class="lunch_total">Стоимость обеда: <span>0</span> руб.</div>
		<div class="text-center">
			<button class="btn btn-sm btn-success" onclick="return saveLunch(this);"><i class="fa fa-check"></i> Сохранить обед</button>
			<button class="btn btn-sm btn-default" onclick="return removeCreateLunch(this);"><i class="fa fa-cancel"></i> Отменить</button>
		</div>
	</div>

	{{-- Шаблон добавленной формы обеда --}}
	<div class="col-lg-4 col-md-6 selected-lunch" id="selectedLunchTemplate">
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
					<div class="lunch-price">Цена: <span><input class="inline-edit" name="price[]" data-original-price="" value="" style="width: 35px;"> руб.</span></div>
					<span></span>
				</div>
				<div class="quantity-block">
					<div class="lunch-quantity">
						<span>Количество:</span>
						<span class="quantity">
							<select name="quantity[]">
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
					<div class="lunch-remove"><span onclick="removeSelectedLunch(this);"><i class="fa fa-remove"></i> удалить обед</span></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<input type="hidden" class="input-id" name="id[]" />
		<input type="hidden" class="input-name" name="name[]" />
		<input type="hidden" class="input-day" name="day[]" />
	</div>

</div>