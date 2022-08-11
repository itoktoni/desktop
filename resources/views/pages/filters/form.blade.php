@extends(Template::ajax())

@section('title') Master Filters @endsection

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
            <label>Code</label>
            {!! Form::text('filter_code', null, ['class' => 'form-control', 'id' => 'filter_code', 'placeholder' =>
            'Please fill this input', 'required']) !!}
        </div>
        <div class="form-group">
            <label>Table</label>
            {!! Form::text('filter_table', null, ['class' => 'form-control', 'id' => 'filter_table', 'placeholder' =>
            'Please fill this input', 'required']) !!}
        </div>
        <div class="form-group">
            <label>Function</label>
            {!! Form::text('filter_function', null, ['class' => 'form-control', 'id' => 'filter_function', 'placeholder'
            =>
            'Please fill this input', 'required']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Data From User</label>
            {!! Form::select('filter_from_user', $status, null, ['class' => 'form-control', 'id' =>
            'filter_from_user', 'placeholder' => '- Select Filter -', 'required']) !!}
        </div>

        <div class="form-group">
            <label>Field</label>
            {!! Form::text('filter_field', null, ['class' => 'form-control', 'id' => 'filter_field',
            'placeholder' => 'Please fill this input', 'required']) !!}
        </div>

        <div class="form-group">
            <label>Operator</label>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::text('filter_operator', null, ['class' => 'form-control', 'id' => 'filter_operator',
                    'placeholder' => 'Please fill this input', 'required']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('filter_value', null, ['class' => 'form-control', 'id' => 'filter_value',
                    'placeholder' => 'Please fill this input', 'required']) !!}
                </div>
            </div>
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