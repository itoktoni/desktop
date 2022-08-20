@extends(Template::ajax())

@section('title') Report Worksheet @endsection

@section('form')

{!! Form::open(['url' => route(SharedData::get('route').'.getPrint'), 'class' => 'form-horizontal needs-validation', 'method' => 'GET']) !!}

@endsection

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
            <label>Start Date</label>
            {!! Form::text('start_date', null, ['class' => 'form-control date', 'id' => 'start_date', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
            <label>End Date</label>
            {!! Form::text('end_date', null, ['class' => 'form-control date', 'id' => 'end_date', 'placeholder'
            => 'Please fill this input', 'required']) !!}
            {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('ticket_system_topic_id') ? 'has-error' : '' }}">
            <label>Work Type</label>
            {!! Form::select('work_sheet_type_id', $work_type, null, ['class' => 'form-control', 'id' =>
            'work_sheet_type_id', 'placeholder' => '- Select Status -']) !!}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('ticket_system_department_id') ? 'has-error' : '' }}">
            <label>Product</label>
            {!! Form::select('work_sheet_producy_id', $product, null, ['class' => 'form-control', 'id' =>
            'work_sheet_product_id', 'placeholder' => '- Select Status -']) !!}
        </div>
    </div>

</div>

@endsection

@section('action')
<div class="button">
    <button type="submit" class="btn btn-primary" id="modal-btn-save">Generate Report</button>
</div>
@endsection

@section('javascript')
@include(Template::components('form'))
@endsection

@component(Template::components('date'))
@endcomponent