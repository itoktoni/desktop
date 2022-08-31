@extends(Template::master())

@section('title')
<h4>Master Schedule</h4>
@endsection

@section('action')
<div class="button">
	<button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
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
				<div class="form-group {{ $errors->has('schedule_name') ? 'has-error' : '' }}">
					<label>{{ __('Name') }}</label>
					{!! Form::text('schedule_name', null, ['class' => 'form-control', 'id' => 'schedule_name',
					'placeholder' => 'Please fill this input', 'required']) !!}
					{!! $errors->first('schedule_name', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group {{ $errors->has('schedule_number') ? 'has-error' : '' }}">
					<label>Number</label>
					{!! Form::text('schedule_number', null, ['class' => 'form-control', 'id' => 'schedule_number',
					'placeholder' => 'Please fill this input', 'required']) !!}
					{!! $errors->first('schedule_number', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group {{ $errors->has('schedule_every') ? 'has-error' : '' }}">
					<label>Every</label>
					{!! Form::text('schedule_every', null, ['class' => 'form-control', 'id' => 'schedule_every',
					'placeholder' => 'Please fill this input', ]) !!}
					{!! $errors->first('schedule_every', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group {{ $errors->has('schedule_date') ? 'has-error' : '' }}">
					<label>Date</label>
					{!! Form::text('schedule_date', null, ['class' => 'form-control date', 'id' => 'schedule_date',
					'placeholder' => 'Please fill this input', 'required']) !!}
					{!! $errors->first('schedule_date', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group {{ $errors->has('schedule_product_id') ? 'has-error' : '' }}">
					<label>Product ID</label>
					{!! Form::select('schedule_product_id', $product, null, ['class' => 'form-control', 'id' =>
					'schedule_product_id', 'placeholder' => '- Select Product ID-', 'required']) !!}
					{!! $errors->first('schedule_product_id', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group {{ $errors->has('schedule_notification') ? 'has-error' : '' }}">
					<label>Status</label>
					{!! Form::select('schedule_notification', $status, null, ['class' => 'form-control', 'id' =>
					'schedule_notification', 'placeholder' => '- Select Status -']) !!}
				</div>
				<div class="form-group {{ $errors->has('schedule_description') ? 'has-error' : '' }}">
					<label>{{ __('Description') }}</label>
					{!! Form::textarea('schedule_description', null, ['class' => 'form-control h-auto', 'id' =>
					'schedule_description', 'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
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