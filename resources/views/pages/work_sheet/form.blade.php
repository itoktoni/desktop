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
         <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('work_sheet_description', null, ['class' => 'form-control h-auto', 'id' =>
            'work_sheet_description',
            'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
         </div>

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
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('work_sheet_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('work_sheet_name', null, ['class' => 'form-control', 'id' => 'work_sheet_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('work_sheet_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Product ID</label>
            {!! Form::select('work_sheet_product_id', $product, null, ['class' => 'form-control', 'id' =>
            'work_sheet_product_id', 'placeholder' => '- Select Product ID-', 'required']) !!}
        </div>

        <div class="form-group">
            <label>Type ID</label>
            {!! Form::select('work_sheet_type_id', $work_type, null, ['class' => 'form-control', 'id' =>
            'work_sheet_type_id', 'placeholder' => '- Select work Type ID -', 'required']) !!}
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
