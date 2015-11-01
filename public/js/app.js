$(document).ready(function() {

    // Обработка ссылки Забыл пароль
    if ($('#email_link').length)
    {
        $('#email_link').on('click', function(e){
            $('#email_block').show();
            $('#login_block').hide();

            e.preventDefault();
        });
    }

    // Обработка ссылки Вход
    if ($('#login_link').length)
    {
        $('#login_link').on('click', function(e){
            $('#email_block').hide();
            $('#login_block').show();

            e.preventDefault();
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

    // Инициализируем плагин select2 для выбора количества
    if($('.set .quantity select').length)
    {
        $('.set .quantity select').select2({tags:true});
    }

    calculateSet(); // Пересчитываем стоимость и количество обедов при загрузке страницы
});

// Обновление контактной информации
function contactsUpdate(element)
{
    element = $(element);

    var form = element.closest('form');

    element.append(' <i class="fa fa-spinner fa-spin"></i>');
    element.prop('disabled', true);

    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            var response = data;

            if (response.status == 'error')
            {
                return contactsErrors(response.errors);
            }
            else if (response.status == 'success')
            {
                return contactsSuccess();
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            alert('Возникла ошибка во время запроса.')
        },
        complete: function(jqXHR, textStatus)
        {
            element.find('i').remove();
            element.prop('disabled', false);
        }
    });

    return false;
}

// Обратная связь
function feedback(element)
{
    element = $(element);

    var form = element.closest('form');

    element.closest('form').find('.alert').remove();
    element.append(' <i class="fa fa-spinner fa-spin"></i>');
    element.prop('disabled', true);

    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function(data)
        {
            $('#form_feedback').prepend(makeSuccessMessage('Сообщение отправлено'));
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            if (jqXHR.status == 422) // Если статус 422 (неправильные входные данные) то отображаем ошибки
            {
                var formStatusText = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><div class='text-uppercase'>Ошибка!</div><ul>";

                $.each(jqXHR.responseJSON, function (index, value) {
                    formStatusText += "<li>" + value + "</li>";
                });

                formStatusText += "</ul></div>";
                $('#form_feedback').prepend(formStatusText);
            }
            else
            {
                alert('Возникла ошибка во время запроса.')
            }
        },
        complete: function(jqXHR, textStatus)
        {
            element.find('i').remove();
            element.prop('disabled', false);
        }
    });

    return false;
}

// Подписка на обеды
function subscribe(element)
{
    element = $(element);

    if (element.prev().length) element.prev().remove();

    if ( ! $('#subscription .selected-lunch').length)
    {
        element.before('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> Обеды еще не выбраны</div>');
        return false;
    }

    if ( ! $('#user_links:visible').length)
    {
        element.before('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> Пожалуиста пройдите регистрацию или войдите под своим аккаунтом</div>');
        return false;
    }

    var form = element.closest('form');

    element.append(' <i class="fa fa-spinner fa-spin"></i>');
    element.prop('disabled', true);

    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            var response = data;

            if (response.status == 'error')
            {
                return subscribeErrors(response.errors);
            }
            else if (response.status == 'success')
            {
                return subscribeSuccess();
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            alert('Возникла ошибка во время запроса.')
        },
        complete: function(jqXHR, textStatus)
        {
            element.find('i').remove();
            element.prop('disabled', false);
        }
    });

    return false;
}

// Отписка от обедов
function unsubscribe(element)
{
    element = $(element);
    element.append(' <i class="fa fa-spinner fa-spin"></i>');
    element.prop('disabled', true);

    $.ajax({
        method: 'GET',
        url: '/unsubscribe',
        dataType: 'json',
        success: function(data)
        {
            console.log(data);
            var response = data;

            if (response.status == 'error')
            {
                return unsubscribeErrors(response.errors);
            }
            else if (response.status == 'success')
            {
                return unsubscribeSuccess();
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            alert('Возникла ошибка во время запроса.')
        },
        complete: function(jqXHR, textStatus)
        {
            element.find('i').remove();
            element.prop('disabled', false);
        }
    });

    return false;
}

// Формирование сообщения об ошибке
function makeErrorMessage(errors)
{
    var errorText = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    _.map(errors, function(val){ errorText+= '<p>- ' + val + '</p>'; });
    errorText += '</div>';

    return errorText;
}

// Формирование сообщения об успешном действии
function makeSuccessMessage(success)
{
    var successText = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p>' + success + '</p></div>';
    return successText;
}

// Ошибка обновления контактной информации
function contactsErrors(errors)
{
    alert('subscribe errors: ' + errors);
}

// Успешное обновление контактной информации
function contactsSuccess()
{
    $('#form_contacts').find('.modal-body').prepend(makeSuccessMessage('Контактная информация сохранена'));
}

// Ошибка подписки
function subscribeErrors(errors)
{
    alert('subscribe errors: ' + errors);
}

// Успешная подписка
function subscribeSuccess()
{
    $('.nosub-controls').hide();
    $('.sub-controls').show();
    $('.sub-notification').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-check-circle-o"></i> Вы оформили подписку на обеды, но Вы всегда можете ее обновить.</div>');
}

// Ошибка отписки
function unsubscribeErrors(errors)
{
    alert('unsubscribe errors: ' + errors);
}

// Успешная отписка
function unsubscribeSuccess()
{
    $('#subscription .selected-lunch').remove();
    $('.nosub-controls').show();
    $('.sub-controls').hide();
    $('.sub-notification').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> Вы отписались от обедов</div>');
}

// Ошибка логина
function loginErrors(errors)
{
    $('#form_login').prepend(makeErrorMessage(errors));
}

// Ошибка сброса пароля
function emailErrors(errors)
{
    $('#form_email').prepend(makeErrorMessage(errors));
}

// Ошибка регистрации
function registrationErrors(errors)
{
    $('#form_register').prepend(makeErrorMessage(errors));
}

// Успешный сброс пароля
function emailSuccess()
{
    $('#form_email').prepend(makeSuccessMessage('Ссылка на сброс пароля отправлена'));
}

// Успешная регистрации
function registrationSuccess(userData)
{
    $('#login_links').hide();
    $('#user_links').show();
    $('#user_name').html(userData.name);
}

// Форматирование списка select2 с фоткой и описанием
function formatItem(item)
{
    if ( ! item.id) { return item.name; }

    var element = $(item.element);

    var $item = $(
        '<div class="select2-row">' +
            (element.data('image') ? '<div class="select2-img"><img src="' + element.data('img_url') + element.data('image') + '" /></div>' : '') +
            '<div class="select2-text">' +
                '<div class="title">' + element.html() + (element.data('price') ? ' - <strong class="price">' + element.data('price') + ' руб.</strong>' : '') + '</div>' +
                (element.data('description') ? '<div class="desc">' + element.data('description')+ '</div>' : '') +
            '</div>' +
        '</div>'
    );

    return $item;
};

// Форма добавления обеда
function addLunch(element)
{
    element = $(element).closest('.add-lunch');

    element.effect('drop', {}, 200, function(){
        var askLunch = $('#askLunchTemplate').clone().insertBefore(element); // Создаем элемент выбора обеда
        askLunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
        askLunch.find('select').select2({language:"ru",templateResult:formatItem,dropdownAutoWidth:true}); // Инициализируем плагин select2 для выбора обедов
        askLunch.effect('slide', 200);
    });

    return false;
}

// Выбор обеда из списка готовых
function selectLunch(element)
{
    $(element).closest('.ask-lunch').effect('blind', 200, function(){
        var option = $(element).find(':selected');

        var lunch = $('#selectedLunchTemplate').clone().insertBefore($(option).closest('.ask-lunch')); // Созданный элемент со всеми параметрами Обеда (клонируем div)
        lunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
        lunch.find('.quantity select').select2({tags:true}); // Инициализируем плагин select2 для выбора количества

        lunch.find('.input-name').val(option.data('name')); // Записываем название обеда в поле
        lunch.find('.input-day').val(lunch.closest('.set').data('day')); // Записываем день в который записывается этот обед

        lunch.find('.lunch-name').html(option.data('name')); // Записываем название обеда
        lunch.find('.lunch-price span').html(option.data('price')); // Записываем стоимость обеда
        lunch.find('.lunch-price input').val(option.data('price')); // Записываем стоимость обеда в поле

        if(option.data('meal1')) {
            lunch.find('.meal1-name').append(option.data('meal1') + ( option.data('meal1Price') ? ' - <strong>'+option.data('meal1Price')+' руб.</strong>' : '' ));
            lunch.find('.meal1-name').next().val(option.data('meal1Id'));
        } else lunch.find('.meal1-name').parent().hide();

        if(option.data('meal2')) {
            lunch.find('.meal2-name').append(option.data('meal2') + ( option.data('meal2Price') ? ' - <strong>'+option.data('meal2Price')+' руб.</strong>' : '' ));
            lunch.find('.meal2-name').next().val(option.data('meal2Id'));
        } else lunch.find('.meal2-name').parent().hide();

        if(option.data('garnish')) {
            lunch.find('.garnish-name').append(option.data('garnish') + ( option.data('garnishPrice') ? ' - <strong>'+option.data('garnishPrice')+' руб.</strong>' : '' ));
            lunch.find('.garnish-name').next().val(option.data('garnishId'));
        } else lunch.find('.garnish-name').parent().hide();

        if(option.data('salad')) {
            lunch.find('.salad-name').append(option.data('salad') + ( option.data('saladPrice') ? ' - <strong>'+option.data('saladPrice')+' руб.</strong>' : '' ));
            lunch.find('.salad-name').next().val(option.data('saladId'));
        } else lunch.find('.salad-name').parent().hide();

        if(option.data('drink')) {
            lunch.find('.drink-name').append(option.data('drink') + ( option.data('drinkPrice') ? ' - <strong>'+option.data('drinkPrice')+' руб.</strong>' : '' ));
            lunch.find('.drink-name').next().val(option.data('drinkId'));
        } else lunch.find('.drink-name').parent().hide();

        if(option.data('additions')) {
            lunch.find('.additions-name').append(option.data('additions'));
            lunch.find('.additions-name').next().val(option.data('additionsIds'));
        } else lunch.find('.additions-name').parent().hide();

        lunch.effect('slide', 200);

        $(element).closest('.ask-lunch').next().effect('slide', 200);
        $(element).closest('.ask-lunch').remove();

        calculateSet();
    });

    return false;
}

// Создание собственного обеда
function createLunch(element)
{
    element = $(element).closest('.ask-lunch');

    element.effect('drop', {}, 200, function(){
        var createLunch = $('#createLunchTemplate').clone().insertBefore(element); // Создаем элемент создания обеда
        createLunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
        createLunch.find('select').select2({language: "ru", templateResult: formatItem, dropdownAutoWidth: true}); // Инициализируем плагин select2 для выбора элементов обеда
        createLunch.effect('slide', 200);
        element.remove(); // Удаляем форму выбора обеда
    });

    return false;
}

// Записываем выбранный элемент обеда - название и id
function writeLunchItem(itemType, lunchElement)
{
    var item = $('#'+itemType+' :selected');
    $(item).map(function(){
        if ($(this).val() != '') {
            lunchElement.find('.'+itemType+'-name').append('<div>' + $(this).text() + ( $(this).data('price') ? ' - <strong>'+$(this).data('price')+' руб.</strong>' : '' ) + '</div>');
            var input = lunchElement.find('.'+itemType+'-name').next();
            var comma = input.val() == '' ? '' : ',';
            input.val(input.val() + comma + $(this).val());
        }
        else {
            lunchElement.find('.'+itemType+'-name').parent().hide();
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

    $(element).closest('.create-lunch').effect('drop', {}, 200, function(){
        var lunch = $('#selectedLunchTemplate').clone().insertBefore($(element).closest('.create-lunch')); // Созданный элемент со всеми параметрами Обеда (клонируем div)
        lunch.attr('id', ''); // Убираем Id элемента который скопировался с шаблона
        lunch.find('.quantity select').select2({tags: true}); // Инициализируем плагин select2 для выбора количества
        lunch.find('.lunch-name').html($('#name').val() ? $('#name').val() : 'Мой обед'); // Записываем название обеда
        lunch.find('.input-name').val($('#name').val() ? $('#name').val() : 'Мой обед'); // Записываем название обеда в поле
        lunch.find('.input-day').val(lunch.closest('.set').data('day')); // Записываем день в который записывается этот обед
        lunch.find('.lunch-price span').html(lunchPrice); // Записываем стоимость обеда
        lunch.find('.lunch-price input').val(lunchPrice); // Записываем стоимость обеда

        writeLunchItem('meal1', lunch);
        writeLunchItem('meal2', lunch);
        writeLunchItem('garnish', lunch);
        writeLunchItem('salad', lunch);
        writeLunchItem('drink', lunch);
        writeLunchItem('additions', lunch);

        lunch.effect('slide', 200);

        $(element).closest('.create-lunch').next().effect('slide', 200);
        $(element).closest('.create-lunch').remove();

        calculateSet();
    });

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

// Пересчитываем количество обедов и сумму по дням
function calculateSet()
{
    if($('#subscription .set').length)
    {
        $('#subscription .set').map(function ()
        {
            var daySum = 0;
            var dayLunchCount = 0;
            $(this).find('.selected-lunch').map(function ()
            {
                daySum += _.parseInt($(this).find('.lunch-price span').html()) * _.parseInt($(this).find('.quantity select').val());
                dayLunchCount += _.parseInt($(this).find('.quantity select').val());
            });

            $(this).find('.set-summary .count').html(dayLunchCount);
            $(this).find('.set-summary .sum').html(daySum);
        });
    }
}

// Удаление добавленного обеда
function removeSelectedLunch(element)
{
    $(element).closest('.selected-lunch').effect('drop', 200, function(){
        $(element).closest('.selected-lunch').remove();
        calculateSet();
    });

    return false;
}

// Удаление формы добавления обеда
function removeCreateLunch(element)
{
    $(element).closest('.create-lunch').effect('drop', 200, function(){
        $(element).closest('.create-lunch').next().effect('slide', 200);
        $(element).closest('.create-lunch').remove();
        calculateSet();
    });

    return false;
}