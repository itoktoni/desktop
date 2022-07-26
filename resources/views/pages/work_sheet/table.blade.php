@extends(Template::master())

@section('header')
<h4>List Work Sheet</h4>
<div class="header-action">
    <nav>
        <input class="btn-check-m d-lg-none" type="checkbox">
        <button href="{{ route(SharedData::get('route').'.postDelete') }}" class="btn btn-danger button-delete-all">Delete</button>
        <button href="{{ route(SharedData::get('route').'.getCreate') }}" class="btn btn-primary button-create">Create</button>
        <a target="_blank" href="{{ route(SharedData::get('route').'.getPrint', request()->query()) }}" class="btn btn-secondary">Print</a>
        <a target="_blank" href="{{ route(SharedData::get('route').'.getPdf', request()->query()) }}" class="btn btn-google">PDF</a>
        <a href="{{ route(SharedData::get('route').'.getExcel', request()->query()) }}" class="btn btn-success">Excel</a>
        <a href="{{ route(SharedData::get('route').'.getCsv', request()->query()) }}" class="btn btn-info">Csv</a>
    </nav>
</div>
@endsection

@section('form')
<div class="card">
    <div class="card-body">

        {!! Form::open(['url' => route(SharedData::get('route').'.getTable'), 'class' => 'form-row', 'method' => 'GET'])
        !!}

        <div class="form-group col-md-4">
            <select name="filter" class="form-control">
                <option value="">- Search Default Data -</option>
                @foreach($fields as $value)
                <option {{ request()->get('filter') == $value->code ? 'selected' : '' }} value="{{ $value->code }}">
                    {{ __($value->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col">
            <div class="input-group">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Searching Data">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
        @includeIf(Template::form(SharedData::get('template'),'data'))

        @component(Template::components('pagination'), ['data' => $data])
        @endcomponent

    </div>
</div>
@endsection

@component(Template::components('table'))
@endcomponent
