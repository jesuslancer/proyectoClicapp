
<!-- begin:: Page -->

<!--[html-partial:include:{"file":"partials/_header/base-mobile.html"}]/-->
@include('partials._header.base-mobile')

<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<!--[html-partial:include:{"file":"partials/_aside/base.html"}]/-->
		@include('partials._aside.base')

		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

			<!--[html-partial:include:{"file":"partials/_header/base.html"}]/-->
			@include('partials._header.base')

			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

				<!--[html-partial:include:{"file":"partials/_subheader/subheader-v2.html"}]/-->
				 @include('partials._subheader.subheader-v2')

				<!--[html-partial:include:{"file":"partials/_content/base.html"}]/-->
				{{-- @include('partials._content.base') --}}
				@yield('content')
			</div>

			<!--[html-partial:include:{"file":"partials/_footer/base.html"}]/-->
			@include('partials._footer.base')
		</div>
	</div>
</div>

<!-- end:: Page -->

<!--[html-partial:include:{"file":"partials/_scrolltop.html"}]/-->
@include('partials._scrolltop')

<!--[html-partial:include:{"file":"partials/_chat.html"}]/-->
@include('partials._chat')