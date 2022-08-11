@extends(Template::ajax())

@section('title') Transaction Ticket Topic @endsection

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
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('ticket_topic_name') ? 'has-error' : '' }}">
        <label>Name</label>
            {!! Form::text('ticket_topic_name', null, ['class' => 'form-control', 'id' => 'ticket_topic_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('ticket_topic_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group">
            <label>Active</label>
            {{ Form::select('ticket_topic_active', $status, null, ['class'=> 'form-control', 'id' => 'ticket_topic_active']) }}
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
