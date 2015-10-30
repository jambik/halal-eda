@include('admin.partials._header')

@include('admin.partials._nav')

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-2 col-md-3 col-sm-3">
			@include('admin.partials._menu')
		</div>
		<div class="col-lg-10 col-md-9 col-sm-9">
			@include('flash::message')
			@include('admin.partials._status')
			@include('admin.partials._errors')
			@yield('content')
		</div>
	</div>
</div>

@include('admin.partials._footer')