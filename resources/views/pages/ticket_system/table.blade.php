@extends(Template::master())

@section('title')
<h4>Tiket System</h4>
@endsection

@section('action')
<div class="button">
	<input class="btn-check-m d-lg-none" type="checkbox">
	<a href="{{ route(SharedData::get('route').'.postDelete') }}" class="btn btn-danger button-delete-all">
		{{ __('Delete') }}
	</a>
	<a href="{{ route(SharedData::get('route').'.getCreate') }}" class="btn btn-success">
		Create
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

        <div class="form-group col-md-2">
            <input type="text" name="date" value="{{ request()->get('date') ?? null }}" class="form-control date" placeholder="{{ __('Choose Date') }}">
        </div>

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
        @includeIf(Template::form(SharedData::get('template'),'data'))

        @component(Template::components('pagination'), ['data' => $data])
        @endcomponent

    </div>
</div>
@endsection

@push('javascript')
@include(Template::components('table'))
@include(Template::components('date'))
@endpush
