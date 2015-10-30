$(document).ready(function() {

	// Применять плагин jquery.datatables к таблицам
	if ($('.table-items').length)
	{
		$('.table-items').DataTable({
			"language": { "url": "/js/datatables.ru.json" }
		});
	}

	// Применять плагин select2 к списку с фотками и описанием
	if ($('.select_item').length)
	{
		$(".select_item").select2({
			language         : "ru",
			templateResult   : formatItem
		});
	}

	// Применять плагин select2 к списку с возможность вводить свои значения
	if ($('.select_tags').length)
	{
		$(".select_tags").select2({
			tags: true
		});
	}

	// Применять плагин select2 к списку
	if ($('.select_select2').length)
	{
		$(".select_select2").select2({});
	}
});

function addLunch(element)
{
	element = $(element).closest('.add-lunch');

	var askLunch = $('#askLunchTemplate').clone().insertBefore(element); // Создаем элемент выбора обеда
	askLunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
	askLunch.find('select').select2({language:"ru",templateResult:formatItem}); // Инициализируем плагин select2 для выбора обедов

	element.hide(); // Скрываем кнопку "Добавить обед"

	return false;
}

function selectLunch(element)
{
	var option = $(element).find(':selected');

	var lunch = $('#selectedLunchTemplate').clone().appendTo($(option).closest('.ask-lunch').prev()); // Созданный элемент со всеми параметрами Обеда (клонируем div)
	lunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
	lunch.find('.quantity select').select2({tags:true}); // Инициализируем плагин select2 для выбора количества

	//lunch.find('.input-id').val(option.val()); // Записываем id обеда в поле // TODO: решить как делать, оставлять id выбранного обеда или создавать новый
	lunch.find('.input-name').val(option.data('name')); // Записываем название обеда в поле
	lunch.find('.input-day').val(lunch.closest('.panel').data('day')); // Записываем день в который записывается этот обед

	lunch.find('.lunch-name').html(option.data('name')); // Записываем название обеда
	lunch.find('.lunch-price input').val(option.data('price')); // Записываем стоимость обеда, можем его редактировать
	lunch.find('.lunch-price input').data('originalPrice', option.data('price')); // Записываем стоимость обеда, не можем редактировать (для сравнения)
	lunch.find('.lunch-price input').on('change', function(e){ // Создает обработчик события, если цена была изменена, то пишем какая была оригинальная цена
		if (lunch.find('.lunch-price input').val() != lunch.find('.lunch-price input').data('originalPrice')) {
			$(this).closest('div').next().html('<div class="original-price">актуальная цена: ' + $(this).data('originalPrice') + ' руб.</div>');
		} else {
			$(this).closest('div').next().html('');
		}
	});

	lunch.find('.meal1-name').append(option.data('meal1'));
	lunch.find('.meal1-name').next().val(option.data('meal1Id'));

	lunch.find('.meal2-name').append(option.data('meal2'));
	lunch.find('.meal2-name').next().val(option.data('meal2Id'));

	lunch.find('.garnish-name').append(option.data('garnish'));
	lunch.find('.garnish-name').next().val(option.data('garnishId'));

	lunch.find('.salad-name').append(option.data('salad'));
	lunch.find('.salad-name').next().val(option.data('saladId'));

	lunch.find('.drink-name').append(option.data('drink'));
	lunch.find('.drink-name').next().val(option.data('drinkId'));

	lunch.find('.additions-name').append(option.data('additions'));
	lunch.find('.additions-name').next().val(option.data('additionsIds'));

	$(element).closest('.ask-lunch').next().show();
	$(element).closest('.ask-lunch').remove();
}

// Создание собственного обеда
function createLunch(element)
{
	element = $(element).closest('.ask-lunch');

	var createLunch = $('#createLunchTemplate').clone().insertBefore(element); // Создаем элемент создания обеда
	createLunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
	createLunch.find('select').select2({language:"ru",templateResult:formatItem}); // Инициализируем плагин select2 для выбора элементов обеда

	element.remove(); // Удаляем форму выбора обеда

	return false;
}

