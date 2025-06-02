<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title', 'Panel de administración')</title>

	<!-- Global stylesheets -->
	<link href="{{ asset('assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('assets/js/vendor/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('assets/js/vendor/visualization/d3/d3_tooltip.js')}}"></script>

	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="{{asset('assets/js/dashboard/dashboard.js')}}"></script>
	<!-- /theme JS files -->

  <!-- Scripts específicos de vistas -->
  @stack('scripts')
</head>

<body>
	<!-- Page content -->
	<div class="page-content">
		@include('components.sidebar')
		<!-- Main content -->
		<div class="content-wrapper">
	    @include('components.navbar')
			<!-- Inner content -->
			<div class="content-inner">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content d-lg-flex">
						<div class="d-flex">
							<h4 class="page-title mb-0">
								@yield('page-header')
							</h4>
						</div>
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content pt-0">
          @yield('content')
				</div>
				<!-- /content area -->
			</div>
			<!-- /inner content -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html>