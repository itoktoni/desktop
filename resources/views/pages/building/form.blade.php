@extends(Template::ajax())

@section('title') Master Building @endsection

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
        <div class="form-group {{ $errors->has('building_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('building_name', null, ['class' => 'form-control', 'id' => 'building_name', 'placeholder' =>
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
            {!! Form::text('building_contact_phone', null, ['class' => 'form-control', 'id' => 'building_contact_phone',
            'placeholder' => 'Please fill this input']) !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('building_description', null, ['class' => 'form-control', 'id' => 'building_description',
            'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
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