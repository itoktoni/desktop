@extends(Template::master())

@section('header')
<h4>List Master Group</h4>
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

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                        <th class="text-center column-active">Active</th>
                        <th class="text-center column-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $table)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="code[]" value="{{ $table->field_code }}"></td>
                        <td class="">{{ $table->field_code }}</td>
                        <td class="">{{ $table->field_name }}</td>
                        <td class="">{{ $table->field_icon }}</td>
                        <td class="">{{ $table->field_url }}</td>
                        <td class="text-center">
                            <input type="text" class="form-control form-control-sm text-center sort"
                                key="{{ $table->field_code }}" value="{{ $table->field_sort }}">
                        </td>
                        <td class="text-center">
                            <btn
                                class="badge badge-{{ $table->field_active == BooleanType::Yes ? 'success' : 'warning' }}">
                                {{ BooleanType::getDescription($table->field_active) }}</btn>
                        </td>
                        <td class="text-center">
                            <a class="badge badge-primary button-update"
                                href="{{ route(SharedData::get('route').'.getUpdate', ['code' => $table->field_code]) }}">
                                Update
                            </a>
                            <a class="badge badge-danger button-delete" data="{{ $table->field_code }}"
                                href="{{ route(SharedData::get('route').'.postDelete', ['code' => $table->field_code]) }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        @component(Template::components('pagination'), ['data' => $data])
        @endcomponent

    </div>
</div>
@endsection

@component(Template::components('table'))
@endcomponent