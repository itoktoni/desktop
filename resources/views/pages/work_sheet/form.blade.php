@extends(Template::master())

@section('title')
<h4>Lembar Kerja</h4>
@endsection

@section('action')
<div class="button">
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

				<div class="form-group">
					<label>Ticket</label>
					{!! Form::select('work_sheet_ticket_code', $ticket, request()->get('ticket_id') ?? null,
					['placeholder' =>
					'- Select Ticket -', 'class' => 'form-control ticket', ]) !!}
				</div>

				<div class="form-group {{ $errors->has('work_sheet_product_id') ? 'has-error' : '' }}">
					<label>Product</label>
					{!! Form::select('work_sheet_product_id', $product, null, ['class' => 'form-control selectize', 'id'
					=>
					'work_sheet_product_id', 'placeholder' => '- Select Product -', 'required']) !!}
				</div>

				<div class="form-group {{ $errors->has('work_sheet_reported_at') ? 'has-error' : '' }}">
					<label>{{ __('Report') }} Date</label>
					{!! Form::text('work_sheet_reported_at', null, ['placeholder' => 'Please fill this input', 'class'
					=>
					'form-control date', 'id' =>
					'work_sheet_reported_at', 'required']) !!}
					{!! $errors->first('work_sheet_reported_at', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group {{ $errors->has('work_sheet_type_id') ? 'has-error' : '' }}">
							<label>Type</label>
							{!! Form::select('work_sheet_type_id', $work_type, null, ['class' => 'form-control', 'id' =>
							'work_sheet_type_id', 'placeholder' => '- Select work Type -', 'required']) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group {{ $errors->has('work_sheet_status') ? 'has-error' : '' }}">
							<label>Status</label>
							{!! Form::select('work_sheet_status', $status, null, ['class' => 'form-control', 'id' =>
							'work_sheet_status', 'placeholder' => '- Select Status -']) !!}
						</div>
					</div>
				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('work_sheet_name') ? 'has-error' : '' }}">
					<label>{{ __('Name') }}</label>
					{!! Form::text('work_sheet_name', $data_ticket ? 'Follow up : '.$data_ticket->field_name : null,
					['class' =>
					'form-control', 'id' => 'work_sheet_name', 'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('work_sheet_name', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group">
					<label>Reported By</label>
					{!! Form::select('work_sheet_reported_by', $user, $data_ticket->field_reported_By ?? null,
					['placeholder' =>
					'- Select User -', 'class' => 'form-control']) !!}
				</div>

				<div class="form-group {{ $errors->has('work_sheet_description') ? 'has-error' : '' }}">
					<label>{{ __('Description') }}</label>
					{!! Form::textarea('work_sheet_description', null, ['class' => 'form-control h-auto', 'id' =>
					'work_sheet_description',
					'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
				</div>

			</div>
		</div>

		@if(isset($model))
		<hr>
		<div class="form-group">
			<label>Check</label>
			{!! Form::textarea('work_sheet_check', null, ['class' => 'form-control h-auto', 'id' =>
			'work_sheet_check',
			'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
		</div>

		<div class="form-group">
			<label>Result</label>
			{!! Form::textarea('work_sheet_result', null, ['class' => 'form-control h-auto', 'id' =>
			'work_sheet_result',
			'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
		</div>
		@endif
	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('javascript')
@include(Template::components('form'))
@include(Template::components('date'))

<script>
$('.ticket').change(function() {
	var id = $(".ticket option:selected").val();
	var uri = window.location.toString();
	var clean_uri = window.location.toString();
	if (uri.indexOf("?") > 0) {
		clean_uri = uri.substring(0, uri.indexOf("?"));
		window.history.replaceState({}, document.title, clean_uri);
	}
	window.location = clean_uri + '?ticket_id=' + id;
});
</script>

@endpush