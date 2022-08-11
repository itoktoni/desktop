@extends(Template::ajax())

@section('title') Master Brand @endsection

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
        <div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('brand_name', null, ['class' => 'form-control', 'id' => 'brand_name', 'placeholder' =>
            'Please fill this input', 'required']) !!}
            {!! $errors->first('brand_name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Description</label>
            {!! Form::text('brand_description', null, ['class' => 'form-control', 'id' => 'brand_description',
            'placeholder' => 'Please fill this input']) !!}
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
