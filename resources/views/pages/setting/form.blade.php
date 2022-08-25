@extends(Template::ajax())

@section('title') Setting System @endsection

@section('form')

@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' =>
$model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true]) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation',
'files' => true]) !!}
@endif

@endsection

@section('container')

<div class="accordion custom-accordion">
	<div class="accordion-row open">
		<a href="#" class="accordion-header">
			<span>Accordion 1</span>
			<i class="accordion-status-icon close fa fa-chevron-up"></i>
			<i class="accordion-status-icon open fa fa-chevron-down"></i>
		</a>
		<div class="accordion-body">...</div>
	</div>
	<div class="accordion-row">
		<a href="#" class="accordion-header">
			<span>Accordion 2</span>
			<i class="accordion-status-icon close fa fa-chevron-up"></i>
			<i class="accordion-status-icon open fa fa-chevron-down"></i>
		</a>
		<div class="accordion-body">...</div>
	</div>
	<div class="accordion-row">
		<a href="#" class="accordion-header">
			<span>Accordion 3</span>
			<i class="accordion-status-icon close fa fa-chevron-up"></i>
			<i class="accordion-status-icon open fa fa-chevron-down"></i>
		</a>
		<div class="accordion-body">...</div>
	</div>
</div>

<div class="row" data-label="CODE EXAMPLE">

	<div class="col-md-6">

		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			<label>Name</label>
			{!! Form::text('name', env('APP_NAME'), ['class' => 'form-control', 'id' => 'name', 'placeholder'
			=> 'Please fill this input', 'required']) !!}
			{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
		</div>

		<div class="form-group">
			<label>Description</label>
			{!! Form::textarea('description', null, ['class' => 'form-control h-auto', 'id' =>
			'description',
			'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
		</div>
	</div>

	<div class="col-md-6">

		<div class="form-group {{ $errors->has('file_logo') ? 'has-error' : '' }}">
			<label>Logo</label>
			<img class="img-fluid col-md-12 img-thumbnail mb-2" src="{{ url('storage/'.env('APP_LOGO')) }}" alt="">
			<input type="file" class="file btn btn-default btn-block" data="APP_LOGO" name="file_logo" />
		</div>

		<div class="form-group {{ $errors->has('upload_logo') ? 'has-error' : '' }}">
			<label>Header Print</label>
			<img class="img-fluid col-md-12 img-thumbnail mb-2" src="{{ url('storage/'.env('APP_HEADER')) }}" alt="">
			<input type="file" class="file btn btn-default btn-block" data="APP_HEADER" name="file_header" />
		</div>

	</div>

</div>



@endsection

@section('action')
<div class="button">
	<button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent

@push('footer')