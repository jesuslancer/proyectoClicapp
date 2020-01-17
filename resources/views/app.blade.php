<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		@yield('titulo')
		<meta name="description" content="Updates and statistics">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet">
		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">
		<!--end::Global Theme Styles -->

		@yield('estilo')

		<!--begin::Layout Skins(used by all pages) -->
		<link href="{{ asset('css/skins/aside/dark.css') }}" rel="stylesheet">
		<link href="{{ asset('css/skins/brand/light.css') }}" rel="stylesheet">
		<link href="{{ asset('css/skins/header/base/light.css') }}" rel="stylesheet">
		<link href="{{ asset('css/skins/header/menu/light.css') }}" rel="stylesheet">
		<!--end::Layout Skins -->

		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

		@yield('head')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!--[html-partial:include:{"file":"partials/_page-loader.html"}]/-->
		@include('partials._page-loader')

		<!--[html-partial:include:{"file":"layout.html"}]/-->
		@include('layout')

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

		<!--begin::Page Vendors(used by this page) -->
		<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
		<script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}"></script>
		<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
	
		<!--end::Page Vendors -->

		@yield('script')
		<!--end::Page Scripts -->
		
	</body>

	<!-- end::Body -->
</html>