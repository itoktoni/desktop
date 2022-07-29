@extends(Template::ajax())

@section('title') Transaction Work Sheet @endsection

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
        <div class="form-group {{ $errors->has('work_sheet_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('work_sheet_name', null, ['class' => 'form-control', 'id' => 'work_sheet_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('work_sheet_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('work_sheet_product_id') ? 'has-error' : '' }}">
            <label>Product</label>
            {!! Form::select('work_sheet_product_id', $product, null, ['class' => 'form-control', 'id' =>
            'work_sheet_product_id', 'placeholder' => '- Select Product -', 'required']) !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('work_sheet_type_id') ? 'has-error' : '' }}">
                    <label>Type</label>
                    {!! Form::select('work_sheet_type_id', $work_type, null, ['class' => 'form-control', 'id' =>
                    'work_sheet_type_id', 'placeholder' => '- Select work Type -', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('work_sheet_status') ? 'has-error' : '' }}">
                    <label>Status</label>
                    {!! Form::select('work_sheet_status', $status, null, ['class' => 'form-control', 'id' =>
                    'work_sheet_status', 'placeholder' => '- Select Status -']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Reported By</label>
            {!! Form::select('work_sheet_reported_by', $user, null, ['class' => 'form-control', 'placeholder' => '-
            Select User -']) !!}
        </div>

        <div class="form-group {{ $errors->has('work_sheet_description') ? 'has-error' : '' }}">
            <label>Description</label>
            {!! Form::textarea('work_sheet_description', null, ['class' => 'form-control h-auto', 'id' =>
            'work_sheet_description',
            'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
        </div>

    </div>
</div>

@if(isset($model))
<hr>
<div class="form-group">
    <label>Check</label>
    {!! Form::textarea('work_sheet_check', null, ['class' => 'form-control h-auto', 'id' =>
    'work_sheet_check',
    'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
</div>

<div class="form-group">
    <label>Result</label>
    {!! Form::textarea('work_sheet_result', null, ['class' => 'form-control h-auto', 'id' =>
    'work_sheet_result',
    'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
</div>
@endif

@endsection

@section('action')
<div class="button">
    <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary" id="modal-btn-save">Save changes</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent