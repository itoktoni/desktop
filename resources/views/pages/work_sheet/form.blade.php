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
            <label>Ticket</label>
            {!! Form::select('work_sheet_ticket_code', $ticket, request()->get('ticket_id') ?? null, ['placeholder' =>
            '- Select Ticket -', 'class' => 'form-control ticket', ]) !!}
        </div>

        <div class="form-group {{ $errors->has('work_sheet_product_id') ? 'has-error' : '' }}">
            <label>Product</label>
            {!! Form::select('work_sheet_product_id', $product, null, ['class' => 'form-control selectize', 'id' =>
            'work_sheet_product_id', 'placeholder' => '- Select Product -', 'required']) !!}
        </div>

        <div class="form-group {{ $errors->has('work_sheet_reported_at') ? 'has-error' : '' }}">
            <label>Report Date</label>
            {!! Form::text('work_sheet_reported_at', null, ['placeholder' => 'Please fill this input', 'class' =>
            'form-control date', 'id' =>
            'work_sheet_reported_at', 'required']) !!}
            {!! $errors->first('work_sheet_reported_at', '<p class="help-block">:message</p>') !!}
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

        <div class="form-group {{ $errors->has('work_sheet_name') ? 'has-error' : '' }}">
            <label>Name</label>
            {!! Form::text('work_sheet_name', $data_ticket ? 'Follow up : '.$data_ticket->field_name : null, ['class' =>
            'form-control', 'id' => 'work_sheet_name', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('work_sheet_name', '<p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group">
            <label>Reported By</label>
            {!! Form::select('work_sheet_reported_by', $user, $data_ticket->field_reported_By ?? null, ['placeholder' =>
            '- Select User -', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group {{ $errors->has('work_sheet_description') ? 'has-error' : '' }}">
            <label>Description</label>
            {!! Form::textarea('work_sheet_description', null, ['class' => 'form-control h-auto', 'id' =>
            'work_sheet_description',
            'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
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
    <button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent

@push('footer')
<script>
$('.ticket').change(function() {
    var id = $(".ticket option:selected").val();
    var uri = window.location.toString();
    var clean_uri = window.location.toString();
    if (uri.indexOf("?") > 0) {
        clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
    window.location = clean_uri + '?ticket_id=' + id;
});
</script>
@endpush