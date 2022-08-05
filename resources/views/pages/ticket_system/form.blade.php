@extends(Template::ajax())

@section('title') Transaction Ticket System @endsection

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
            <label>Subject</label>
            {!! Form::text('ticket_system_name', null, ['class' => 'form-control', 'id' => 'ticket_system_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('ticket_system_name', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('work_sheet_product_id') ? 'has-error' : '' }}">
            <label>Department</label>
            {!! Form::select('ticket_system_department_id', $department, null, ['class' => 'form-control', 'id' =>
            'ticket_system_department_id', 'placeholder' => '- Select Product -', 'required']) !!}
        </div>

        <div class="form-group {{ $errors->has('work_sheet_reported_at') ? 'has-error' : '' }}">
            <label>Report Date</label>
            {!! Form::text('ticket_system_reported_at', null, ['class' => 'form-control date', 'id' => 'ticket_system_reported_at', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('ticket_system_reported_at', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('ticket_system_topic_id') ? 'has-error' : '' }}">
                    <label>Topic</label>
                    {!! Form::select('ticket_system_topic_id', $ticket_topic, null, ['class' => 'form-control', 'id' =>
                    'ticket_system_topic_id', 'placeholder' => '- Select work Type -', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('ticket_system_status') ? 'has-error' : '' }}">
                    <label>Status</label>
                    {!! Form::select('ticket_system_status', $status, null, ['class' => 'form-control', 'id' =>
                    'ticket_system_status', 'placeholder' => '- Select Status -']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('ticket_system_priority') ? 'has-error' : '' }}">
                    <label>Priority</label>
                    {!! Form::select('ticket_system_priority', $priority, null, ['class' => 'form-control', 'id' =>
                    'ticket_system_priority', 'placeholder' => '- Select Status -']) !!}
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">
            <label>Reported By</label>
            {!! Form::select('ticket_system_reported_by', $user, null, ['class' => 'form-control', 'placeholder' => '-
            Select User -']) !!}
        </div>

        <div class="form-group {{ $errors->has('ticket_system_description') ? 'has-error' : '' }}">
            <label>Description</label>
            {!! Form::textarea('ticket_system_description', null, ['class' => 'form-control h-auto', 'id' =>
            'ticket_system_description',
            'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
        </div>

    </div>
</div>

@endsection

@section('action')
<div class="button">
    <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary" id="modal-btn-save">Save changes</button>
    @if(isset($model))
    <a target="_blank" href="{{ route(SharedData::get('route').'.getPdf', ['code' => $model->field_primary]) }}" class="btn btn-danger">Print PDF</a>
    @endif
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent