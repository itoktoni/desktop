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
                <th class="text-center column-action">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $table)
            <tr>
                <td class="column-checkbox"><input type="checkbox" class="checkbox" name="code[]" value="{{ $table->field_primary }}"></td>
                <td>{{ Views::uiiShort($table->field_primary) }}</td>
                <td>{{ $table->field_reported_at }}</td>
                <td>{{ $table->field_reported_name }}</td>
                @if(env('TICKET_TOPIC'))
                <td>{{ $table->field_topic_name }}</td>
                @endif
                @if(env('TICKET_NAME'))
                <td>{{ $table->field_name }}</td>
                @endif
                @if(env('TICKET_DEPARTMENT'))
                <td>{{ $table->field_department_name }}</td>
                @endif
                <td>{{ $table->field_location_name }}</td>
                <td>{{ $table->field_priority }}</td>

                <td class="col-md-2 text-center column-action">
                    <a class="badge badge-primary" href="{{ route(SharedData::get('route').'.getUpdate', ['code' => $table->field_primary]) }}">
                        {{ __('Update') }}
                    </a>
                    <a class="badge badge-danger button-delete" data="{{ $table->field_primary }}" href="{{ route(SharedData::get('route').'.postDelete', ['code' => $table->field_primary]) }}">
                        {{ __('Delete') }}
                    </a>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>
