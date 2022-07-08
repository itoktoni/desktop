@extends(Template::ajax())

@section('title') Master User @endsection

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
            <label>Name</label>
            {!! Form::text('location_name', null, ['class' => 'form-control', 'id' => 'location_name', 'placeholder' =>
            'Please fill this input', 'required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Description</label>
            {!! Form::text('location_description', null, ['class' => 'form-control', 'id' => 'location_description',
            'placeholder' => 'Please fill this input', 'required']) !!}
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