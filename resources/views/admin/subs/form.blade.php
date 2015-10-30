@for($i=1; $i<=5; $i++)
	<div class="panel panel-default" data-day="{{ $i }}">
		<div class="panel-heading">
			<i class="fa fa-calendar"></i> {{ $daysOfWeek[$i] }}
		</div>
		<div class="panel-body">
			<div class="row">
				@foreach ($subs->where('day', (string)$i) as $key => $item)
					<div class="col-lg-4 col-md-6 selected-lunch">
						<div class="lunch-inner">
							<div class="lunch-name">{{ $item->lunch->name | '' }}</div>
							<div class="lunch-body">
								<div class="lunch-part">
									<span class="lunch-part-name">Первое:</span>
									<span class="meal1-name">{{ $item->lunch->meal1 ? $item->lunch->meal1->name : '' }}</span>
									<input type="hidden" name="meal1[]" value="{{ $item->lunch->meal1 ? $item->lunch->meal1->id : '' }}">
								</div>
								<div class="lunch-part">
									<span class="lunch-part-name">Второе:</span>
									<span class="meal2-name">{{ $item->lunch->meal2 ? $item->lunch->meal2->name : '' }}</span>
									<input type="hidden" name="meal2[]" value="{{ $item->lunch->meal2 ? $item->lunch->meal2->id : '' }}">
								</div>
								<div class="lunch-part">
									<span class="lunch-part-name">Гарнир:</span>
									<span class="garnish-name">{{ $item->lunch->garnish ? $item->lunch->garnish->name : '' }}</span>
									<input type="hidden" name="garnish[]" value="{{ $item->lunch->garnish ? $item->lunch->garnish->id : '' }}">
								</div>
								<div class="lunch-part">
									<span class="lunch-part-name">Салат:</span>
									<span class="salad-name">{{ $item->lunch->salad ? $item->lunch->salad->name : '' }}</span>
									<input type="hidden" name="salad[]" value="{{ $item->lunch->salad ? $item->lunch->salad->id : '' }}">
								</div>
								<div class="lunch-part">
									<span class="lunch-part-name">Напиток:</span>
									<span class="drink-name">{{ $item->lunch->drink ? $item->lunch->drink->name : '' }}</span>
									<input type="hidden" name="drink[]" value="{{ $item->lunch->drink ? $item->lunch->drink->id : '' }}">
								</div>
								<div class="lunch-part">
									<span class="lunch-part-name">Разное:</span>
									<span class="additions-name">{{ implode(', ', $item->lunch->addition_names) }}</span>
									<input type="hidden" name="additions[]" value="{{ implode(',', $item->lunch->addition_list) }}">
								</div>
							</div>
							<div class="lunch-summary">
								<div class="price-block">
									<div class="lunch-price">Цена: <span><input class="inline-edit" name="price[]" data-original-price="{{ $item->lunch->actual_price }}" value="{{ $item->lunch->price }}" style="width: 35px;"> руб.</span></div>
									<span>@if($item->lunch->actual_price != $item->lunch->price)актуальная цена: {{ $item->lunch->actual_price }}@endif</span>
								</div>
								<div class="quantity-block">
									<div class="lunch-quantity">
										<span>Количество:</span>
										<span class="quantity">
											<select name="quantity[]" class="select_tags">
												@for($j=1; $j<=10; $j++)
													<option value="{{ $j }}"@if($j == $item->quantity) selected="selected"@endif>{{ $j }}</option>
													@if($item->quantity > 10)<option value="{{ $item->quantity }}" selected="selected">{{ $item->quantity }}</option>@endif
												@endfor
											</select>
										</span>
									</div>
									<div class="lunch-remove"><span onclick="removeSelectedLunch(this);"><i class="fa fa-remove"></i> удалить обед</span></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<input type="hidden" class="input-id" name="id[]" value="{{ $item->lunch->id }}" />
						<input type="hidden" class="input-name" name="name[]" value="{{ $item->lunch->name | '' }}" />
						<input type="hidden" class="input-day" name="day[]" value="{{ $i }}" />
					</div>
				@endforeach
			</div>
			<div class="add-lunch">
				<a href="#" onclick="return addLunch(this);"><i class="fa fa-plus"></i> Добавить обед</a>
			</div>
		</div>
	</div>

	<p>&nbsp;</p>
@endfor

<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
		<div class="form-group">
			{!! Form::submit('Сохранить', ['class' => 'form-control btn btn-primary']) !!}
		</div>
		<div class="form-group">
			<a href="{{ route('admin.users.index') }}" class="btn btn-block btn-default">Отмена</a>
		</div>
	</div>
</div>