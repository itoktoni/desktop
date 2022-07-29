@extends(Template::ajax())

@section('title') Master Product @endsection

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

        <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('product_name', null, ['class' => 'form-control', 'id' => 'product_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('product_buy_date') ? 'has-error' : '' }}">
            <label>Buy Date</label>
            {!! Form::text('product_buy_date', null, ['class' => 'form-control date', 'id' => 'product_buy_date', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('product_buy_date', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('product_prod_year') ? 'has-error' : '' }}">
            <label>Production Year</label>
            {!! Form::text('product_prod_year', null, ['class' => 'form-control', 'id' => 'product_prod_year', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('product_prod_year', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('product_description', null, ['class' => 'form-control h-auto', 'id' =>
            'product_description',
            'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Category</label>
            {!! Form::select('product_category_id', $category, null, ['class' => 'form-control', 'id' =>
            'product_name', 'placeholder' => '- Select Category -', 'required']) !!}
        </div>

        <div class="form-group">
            <label>Brand</label>
            {!! Form::select('product_brand_id', $brand, null, ['class' => 'form-control', 'id' =>
            'product_name', 'placeholder' => '- Select brand -', 'required']) !!}
        </div>

        <div class="form-group">
            <label>Unit</label>
            {!! Form::select('product_unit_code', $unit, null, ['class' => 'form-control', 'id' =>
            'product_name', 'placeholder' => '- Select Unit -', 'required']) !!}
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