// Записываем выбранный элемент обеда - название и id
function writeLunchItem(itemType, lunchElement)
{
	var item = $('#'+itemType+' :selected');
	$(item).map(function(){
		if ($(this).val() != '') {
			lunchElement.find('.'+itemType+'-name').append('<div>' + $(this).text() + '</div>');
			var input = lunchElement.find('.'+itemType+'-name').next();
			var comma = input.val() == '' ? '' : ',';
			input.val(input.val() + comma + $(this).val());
		}
		else {
			lunchElement.find('.'+itemType+'-name').replaceWith('<span>-</span>');
		}
	});
}

// Сохраняем форму создания Обеда
function saveLunch(element)
{
	var lunchPrice = _.parseInt($(element).closest('.create-lunch').find('.lunch_total span').html());

	if ( ! lunchPrice)
	{
		alert('Обед не сформирован. Чтобы сохранить обед выберите блюда.');
		return false;
	}

	var lunch = $('#selectedLunchTemplate').clone().appendTo($(element).closest('.create-lunch').prev()); // Созданный элемент со всеми параметрами Обеда (клонируем div)
	lunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
	lunch.find('.quantity select').select2({tags:true}); // Инициализируем плагин select2 для выбора количества
	lunch.find('.lunch-name').html($('#name').val() ? $('#name').val() : 'Мой обед'); // Записываем название обеда
	lunch.find('.input-name').val($('#name').val() ? $('#name').val() : 'Мой обед'); // Записываем название обеда в поле
	lunch.find('.input-day').val(lunch.closest('.panel').data('day')); // Записываем день в который записывается этот обед
	lunch.find('.lunch-price input').val(lunchPrice); // Записываем стоимость обеда, можем его редактировать
	lunch.find('.lunch-price input').data('originalPrice', lunchPrice); // Записываем стоимость обеда, не можем редактировать (для сравнения)
	lunch.find('.lunch-price input').on('change', function(e){ // Создает обработчик события, если цена была изменена, то пишем какая была оригинальная цена
		if (lunch.find('.lunch-price input').val() != lunch.find('.lunch-price input').data('originalPrice')) {
			$(this).closest('div').next().html('<div class="original-price">актуальная цена: ' + $(this).data('originalPrice') + ' руб.</div>');
		} else {
			$(this).closest('div').next().html('');
		}
	});

	writeLunchItem('meal1', lunch);
	writeLunchItem('meal2', lunch);
	writeLunchItem('garnish', lunch);
	writeLunchItem('salad', lunch);
	writeLunchItem('drink', lunch);
	writeLunchItem('additions', lunch);

	$(element).closest('.create-lunch').next().show();
	$(element).closest('.create-lunch').remove();

	return false;
}

// Пересчет стоимости обеда
function calculateLunch(element)
{
	var element = $(element);
	var lunchPriceElement = element.closest('.create-lunch').find('.lunch_total');

	var totalPrice = 0;
	element.closest('.create-lunch').find('select').map( function(){
		var price = 0;

		$(this).find('option:selected').map(function(){
			price += $(this).data('price') ? _.parseInt($(this).data('price')) : 0;
		});

		totalPrice = totalPrice + price;
	});

	lunchPriceElement.find('span').html(totalPrice);
	lunchPriceElement.find('span').effect('highlight', 500);
}

// Удаление добавленного обеда
function removeSelectedLunch(element)
{
	$(element).closest('.selected-lunch').remove();
}

// Удаление формы добавления обеда
function removeCreateLunch(element)
{
	$(element).closest('.create-lunch').next().show();
	$(element).closest('.create-lunch').remove();

	return false;
}

// Форматирование списка select2 с фоткой и описанием
function formatItem(item)
{
	if ( ! item.id) { return item.name; }

	var element = $(item.element);

	var $item = $(
		'<div class="select2-row">' +
			(element.data('image') ? '<div class="select2-img"><img src="' + element.data('img_url') + element.data('image') + element.data('img_size') +  '" /></div>' : '') +
			'<div class="select2-text">' +
				'<div class="title">' + element.html() + (element.data('price') ? ' - <strong class="price">' + element.data('price') + ' руб.</strong>' : '') + '</div>' +
				(element.data('description2') ? '<div class="desc">' + element.data('description')+ '</div>' : '') +
			'</div>' +
		'</div>'
	);

	return $item;
};