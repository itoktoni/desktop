@extends(Template::master())

@section('header')
<h4>List Master Filter</h4>
<div class="header-action">
    <nav>
        <input class="btn-check-m d-lg-none" type="checkbox">
        <button href="{{ route(SharedData::get('route').'.postDelete') }}"
            class="btn btn-danger button-delete-all">Delete</button>
        <button href="{{ route(SharedData::get('route').'.getCreate') }}"
            class="btn btn-success button-create">Create</button>
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
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control"
                    placeholder="Searching Data">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

        <div class="table-responsive" id="table_data">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="column-checkbox">
                            <input class="btn-check-d" type="checkbox">
                        </th>
                        @foreach($fields as $value)
                        <th {{ Template::extractColumn($value) }}>
                            @if($value->sort)
                            @sortablelink($value->code, $value->name)
                            @else
                            {{ $value->name }}
                            @endif
                        </th>
                        @endforeach
                        <th class="text-center column-active">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $table)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="code[]" value="{{ $table->field_code }}"></td>
                        <td>{{ $table->field_name }}</td>
                        <td>{{ $table->field_table }}</td>
                        <td>{{ $table->field_field }}</td>
                        <td>{{ $table->field_function }}</td>
                        <td>{{ $table->field_operator }}</td>
                        <td>{{ $table->field_value }}</td>
                        <td class="text-center">
                            <a class="badge badge-primary button-update"
                                href="{{ route(SharedData::get('route').'.getUpdate', ['code' => $table->field_code]) }}">
                                Update
                            </a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <nav class="container-pagination">
            {!! $data->appends(\Request::except('page'))->render() !!}
        </nav>

    </div>
</div>
@endsection

@component(Template::javascript('table'))
@endcomponent