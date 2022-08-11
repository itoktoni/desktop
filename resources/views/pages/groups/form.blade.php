@extends(Template::ajax())

@section('title') Master Groups @endsection

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
        <div class="form-group {{ $errors->has('group_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('group_name', null, ['class' => 'form-control', 'id' => 'group_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('group_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Active</label>
            {{ Form::select('group_active', $status, null, ['class'=> 'form-control', 'id' => 'group_active']) }}
        </div>
        <div class="form-group">
            <label>Icon</label>
            {!! Form::text('group_icon', null, ['class' => 'form-control', 'id' => 'group_icon',
                'placeholder' => 'Please fill this input']) !!}
                <span class="help-block">To add more icon please <a target="_blank" href="https://feathericons.com">https://feathericons.com</a></span>
        </div>
    </div>

    <div class="col-md-6">
     <div class="form-group">
            <label>Group Code</label>
            {!! Form::text('group_code', null, ['class' => 'form-control', 'id' => 'group_code', 'readonly',
            'placeholder' => 'Please fill this input']) !!}
        </div>

        <div class="form-group {{ $errors->has('group_icon') ? 'has-error' : '' }}">
            <label>Link to Url</label>
            {!! Form::text('group_url', null, ['class' => 'form-control', 'id' => 'group_url', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('group_url', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Sort</label>
            {!! Form::number('group_sort', null, ['class' => 'form-control', 'id' => 'group_sort',
            'placeholder' => 'Please fill this input']) !!}
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