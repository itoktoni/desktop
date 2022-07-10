@extends(Template::ajax())

@section('title') Master Tag @endsection

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
        <div class="form-group {{ $errors->has('sparepart_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('sparepart_name', null, ['class' => 'form-control', 'id' => 'sparepart_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('sparepart_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Location ID</label>
            {!! Form::text('sparepart_location_id', null, ['class' => 'form-control', 'id' => 'sparepart_location_id',
            'placeholder' => 'Please fill this input']) !!}
        </div>

        <div class="form-group">
            <label>Stock</label>
            {!! Form::text('sparepart_stock', null, ['class' => 'form-control', 'id' => 'sparepart_stock', 'placeholder'
            => 'Please fill this input']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Description</label>
            {!! Form::textarea('sparepart_description', null, ['class' => 'form-control h-auto', 'id' =>
            'sparepart_description', 'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
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