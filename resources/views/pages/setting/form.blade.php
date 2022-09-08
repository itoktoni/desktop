@extends(Template::master())

@section('title')
<h4>Setting Website</h4>
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

				<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
					<label>{{ __('Name') }}</label>
					{!! Form::text('name', env('APP_NAME'), ['class' => 'form-control', 'id' => 'name', 'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group">
					<label>{{ __('Description') }}</label>
					{!! Form::textarea('description', env('APP_DESCRIPTION'), ['class' => 'form-control h-auto', 'id' =>
					'description', 'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
				</div>

				<div class="form-group">

					<label>{{ __('Language') }}</label>

					{!! Form::select('language', ['id' => 'Indonesia', 'en' => 'English'], env('APP_LOCAL'), ['class' =>
					'form-control', 'id' => 'language', 'placeholder' => '- Select Language -', 'required']) !!}
				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group {{ $errors->has('file_logo') ? 'has-error' : '' }}">
					<label>Logo</label>
					<img class="img-fluid col-md-12 img-thumbnail mb-2" src="{{ url('storage/'.env('APP_LOGO')) }}"
						alt="">
					<input type="file" class="file btn btn-default btn-block" data="APP_LOGO" name="file_logo" />
				</div>

				<div class="form-group {{ $errors->has('upload_logo') ? 'has-error' : '' }}">
					<label>Header Print</label>
					<img class="img-fluid col-md-12 img-thumbnail mb-2" src="{{ url('storage/'.env('APP_HEADER')) }}"
						alt="">
					<input type="file" class="file btn btn-default btn-block" data="APP_HEADER" name="file_header" />
				</div>

			</div>

		</div>


	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('javascript')
@include(Template::components('form'))
@endpush