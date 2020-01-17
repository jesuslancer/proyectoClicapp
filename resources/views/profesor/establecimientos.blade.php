@extends('app')

@section('title','Establecimientos')

@section('estilo')
<link href="{{ asset('assets/plugins/custom/jquery-ui/jquery-ui.bundle.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/pages/todo/todo.css') }}" rel="stylesheet">
@endsection

@section('asignatura')
Establecimientos
@endsection

@section('content')

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

	<div class="kt-portlet ">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Seleccione el Establecimiento y la Asignatura a planificar
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<!--begin::Accordion-->
			<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
				@foreach($persona->establecimientos as $key => $establecimiento)
					<div class="card">
						<div class="card-header" id="headingOne6">
							<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
								<i class="flaticon2-position"></i> {{ $establecimiento->nombre }}
							</div>
						</div>
						<div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
							<div class="card-body">
								<div class="m-demo__preview m-demo__preview--btn">
									@foreach($materias as $key => $materia)
										<a href=" {{route('unidades_curso', [$persona,$materia->id,$materia->nivel_id,$materia->curso_id,$establecimiento->id]) }}" class="btn btn-outline-success" >
											<span>
												<i class="flaticon2-list-3"></i>
												<span> {{ $materia->nombre }} <br> {{ $materia->nivel }} - {{ $materia->letra }} </span>
											</span>
										</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<!--end::Accordion-->
		</div>
	</div>

</div>

@endsection

@section('script')
		<!--begin::Page Scripts -->
	<script src="assets/plugins/custom/jquery-ui/jquery-ui.bundle.js"></script>
	<script src="assets/js/pages/dashboard.js"></script>
	<script src="assets/css/pages/todo/todo.js"></script>
	<script src="{{ asset('js/sweetalert2.js') }}"></script>
@endsection