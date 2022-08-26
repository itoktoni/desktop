@extends(Template::ajax())

@section('title') Transaction Spk @endsection

@section('form')

@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' =>
$model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true, 'novalidate']) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation',
'files' => true, 'novalidate']) !!}
@endif

@endsection

@section('container')

<div class="row">

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('spk_vendor_id') ? 'has-error' : '' }}">
            <label>Vendor ID</label>
            {!! Form::text('spk_vendor_id', null, ['class' => 'form-control', 'id' => 'spk_vendor_id',
            'placeholder' => 'Please fill this input', 'required']) !!}
            {!! $errors->first('spk_vendor_id', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('spk_product_id') ? 'has-error' : '' }}">
            <label>Product</label>
            {!! Form::select('spk_product_id', $product, null, ['class' => 'form-control selectize', 'id' =>
            'spk_product_id', 'placeholder' => '- Select Product -', 'required']) !!}
        </div>

        <div class="form-group {{ $errors->has('spk_date') ? 'has-error' : '' }}">
            <label>Date</label>
            {!! Form::text('spk_date', null, ['class' => 'form-control date', 'id' => 'spk_date', 'placeholder' => 'Please fill this input', 'required']) !!}
            {!! $errors->first('spk_date', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('spk_work_sheet_code') ? 'has-error' : '' }}">
                    <label>WorkSheet Code</label>
                    {!! Form::select('spk_work_sheet_code', $work_sheet, null, ['class' => 'form-control', 'id' =>
                    'spk_work_sheet_code', 'placeholder' => '- Select work sheet -', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('spk_status') ? 'has-error' : '' }}">
                    <label>Status</label>
                    {!! Form::select('spk_status', $status, null, ['class' => 'form-control', 'id' =>
                    'spk_status', 'placeholder' => '- Select Status -']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group {{ $errors->has('spk_code') ? 'has-error' : '' }}">
            <label>Code</label>
            {!! Form::text('spk_code', null, ['class' => 'form-control', 'id' => 'spk_code',
            'placeholder' => 'Please fill this input', 'required']) !!}
            {!! $errors->first('spk_code', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('spk_description') ? 'has-error' : '' }}">
            <label>Description</label>
            {!! Form::textarea('spk_description', null, ['class' => 'form-control h-auto', 'id' =>
            'spk_description',
            'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
        </div>

    </div>
</div>

@if(isset($model))
<hr>
<div class="form-group">
    <label>Check</label>
    {!! Form::textarea('spk_check', null, ['class' => 'form-control h-auto', 'id' =>
    'spk_check',
    'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
</div>

<div class="form-group">
    <label>Result</label>
    {!! Form::textarea('spk_result', null, ['class' => 'form-control h-auto', 'id' =>
    'spk_result',
    'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
</div>
@endif

@endsection

@section('action')
<div class="button">
    <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
    @if(isset($model))
    <a target="_blank" href="{{ route(SharedData::get('route').'.getPdf', ['code' => $model->field_primary]) }}"
        class="btn btn-danger">Print PDF</a>
    @endif
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent