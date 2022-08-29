@extends(Template::master())

@section('title')
<h4>Tiket System</h4>
@endsection

@section('action')
<div class="button">
	<a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
	<button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
	@if($model)
	<a target="_blank" href="{{ route(SharedData::get('route').'.getPdf', ['code' => $model->field_primary]) }}"
		class="btn btn-danger">Print PDF</a>
	@endif
</div>
@endsection

@section('container')

{!! Template::form_open($model) !!}

@if(!request()->ajax())
<div class="page-header">
	<div class="header-container container-fluid d-sm-flex justify-content-between">
		@yield('title')
		@yield('action')
	</div>
</div>
@endif

<div class="card">
	<div class="card-body">
		<div class="row">

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group {{ $errors->has('ticket_system_department_id') ? 'has-error' : '' }}">
							<label>Department</label>
							{!! Form::select('ticket_system_department_id', $department, null, ['class' =>
							'form-control', 'id'
							=> 'ticket_system_department_id', 'placeholder' => '- Select Department -', 'required']) !!}
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group {{ $errors->has('ticket_system_topic_id') ? 'has-error' : '' }}">
							<label>Topic</label>
							{!! Form::select('ticket_system_topic_id', $ticket_topic, null, ['class' => 'form-control',
							'id' =>
							'ticket_system_topic_id', 'placeholder' => '- Select work Type -', 'required']) !!}
						</div>
					</div>
				</div>

				<div class="form-group {{ $errors->has('ticket_system_name') ? 'has-error' : '' }}">
					<label>Subject</label>
					{!! Form::text('ticket_system_name', null, ['class' => 'form-control', 'id' => 'ticket_system_name',
					'placeholder' => 'Please fill this input', 'required']) !!}
					{!! $errors->first('ticket_system_name', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group {{ $errors->has('ticket_system_description') ? 'has-error' : '' }}">
					<label>Description</label>
					{!! Form::textarea('ticket_system_description', null, ['class' => 'form-control h-auto', 'id' =>
					'ticket_system_description', 'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
				</div>

				<div class="form-group {{ $errors->has('ticket_system_description') ? 'has-error' : '' }}">
					<!-- The `label` is attached to the hidden file input -->
					<label for="cameraFileInput">
						<span class="btn btn-success">Open camera</span>

						<!-- The hidden file `input` for opening the native camera -->
						<input id="cameraFileInput" type="file" accept="image/*" capture="environment" />
					</label>

					<!-- displays the picture uploaded from the native camera -->
					<img id="pictureFromCamera" />
				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('work_sheet_reported_at') ? 'has-error' : '' }}">
					<label>Report Date</label>
					{!! Form::text('ticket_system_reported_at', null, ['class' => 'form-control date', 'id' =>
					'ticket_system_reported_at', 'placeholder' => 'Please fill this input', 'required']) !!}
					{!! $errors->first('ticket_system_reported_at', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group">
					<label>Reported By</label>
					{!! Form::select('ticket_system_reported_by', $user, auth()->user()->id ?? null, ['class' =>
					'form-control',
					'placeholder' => '-
					Select User -']) !!}
				</div>

				<div class="form-group">
					<label>Location</label>
					{!! Form::select('ticket_system_location_id', $location, null, ['class' => 'form-control',
					'placeholder' =>
					'- Select Location -']) !!}
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group {{ $errors->has('ticket_system_status') ? 'has-error' : '' }}">
							<label>Status</label>
							{!! Form::select('ticket_system_status', $status, null, ['class' => 'form-control', 'id' =>
							'ticket_system_status', 'placeholder' => '- Select Status -']) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group {{ $errors->has('ticket_system_priority') ? 'has-error' : '' }}">
							<label>Priority</label>
							{!! Form::select('ticket_system_priority', $priority, null, ['class' => 'form-control', 'id'
							=>
							'ticket_system_priority', 'placeholder' => '- Select Status -']) !!}
						</div>
					</div>
				</div>
				@if(isset($model))
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Pilih Pelaksana</label>
							{!! Form::select('ticket_system_implementor[]', $implementor, $model->field_implementor ??
							null,
							['class' => 'form-control',
							'multiple', 'data-placeholder' => 'Pilih Pelaksana']) !!}
						</div>
					</div>
				</div>
				@endif

			</div>
		</div>
	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('javascript')
@include(Template::components('form'))
@include(Template::components('date'))

<style>
#cameraFileInput {
	display: none;
}

#pictureFromCamera {
	width: 100%;
	height: auto;
	margin-top: 16px;
}

.btn {
	display: inline-block;
	background-color: #00b531;
	color: white;
	padding: 8px 12px;
	border-radius: 4px;
	font-size: 16px;
	cursor: pointer;
}

.btn:hover {
	filter: brightness(0.9);
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
document
	.getElementById("cameraFileInput")
	.addEventListener("change", function() {
		document
			.getElementById("pictureFromCamera")
			.setAttribute("src", window.URL.createObjectURL(this.files[0]));
	});
</script>

@endpush