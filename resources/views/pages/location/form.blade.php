@extends(Template::ajax())

@section('title') Master Location @endsection

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
         <div class="form-group {{ $errors->has('location_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('location_name', null, ['class' => 'form-control', 'id' => 'location_name', 'placeholder' =>
            'Please fill this input', 'required']) !!}
            {!! $errors->first('location_name', '<p class="help-block">:message</p>') !!}
        </div>

         <div class="form-group">
            <label>Building</label>
            {!! Form::select('location_building_id', $building, null, ['class' => 'form-control', 'id' =>
            'location_name', 'placeholder' => '- Select building -', 'required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('location_description', null, ['class' => 'form-control h-auto', 'id' =>
            'location_description',
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
@include(Template::components('form'))
@endsection
