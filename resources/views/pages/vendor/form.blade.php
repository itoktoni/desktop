@extends(Template::ajax())

<<<<<<< Updated upstream:resources/views/pages/supplier/form.blade.php
@section('title') Master Supplier @endsection

@section('form')

@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' =>
$model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true]) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation',
'files' => true]) !!}
@endif
=======
@section('title')
<h4>Master Vendor</h4>
@endsection
>>>>>>> Stashed changes:resources/views/pages/vendor/form.blade.php

@endsection

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('supplier_name') ? 'has-error' : '' }}">
            <label>Supplier Name</label>
            {!! Form::text('supplier_name', null, ['class' => 'form-control', 'id' => 'supplier_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('supplier_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Supplier Contact</label>
            {!! Form::text('supplier_contact', null, ['class' => 'form-control', 'id' =>
            'supplier_contact', 'placeholder' => 'Please fill this input', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('supplier_email') ? 'has-error' : '' }}">
            <label>Supplier Email</label>
            {!! Form::text('supplier_email', null, ['class' => 'form-control', 'id' => 'supplier_email', 'placeholder' => 'Please fill this input']) !!}
            {!! $errors->first('supplier_email', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Supplier Phone</label>
            {!! Form::text('supplier_phone', null, ['class' => 'form-control', 'id' => 'supplier_phone',
            'placeholder' => 'Please fill this input', 'required']) !!}
        </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
            <label>Supplier Address</label>
            {!! Form::text('supplier_address', null, ['class' => 'form-control', 'id' => 'supplier_address',
            'placeholder' => 'Please fill this input', 'required']) !!}
        </div>
    </div>

</div>

<<<<<<< Updated upstream:resources/views/pages/supplier/form.blade.php
@endsection
=======
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('vendor_name') ? 'has-error' : '' }}">
					<label>Vendor Name</label>
					{!! Form::text('vendor_name', null, ['class' => 'form-control', 'id' => 'vendor_name',
					'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('vendor_name', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group">
					<label>Vendor Contact</label>
					{!! Form::text('vendor_contact', null, ['class' => 'form-control', 'id' =>
					'vendor_contact', 'placeholder' => 'Please fill this input', 'required']) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('vendor_email') ? 'has-error' : '' }}">
					<label>Vendor Email</label>
					{!! Form::text('vendor_email', null, ['class' => 'form-control', 'id' => 'vendor_email',
					'placeholder' => 'Please fill this input']) !!}
					{!! $errors->first('vendor_email', '<p class="help-block">:message</p>') !!}
				</div>
				<div class="form-group">
					<label>Vendor Phone</label>
					{!! Form::text('vendor_phone', null, ['class' => 'form-control', 'id' => 'vendor_phone',
					'placeholder' => 'Please fill this input', 'required']) !!}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label>Vendor Address</label>
					{!! Form::text('vendor_address', null, ['class' => 'form-control', 'id' => 'vendor_address',
					'placeholder' => 'Please fill this input', 'required']) !!}
				</div>
			</div>
>>>>>>> Stashed changes:resources/views/pages/vendor/form.blade.php

@section('action')
<div class="button">
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection
