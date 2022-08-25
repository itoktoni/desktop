@extends(Template::master())

@section('title')
<h4>Master Building</h4>
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
				<div class="form-group {{ $errors->has('building_name') ? 'has-error' : '' }}">
					<label>Name</label>
					{!! Form::text('building_name', null, ['class' => 'form-control', 'id' => 'building_name',
					'placeholder' =>
					'Please fill this input', 'required']) !!}
					{!! $errors->first('building_name', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Building Address</label>
					{!! Form::text('building_address', null, ['class' => 'form-control', 'id' => 'building_address',
					'placeholder' => 'Please fill this input']) !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Contact Person</label>
					{!! Form::text('building_contact_person', null, ['class' => 'form-control', 'id' =>
					'building_contact_person', 'placeholder' => 'Please fill this input']) !!}
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Contact Phone</label>
					{!! Form::text('building_contact_phone', null, ['class' => 'form-control', 'id' =>
					'building_contact_phone',
					'placeholder' => 'Please fill this input']) !!}
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label>Description</label>
					{!! Form::textarea('building_description', null, ['class' => 'form-control', 'id' =>
					'building_description',
					'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
				</div>
			</div>
		</div>

	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('footer')
@include(Template::components('form'))
@endpush