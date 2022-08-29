@extends(Template::master())

@section('title')
<h4>Report Tiket</h4>
@endsection

@section('action')
<div class="button">
	<button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('container')

{!! Form::open(['url' => route(SharedData::get('route').'.getPrint'), 'class' => 'form-horizontal needs-validation',
'method' => 'GET']) !!}

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
				<div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
					<label>Start Date</label>
					{!! Form::text('start_date', null, ['class' => 'form-control date', 'id' => 'start_date',
					'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
					<label>End Date</label>
					{!! Form::text('end_date', null, ['class' => 'form-control date', 'id' => 'end_date', 'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group {{ $errors->has('ticket_system_topic_id') ? 'has-error' : '' }}">
					<label>Topik Ticket</label>
					{!! Form::select('ticket_system_topic_id', $ticket_topic, null, ['class' => 'form-control', 'id' =>
					'ticket_system_topic_id', 'placeholder' => '- Select Status -']) !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group {{ $errors->has('ticket_system_department_id') ? 'has-error' : '' }}">
					<label>Department</label>
					{!! Form::select('ticket_system_department_id', $department, null, ['class' => 'form-control', 'id'
					=>
					'ticket_system_department_id', 'placeholder' => '- Select Status -']) !!}
				</div>
			</div>

		</div>


	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('javascript')
@include(Template::components('form'))
@include(Template::components('date'))
@endpush