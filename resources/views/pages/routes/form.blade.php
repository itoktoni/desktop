@extends(Template::master())

@section('title')
<h4>Master Menu</h4>
@endsection

@section('action')
<div class="button">
	<button type="submit" class="btn btn-primary" id="modal-btn-save">{{ __('Save') }}</button>
</div>
@endsection

@section('container')

{!! Template::form_open($model) !!}

@if(!request()->ajax())
<div class="page-header">
	<div class="header-container container-fluid d-sm-flex justify-content-between">
		@yield('title')
		@yield('action')
	</div>
</div>
@endif

<div class="card">
	<div class="card-body">

		<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('route_group') ? 'has-error' : '' }}">
					<label>Group</label>
					{!! Form::select('route_group', $data_groups, null, ['class' => 'form-control', 'id' =>
					'product_name', 'placeholder' => '- Select Group -', 'required']) !!}
					{!! $errors->first('route_group', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group {{ $errors->has('route_code') ? 'has-error' : '' }}">
					<label>Code</label>
					{!! Form::text('route_code', null, ['class' => 'form-control', 'id' => 'route_code', 'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('route_code', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group {{ $errors->has('route_name') ? 'has-error' : '' }}">
					<label>{{ __('Name') }}</label>
					{!! Form::text('route_name', null, ['class' => 'form-control', 'id' => 'route_name', 'placeholder'
					=> 'Please fill this input', 'required']) !!}
					{!! $errors->first('route_name', '<p class="help-block">:message</p>') !!}
				</div>

				<div class="form-group">
					<label>Controller</label>
					{!! Form::text('route_controller', null, ['class' => 'form-control', 'id' => 'route_controller',
					'placeholder'
					=> 'Please fill this input', 'required']) !!}
				</div>

			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Active</label>
					{{ Form::select('route_active', $status, null, ['class'=> 'form-control', 'id' => 'route_active']) }}
				</div>

				<div class="form-group">
					<label>{{ __('Description') }}</label>
					{!! Form::textarea('route_description', null, ['class' => 'form-control h-auto', 'id' => 'email',
					'placeholder' => 'Please fill this input', 'rows' => 9]) !!}
				</div>
			</div>
        </div>

		@if($model)

		<hr>

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive" id="table_data">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Code</th>
								<th>Function Name</th>
								<th class="column-action">Reset Name</th>
								<th class="column-action">Show</th>
								<th class="column-action">Active</th>
							</tr>
						</thead>
						<tbody>
							@forelse(old('detail') ?? $method as $table)
							@php
							$temp_data = "detail[$loop->index]";
							$temp_id = $temp_data.'[temp_id]';
							$temp_module = $temp_data.'[temp_module]';
							$temp_name = $temp_data.'[temp_name]';
							$temp_show = $temp_data.'[temp_show]';
							$temp_reset = $temp_data.'[temp_reset]';
							$temp_active = $temp_data.'[temp_active]';
							@endphp
							<tr>
								<td class="text-center">
									<input type="text" name="{{ $temp_id }}" class="form-control form-control-sm"
										readonly value="{{ old('temp_id') ?? $table[$menu->field_primary()] }}">
								</td>
								<td class="text-center">
									<input type="hidden" value="{{ old('temp_module') ?? $model->field_primary }}"
										name="{{ $temp_module }}">
									<input type="text" name="{{ $temp_name }}" class="form-control form-control-sm"
										value="{{ old('temp_name') ?? $table[$menu->field_name()] }}">
								</td>
								<td>
									{{ Form::select($temp_reset, ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control', 'id' => 'route_active']) }}
								</td>
								<td>
									{{ Form::select($temp_show, ['0' => 'No', '1' => 'Yes'], null, ['class'=> 'form-control', 'id' => 'route_active']) }}
								</td>
								<td>
									{{ Form::select($temp_active, ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control', 'id' => 'route_active']) }}
								</td>
							</tr>
							@empty
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
        </div>

        @endif

	</div>
</div>

{!! Template::form_close() !!}

@endsection

@push('javascript')
@include(Template::components('form'))
@endpush