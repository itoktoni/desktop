@extends(Template::ajax())

@section('title') Master Department @endsection

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

        <div class="form-group {{ $errors->has('department_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('department_name', null, ['class' => 'form-control', 'id' => 'department_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('department_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('department_description', null, ['class' => 'form-control h-auto', 'id' =>
            'department_description',
            'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>User</label>
            {!! Form::select('department_user_id', $user, null, ['class' => 'form-control', 'id' =>
            'department_name', 'placeholder' => '- Select User -', 'required']) !!}
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

@component(Template::components('date'))
@endcomponent
