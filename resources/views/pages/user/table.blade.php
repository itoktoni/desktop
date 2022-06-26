@extends('layouts.app')

@section('content')

{!! Form::open(['url' => 'test/save', 'class' => 'form-horizontal', 'files' => true]) !!}

<!-- begin::page-header -->
<div class="page-header">
    <div class="header-container container-fluid d-sm-flex justify-content-between">
        <h4>Form Create Master</h4>
        <div class="action">
            <nav>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#exampleModal">Cancel</button>
            </nav>
        </div>

    </div>
</div>
<!-- end::page-header -->

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <table class="table table-bordered table-striped table-responsive-stack">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Taste</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $table)
                                <tr>
                                    <td>{{ $table->name }}</td>
                                    <td>{{ $table->email }}</td>
                                    <td>{{ $table->active }}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>

                    <nav class="pagination text-center">
                        
                        {{ $data->onEachSide(1)->links() }}
                        </nav>
                    </div>

                </div>
            </div>


        </div>
    </div>

</div>

{!! Form::close() !!}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
        </button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection