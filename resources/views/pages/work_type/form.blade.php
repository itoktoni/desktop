@extends(Template::ajax())

@section('title') Transaction Work Type @endsection

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
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('work_type_name') ? 'has-error' : '' }}">
        <label>Name</label>
            {!! Form::text('work_type_name', null, ['class' => 'form-control', 'id' => 'work_type_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('work_type_name', '<p class="help-block">:message</p>') !!}
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
