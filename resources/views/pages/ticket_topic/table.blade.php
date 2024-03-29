@extends(Template::master())

@section('title')
<h4>Master Topik</h4>
@endsection

@section('action')
<div class="button">
	<input class="btn-check-m d-lg-none" type="checkbox">
	<a href="{{ route(SharedData::get('route').'.postDelete') }}" class="btn btn-danger button-delete-all">
		{{ __('Delete') }}
	</a>
	<a href="{{ route(SharedData::get('route').'.getCreate') }}" class="btn btn-success button-create">
		{{ __('Create') }}
	</a>
</div>
@endsection

@section('container')

<div class="page-header">
	<div class="header-container container-fluid d-sm-flex justify-content-between">
		@yield('title')
		@yield('action')
	</div>
</div>

<div class="card">
    <div class="card-body">

        {!! Template::form_table() !!}

        <div class="form-group col-md-4">
            <select name="filter" class="form-control">
                <option value="">- {{ __('Search Default Data') }} -</option>
                @foreach($fields as $value)
                <option {{ request()->get('filter') == $value->code ? 'selected' : '' }} value="{{ $value->code }}">
                    {{ __(__($value->name)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col">
            <div class="input-group">
                <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="{{ __('Searching') }} Data">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                </div>
            </div>
        </div>

        {!! Template::form_close() !!}

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
                            @sortablelink($value->code, __($value->name))
                            @else
                            {{ __($value->name) }}
                            @endif
                        </th>
                        @endforeach
                        <th class="text-center column-active">Active</th>
                        <th class="text-center column-action">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $table)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="code[]" value="{{ $table->field_code }}"></td>
                        <td class="">{{ $table->field_primary }}</td>
                        <td class="">{{ $table->field_name }}</td>
                        <td class="text-center">
                            <btn class="badge badge-{{ $table->field_active == BooleanType::Yes ? 'success' : 'warning' }}">
                                {{ BooleanType::getDescription($table->field_active) }}</btn>
                        </td>
                        <td class="col-md-2 text-center column-action">
                            <a class="badge badge-primary button-update" href="{{ route(SharedData::get('route').'.getUpdate', ['code' => $table->field_primary]) }}">
                                Update
                            </a>
                            <a class="badge badge-danger button-delete" data="{{ $table->field_code }}" href="{{ route(SharedData::get('route').'.postDelete', ['code' => $table->field_code]) }}">
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

@push('javascript')
@include(Template::components('table'))
@endpush
