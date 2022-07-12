@extends(Template::ajax())

@section('title') Master Tag @endsection

@section('form')

@if(isset($model))
{!! Form::model($model, ['route'=>[SharedData::get('route').'.postUpdate', 'code' => $model->{$model->getKeyName()}],'class'=>'form-horizontal needs-validation' , 'files'=>true]) !!}
@else
{!! Form::open(['url' => route(SharedData::get('route').'.postCreate'), 'class' => 'form-horizontal needs-validation', 'files' => true]) !!}
@endif

@endsection

@section('container')

<div class="row">
   <div class="col-md-6">
        <div class="form-group  {{ $errors->has('tag_code') ? 'has-error' : '' }}">
            <label>Tag Name</label>
            {!! Form::text('tag_code', null, ['class' => 'form-control', 'id' => 'tag_code', 'readonly' ]) !!}
            {!! $errors->first('tag_code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group  {{ $errors->has('tag_name') ? 'has-error' : '' }}">
            <label>Tag Name</label>
            {!! Form::text('tag_name', null, ['class' => 'form-control', 'id' => 'tag_name', 'placeholder' => 'Please fill this input' , 'onkeyup' => 'FuctionTagCode()' ,'required']) !!}
            {!! $errors->first('tag_name', '<p class="help-block">:message</p>') !!}
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

<script>
   function FuctionTagCode() {
  var tag_name = document.getElementById("tag_name");
  var tag_code = document.getElementById("tag_code");
  tag_code.value = tag_name.value.toUpperCase().replaceAll(" ", "_");
  //   console.log(tag_code.value);
}
</script>
@endsection
