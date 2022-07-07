@extends(Template::master())

@section('header')
<h4>List Master Ruangan</h4>
<div class="header-action">
    <nav>
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
            {!! Form::open(['url' => 'test/save', 'class' => 'form-horizontal', 'files' => true]) !!}
            <table class="table table-bordered table-striped table-responsive-stack">

                <thead>
                    <tr>
                        @foreach($fields as $value)
                        <th>
                            @if($value->sort)
                            @sortablelink($value->code, $value->name)
                            @else
                            {{ $value->name }}
                            @endif
                        </th>
                        @endforeach
                        <th class="col-md-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $table)
                    <tr>
                        <td>{{ $table->field_name }}</td>
                        <td>{{ $table->field_description }}</td>
                        <td class="col-md-2 text-center">
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
            {!! Form::close() !!}
        </div>

        <nav class="container-pagination">
            {!! $data->appends(\Request::except('page'))->render() !!}
        </nav>

    </div>
</div>
@endsection

@section('script')

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showModal(url) {

    $.ajax({
        url: url,
        beforeSend: function() {
            $('#loader').show();
        },
        // return the result
        success: function(response) {
            $('#modal-body').html(response);
            $('#modal').modal({
                backdrop: 'static',
                keyboard: false
            });
        },
        complete: function() {
            $('#loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    });


}

$('body').on('click', '.button-update', function(event) {
    event.preventDefault();
    showModal($(this).attr('href'));
});

$('body').on('click', '.button-create', function(event) {
    event.preventDefault();
    showModal($(this).attr('href'));
});

$('body').on('click', '.button-delete', function(event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        id = me.attr('data'),
        csrf_token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: 'Are you sure want to delete this data ?',
        text: 'You won\'t be able to revert this!',
        icon: "warning",
        buttons: true,
    }).then((result) => {
        if (result) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: 'json',
                data: {
                    'id': id
                },
                success: function(response) {
                    if (response.status) {
                        swal({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Data has been deleted!',
                            timer: 3000
                        }).then(function() {
                            window.location.reload();
                        });

                    } else if (response.status == false) {
                        swal({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Data failed to deleted!'
                        });
                    }
                },
                error: function(xhr, status, error) {

                    if (xhr.status == 422) {

                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Validation Error !'
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                }
            });
        } else {

        }
    });
});
</script>

@endsection