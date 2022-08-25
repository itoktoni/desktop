@extends(Template::ajax())

@section('title') Schedule @endsection

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
      <div class="form-group {{ $errors->has('schedule_name') ? 'has-error' : '' }}">
         <label>Name</label>
         {!! Form::text('schedule_name', null, ['class' => 'form-control', 'id' => 'schedule_name', 'placeholder' => 'Please fill this input', 'required']) !!}
         {!! $errors->first('schedule_name', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group {{ $errors->has('schedule_number') ? 'has-error' : '' }}">
         <label>Number</label>
         {!! Form::text('schedule_number', null, ['class' => 'form-control', 'id' => 'schedule_number', 'placeholder' => 'Please fill this input', 'required']) !!}
         {!! $errors->first('schedule_number', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group {{ $errors->has('schedule_every') ? 'has-error' : '' }}">
         <label>Every</label>
         {!! Form::text('schedule_every', null, ['class' => 'form-control', 'id' => 'schedule_every', 'placeholder' => 'Please fill this input', ]) !!}
         {!! $errors->first('schedule_every', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group {{ $errors->has('schedule_date') ? 'has-error' : '' }}">
         <label>Date</label>
         {!! Form::text('schedule_date', null, ['class' => 'form-control date', 'id' => 'schedule_date', 'placeholder' => 'Please fill this input', 'required']) !!}
         {!! $errors->first('schedule_date', '<p class="help-block">:message</p>') !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group {{ $errors->has('schedule_product_id') ? 'has-error' : '' }}">
            <label>Product ID</label>
            {!! Form::select('schedule_product_id', $product, null, ['class' => 'form-control', 'id' => 'schedule_product_id', 'placeholder' => '- Select Product ID-', 'required']) !!}
            {!! $errors->first('schedule_product_id', '<p class="help-block">:message</p>') !!}
      </div>
      <div class="form-group {{ $errors->has('schedule_notification') ? 'has-error' : '' }}">
            <label>Status</label>
            {!! Form::select('schedule_notification', $status, null, ['class' => 'form-control', 'id' => 'schedule_notification', 'placeholder' => '- Select Status -']) !!}
      </div>
      <div class="form-group {{ $errors->has('schedule_description') ? 'has-error' : '' }}">
            <label>Description</label>
            {!! Form::textarea('schedule_description', null, ['class' => 'form-control h-auto', 'id' => 'schedule_description', 'placeholder' => 'Please fill this input', 'rows' => 5]) !!}
      </div>
    </div>
</div>
@endsection

@section('action')
<div class="button">
    <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@include(Template::components('date'))
