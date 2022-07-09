@extends(Template::ajax())

@section('title') Master Routes @endsection

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
        <div class="form-group">
            <label>Group</label>
            {!! Form::text('route_group', null, ['class' => 'form-control', 'id' => 'route_group', 'placeholder'
            => 'Please fill this input', 'required']) !!}
        </div>

        <div class="form-group {{ $errors->has('route_code') ? 'has-error' : '' }}">
            <label>Code</label>
            {!! Form::text('route_code', null, ['class' => 'form-control', 'id' => 'route_code', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('route_code', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('route_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('route_name', null, ['class' => 'form-control', 'id' => 'route_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('route_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Controller</label>
            {!! Form::text('route_controller', null, ['class' => 'form-control', 'id' => 'route_controller',
            'placeholder'
            => 'Please fill this input', 'required']) !!}
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Active</label>
            {{ Form::select('route_active', $status, null, ['class'=> 'form-control', 'id' => 'route_active']) }}
        </div>

        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('route_description', null, ['class' => 'form-control h-auto', 'id' => 'email',
            'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
        </div>
    </div>
</div>

@endsection

@section('action')
<div class="button">
    <button type="submit" class="btn btn-primary" id="modal-btn-save">Save changes</button>
</div>
@endsection

@section('javascript')
@include(Template::javascript('form'))
@endsection