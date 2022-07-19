@extends(Template::master())

@section('header')
<h4>List Master Product</h4>
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
            <table class="table table-bordered table-striped table-responsive-stack">
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
                        <th class="text-center column-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $table)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="code[]" value="{{ $table->field_code }}"></td>
                        <td>{{ $table->field_category_name ?? '' }}</td>
                        <td>{{ $table->field_brand_name ?? '' }}</td>
                        <td>{{ $table->field_location_name ?? '' }}</td>
                        <td>{{ $table->field_name }}</td>
                        <td>{{ $table->field_prod_year }}</td>
                        <td>{{ $table->field_buy_date }}</td>
                        <td class="text-center">
                            <btn
                                class="badge badge-{{ $table->field_status == ProductStatus::Good ? 'success' : 'warning' }}">
                                {{ ProductStatus::getDescription($table->field_status) }}</btn>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm" data-toggle="dropdown" aria-haspopup="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item button-update" href="{{ route(SharedData::get('route').'.getUpdate', ['code' => $table->field_code]) }}">Update</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger button-delete" data="{{ $table->field_code }}" href="{{ route(SharedData::get('route').'.postDelete', ['code' => $table->field_code]) }}">Delete</a>
                                </div>
                            </div>
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