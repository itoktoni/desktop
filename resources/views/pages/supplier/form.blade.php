@extends(Template::ajax())

@section('title') Master Supplier @endsection

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

@endsection

@section('action')
<div class="button">
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection
