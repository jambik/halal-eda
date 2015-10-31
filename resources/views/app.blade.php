@include('partials._header', ['title' => 'Халяль обеды в Москве'])
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="logo">
                        <a href="/"><img src="img/logo.png" alt="" /></a>
                        <h1>Халяль обеды</h1>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <div class="auth-links text-uppercase">
                        <div id="login_links" style="display: {{ Auth::check() ? 'none' : 'block' }}">
                            <div class="dropdown auth-form">
                                <a href="#" class="dropdown-toggle" id="dropdownLogin" data-toggle="dropdown" aria-expanded="true">Вход</a>
                                <div class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownLogin">
                                    <div id="login_block">
                                        <form action="{{ route('login') }}" method="POST" id="form_login">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" placeholder="Пароль" class="form-control" />
                                            </div>
                                            {!! Form::token() !!}
                                            <button class="btn btn-block btn-warning">Вход</button>
                                            <div>&nbsp;</div>
                                            <div class="text-center">
                                                <a href="{{ route('email') }}" id="email_link">Забыл проль?</a>
                                            </div>
                                        </form>
                                        {{--<hr />
                                        <div class="social-buttons">
                                            <p class="text-center">Вход через социальные сети:</p>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-google"></i></a>
                                        </div>--}}
                                    </div>
                                    <div id="email_block" style="display: none;">
                                        <form action="{{ route('email') }}" method="POST" id="form_email">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" class="form-control" />
                                            </div>
                                            {!! Form::token() !!}
                                            <button class="btn btn-block btn-warning">Выслать ссылку для сброса пароля</button>
                                            <div>&nbsp;</div>
                                            <div class="text-center">
                                                <a href="{{ route('login') }}" id="login_link">&larr; Вход</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            /
                            <div class="dropdown reg-form">
                                <a href="#" class="dropdown-toggle" id="dropdownRegister" data-toggle="dropdown" aria-expanded="true">Регистрация</a>
                                <div class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownRegister">
                                    <form action="{{ route('register') }}" method="POST" class="form-ajax" id="form_register">
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Имя" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Пароль" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" placeholder="Пароль еще раз" class="form-control" />
                                        </div>
                                        <hr />
                                        {!! Form::token() !!}
                                        <button class="btn btn-block btn-warning">Регистрация</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="user_links" style="display: {{ Auth::check() ? 'block' : 'none' }};">
                            <div class="dropdown user-links">
                                <a href="#" class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user"></i> <span id="user_name">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }}</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="$('body').scrollTo('#subscription', 500); return false;"><i class="fa fa-calendar"></i> Подписка</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#contactsModal"><i class="fa fa-user"></i> Контактные данные</a></li>
                                    <li role="presentation"><a role="menuitem" id="logout_link" tabindex="-1" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Выход</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <nav>
                        <ul class="text-uppercase">
                            <li><a href="#" onclick="$('body').scrollTo('#how_we_work', 500); return false;">Как мы работаем</a></li>
                            <li><a href="#" onclick="$('body').scrollTo('#subscription', 500); return false;">Подписка на обеды</a></li>
                            <li><a href="#" onclick="$('body').scrollTo('#set_lunch', 500); return false;">Комплексные обеды</a></li>
                            <li><a href="#" onclick="$('body').scrollTo('#menu', 500); return false;">Меню</a></li>
                            <li><a href="#" onclick="$('body').scrollTo('#footer', 500); return false;">Контакты</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        @include('partials._status')
        @include('partials._errors')
    </div>
    <section id="image">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <h2 class="text-uppercase text-shadow">Доставка Халяль обедов</h2>
                    <p class="text-shadow">Продукция, изготовленная в соответствии с исламскими нормами, востребована не только мусульманским населением Земли. Стремящиеся к здоровому образу жизни немусульмане также охотно приобретают эти товары.</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 text-right"><img src="img/halal.png" class="img-responsive pull-right" alt="" /></div>
            </div>
        </div>
    </section>
    <section id="how_we_work">
        <div class="container">
            <div class="caption">
                <hr />
                <h3 class="caption-title text-uppercase">Как мы работаем</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-quality.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Качество 100%</strong>
                        <p>Тщательное соблюдение санитарно-гигиенических правил на всех этапах производства блюд</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-halal.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Соблюдение всех правил</strong>
                        <p>Доброе отношение и милосердие к животному до убоя, во время оного и после него</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-quality.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Бесплатная доставка</strong>
                        <p>Мы будем доставлять вам обеды бесплатно в течение всего периода подписки</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-dishes.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Выбор блюд</strong>
                        <p>Тщательное соблюдение санитарно-гигиенических правил на всех этапах производства блюд</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-try.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Обеды на пробу</strong>
                        <p>Доброе отношение и милосердие к животному до убоя, во время оного и после него</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="icon"><img src="img/icon-subscribe.png" alt="" /></div>
                    <div class="icon-text">
                        <strong class="text-uppercase">Подписка на обеды</strong>
                        <p>Мы будем доставлять вам обеды бесплатно в течение всего периода подписки</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        </div>
    </section>
    <section id="subscription">
        <form action="{{ route('subscribe') }}" method="POST" id="form_subscribe">
            {!! Form::token() !!}
            <div class="container">
                <div class="caption">
                    <hr />
                    <h3 class="caption-title text-uppercase">Подписка на обеды</h3>
                </div>

                <div class="sub-notification">
                    @if($subs && $subs->count())<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-check-circle-o"></i> Вы оформили подписку на обеды, но Вы всегда можете ее обновить.</div>@endif
                </div>

                <div class="row">
                    @for($i=1; $i<=5; $i++)
                        <div class="col-x5">
                            <div class="set" data-day="{{ $i }}">
                                <div class="title text-uppercase">
                                    {{ $daysOfWeek[$i] }}:
                                    <div class="pull-right"></div>
                                </div>
                                <div>
                                    {{----}}
                                    @if($subs)
                                        @foreach ($subs->where('day', (string)$i) as $key => $item)
                                            <div class="selected-lunch">
                                                <div class="lunch-inner">
                                                    <div class="lunch-name">{{ $item->lunch->name }}</div>
                                                    <div class="lunch-body">
                                                        <div class="lunch-part"{!! $item->lunch->meal1 ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Первое:</span>
                                                            <span class="meal1-name">{{ $item->lunch->meal1 ? $item->lunch->meal1->name : '' }} {!! $item->lunch->meal1 && $item->lunch->meal1->price ? ' - <strong>'.$item->lunch->meal1->price.' руб.</strong>' : '' !!}</span>
                                                            <input type="hidden" name="meal1[]" value="{{ $item->lunch->meal1 ? $item->lunch->meal1->id : '' }}">
                                                        </div>
                                                        <div class="lunch-part"{!! $item->lunch->meal2 ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Второе:</span>
                                                            <span class="meal2-name">{{ $item->lunch->meal2 ? $item->lunch->meal2->name : '' }} {!! $item->lunch->meal2 && $item->lunch->meal2->price ? ' - <strong>'.$item->lunch->meal2->price.' руб.</strong>' : '' !!}</span>
                                                            <input type="hidden" name="meal2[]" value="{{ $item->lunch->meal2 ? $item->lunch->meal2->id : '' }}">
                                                        </div>
                                                        <div class="lunch-part"{!! $item->lunch->garnish ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Гарнир:</span>
                                                            <span class="garnish-name">{{ $item->lunch->garnish ? $item->lunch->garnish->name : '' }} {!! $item->lunch->garnish && $item->lunch->garnish->price ? ' - <strong>'.$item->lunch->garnish->price.' руб.</strong>' : '' !!}</span>
                                                            <input type="hidden" name="garnish[]" value="{{ $item->lunch->garnish ? $item->lunch->garnish->id : '' }}">
                                                        </div>
                                                        <div class="lunch-part"{!! $item->lunch->salad ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Салат:</span>
                                                            <span class="salad-name">{{ $item->lunch->salad ? $item->lunch->salad->name : '' }} {!! $item->lunch->salad && $item->lunch->salad->price ? ' - <strong>'.$item->lunch->salad->price.' руб.</strong>' : '' !!}</span>
                                                            <input type="hidden" name="salad[]" value="{{ $item->lunch->salad ? $item->lunch->salad->id : '' }}">
                                                        </div>
                                                        <div class="lunch-part"{!! $item->lunch->drink ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Напиток:</span>
                                                            <span class="drink-name">{{ $item->lunch->drink ? $item->lunch->drink->name : '' }} {!! $item->lunch->drink && $item->lunch->drink->price ? ' - <strong>'.$item->lunch->drink->price.' руб.</strong>' : '' !!}</span>
                                                            <input type="hidden" name="drink[]" value="{{ $item->lunch->drink ? $item->lunch->drink->id : '' }}">
                                                        </div>
                                                        <div class="lunch-part"{!! $item->lunch->addition_list ? '' : ' style="display:none;"' !!}>
                                                            <span class="lunch-part-name">Разное:</span>
                                                            <span class="additions-name">
                                                                @foreach($item->lunch->additions as $a)
                                                                    <div>{{ $a->name }} {!! $a->price ? ' - <strong>'.$a->price.' руб.</strong>' : '' !!}</div>
                                                                @endforeach
                                                            </span>
                                                            <input type="hidden" name="additions[]" value="{{ implode(',', $item->lunch->addition_list) }}">
                                                        </div>
                                                    </div>
                                                    <div class="lunch-summary">
                                                        <div class="price-block">
                                                            <div class="lunch-price">
                                                                <div>Цена:</div>
                                                                <div><span>{{ $item->lunch->price }}</span> руб.</div>
                                                                <input type="hidden" name="price[]" value="{{ $item->lunch->price }}" />
                                                            </div>
                                                        </div>
                                                        <div class="quantity-block">
                                                            <div class="lunch-quantity">
                                                                <span>Количество:</span>
                                                                <span class="quantity">
                                                                    <select name="quantity[]" onchange="calculateSet()">
                                                                        @for($j=1; $j<=10; $j++)
                                                                            <option value="{{ $j }}"@if($j == $item->quantity) selected="selected"@endif>{{ $j }}</option>
                                                                            @if($item->quantity > 10)<option value="{{ $item->quantity }}" selected="selected">{{ $item->quantity }}</option>@endif
                                                                        @endfor
                                                                    </select>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="lunch-remove"><span onclick="removeSelectedLunch(this);"><i class="fa fa-remove"></i> удалить обед</span></div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="input-name" name="name[]" value="{{ $item->lunch->name }}" />
                                                <input type="hidden" class="input-day" name="day[]" value="{{ $i }}" />
                                                <input type="hidden" class="input-day" name="id[]" value="{{ $item->lunch->id }}" />
                                            </div>
                                        @endforeach
                                    @endif
                                    {{----}}
                                    <div class="add-lunch text-uppercase text-center">
                                        <a href="#" class="btn btn-success" onclick="return addLunch(this);"><i class="fa fa-plus"></i> Добавить обед</a>
                                    </div>
                                </div>
                                <div class="set-summary">
                                    <div>Обедов: <span class="count">0</span> шт.</div>
                                    <div>На сумму: <span class="sum">0</span> руб.</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="clearfix"></div>
                <div class="btn-subscribe">
                    <div class="sub-controls" style="display: {{ $subs && $subs->count() ? 'block' : 'none' }};">
                        <button class="btn btn-success btn-lg" onclick="return subscribe(this);">Обновить подписку на обеды</button>
                        <button class="btn btn-danger btn-lg" onclick="return unsubscribe(this);">Отписаться</button>
                    </div>
                    <div class="nosub-controls" style="display: {{ $subs && $subs->count() ? 'none' : 'block' }};">
                        <button class="btn btn-success btn-lg" onclick="return subscribe(this);">Подписаться на обеды</button>
                    </div>
                </div>
                <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
            </div>
        </form>
    </section>
    <section id="set_lunch">
        <div class="container">
            <div class="caption">
                <hr />
                <h3 class="caption-title text-uppercase">
                    <img src="img/caption-set.png" alt="" />
                    Комплексные обеды
                </h3>
            </div>
            <div class="row">
                @foreach ($lunchs as  $key => $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 lunch-item"{!! ($key+1) > $lunchCount ? ' style="display: none;"' : '' !!}>
                        <div class="set-lunch">
                            <div class="img">
                                @if($item->image) <img src='/images/medium/{{ $item->img_url.$item->image }}' class="img-responsive" alt='' /> @else <img src='/img/noimg.jpg' style='width: 300px; height: 200px;' class="img-responsive" alt='' /> @endif
                            </div>
                            <div class="name text-uppercase">{{ $item->name }}</div>
                            <div class="set-items">
                                <div class="set-item">
                                    <span>1-ое:</span> <span>{{ $item->meal1->name or '-' }}</span>
                                </div>
                                <div class="set-item">
                                    <span>2-ое:</span> <span>{{ $item->meal2->name or '-' }}, {{ $item->garnish->name or '-' }}</span>
                                </div>
                                <div class="set-item">
                                    <span>салат:</span> <span>{{ $item->salad->name or '-' }}</span>
                                </div>
                                <div class="set-item">
                                    <span>напиток:</span> <span>{{ $item->drink->name or '-' }}</span>
                                </div>
                                <div class="set-additions">
                                    <span>разное:</span> <span>@foreach($item->additions as $key => $addition){{ ($key ? ', ' : '').$addition->name }}@endforeach {{ count($item->additions) ? '' : '-' }}</span>
                                </div>
                            </div>
                            <div class="set-price">{{ $item->price }} руб.</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-set">
                <button class="btn btn-success btn-lg" onclick="$('#set_lunch .lunch-item').show();">Показать еще обеды</button>
            </div>
            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        </div>
    </section>
    <section id="menu">
        <div class="container">
            <div class="caption">
                <hr />
                <h3 class="caption-title text-uppercase">
                    <img src="img/caption-menu.png" alt="" />
                    Меню
                </h3>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="menu-caption menu-caption-1 text-uppercase">Первое:</div>
                    @foreach ($meal1 as $key => $item)
                        <div class="menu-item"{!! ($key+1) > $menuCount ? ' style="display: none;"' : '' !!}>
                            <div class="menu-img">
                                @if($item->image) <img src='/images/small/{{ $item->img_url.$item->image }}' class="img-responsive" alt='' /> @else <img src='/img/noimg.jpg' style='width: 100px; height: 80px;' class="img-responsive" alt='' /> @endif
                            </div>
                            <div class="menu-info">
                                <strong>{{ $item->name }}</strong>
                                <div><span>Состав:</span> {{ $item->consist }}</div>
                                <div><span>Вес:</span> {{ $item->weight }}</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="menu-caption menu-caption-2 text-uppercase">Второе:</div>
                    @foreach ($meal2 as $key => $item)
                        <div class="menu-item"{!! ($key+1) > $menuCount ? ' style="display: none;"' : '' !!}>
                            <div class="menu-img">
                                @if($item->image) <img src='/images/small/{{ $item->img_url.$item->image }}' class="img-responsive" alt='' /> @else <img src='/img/noimg.jpg' style='width: 100px; height: 80px;' class="img-responsive" alt='' /> @endif
                            </div>
                            <div class="menu-info">
                                <strong>{{ $item->name }}</strong>
                                <div><span>Состав:</span> {{ $item->consist }}</div>
                                <div><span>Вес:</span> {{ $item->weight }}</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                    <div class="garnishs">
                        <strong>Гарнир:</strong>  @foreach ($garnishs as $key => $item){{ ($key ? ', ' : '').$item->name }}@endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="menu-caption menu-caption-3 text-uppercase">Салаты:</div>
                    @foreach ($salads as $key => $item)
                        <div class="menu-item"{!! ($key+1) > $menuCount ? ' style="display: none;"' : '' !!}>
                            <div class="menu-img">
                                @if($item->image) <img src='/images/small/{{ $item->img_url.$item->image }}' class="img-responsive" alt='' /> @else <img src='/img/noimg.jpg' style='width: 100px; height: 80px;' class="img-responsive" alt='' /> @endif
                            </div>
                            <div class="menu-info">
                                <strong>{{ $item->name }}</strong>
                                <div><span>Состав:</span> {{ $item->consist }}</div>
                                <div><span>Вес:</span> {{ $item->weight }}</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="menu-caption menu-caption-4 text-uppercase">Напитки:</div>
                    @foreach ($drinks as $key => $item)
                        <div class="menu-item"{!! ($key+1) > $menuCount ? ' style="display: none;"' : '' !!}>
                            <div class="menu-img">
                                @if($item->image) <img src='/images/small/{{ $item->img_url.$item->image }}' class="img-responsive" alt='' /> @else <img src='/img/noimg.jpg' style='width: 100px; height: 80px;' class="img-responsive" alt='' /> @endif
                            </div>
                            <div class="menu-info">
                                <strong>{{ $item->name }}</strong>
                                <div><span>Вес:</span> {{ $item->weight }}</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="btn-menu">
                <button class="btn btn-success btn-lg" onclick="$('#menu .menu-item').show();">Показать все меню</button>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="caption text-uppercase">Контакты</div>
                    <dl class="dl-horizontal">
                        <dt>Телефон:</dt>
                        <dd>+7 985 666 65 66</dd>
                        <dt>Email:</dt>
                        <dd>info@halal-eda.com</dd>
                        <dt>Адрес:</dt>
                        <dd>г.Москва, ул. Маршала Прошлякова, 26/3</dd>
                    </dl>
                    <p>&nbsp;</p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="caption text-uppercase text-right">Обратная связь</div>
                    <form action="{{ route('feedback') }}" method="POST" id="form_feedback">
                        {!! Form::token() !!}
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Телефон">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Сообщение"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block" onclick="return feedback(this);">Отправить сообщение</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>
@include('partials._templates')
@include('partials._footer')