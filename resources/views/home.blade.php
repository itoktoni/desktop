@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="container-fluid d-sm-flex justify-content-between">
            <h4>Helpdesk Management</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Helpdesk Management</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-body">
                            <h3 class="mb-3">
                                321
                                <small>New Tickets</small>
                            </h3>
                            <div class="progress mb-2" style="height: 5px">
                                <div class="progress-bar bg-primary" role="progressbar"
                                     style="width: 100%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="font-size-11 m-b-0">
                                <span class="text-success">+ 1.2%</span> than yesterday
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <h3 class="mb-3">
                                70
                                <small>Solved Tickets</small>
                            </h3>
                            <div class="progress mb-2" style="height: 5px">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: 10%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="font-size-11 m-b-0">
                                <span class="text-danger">- 2.2%</span> than yesterday
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-body">
                            <h4 class="mb-3">
                                125
                                <small>Pending Tickets</small>
                            </h4>
                            <div class="progress mb-2" style="height: 5px">
                                <div class="progress-bar bg-info" role="progressbar"
                                     style="width: 55%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="font-size-11 m-b-0">
                                <span class="text-success">+ 4.2%</span> than yesterday
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-title">Ticket Status</h6>
                                    <div class="dropdown">
                                        <a class="btn btn-outline-light btn-sm dropdown-toggle" href="#" data-toggle="dropdown">2019</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item">2018</a>
                                            <a href="#" class="dropdown-item">2017</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item text-uppercase font-size-11">
                                            <i class="fa fa-circle text-primary mr-1"></i> New Tickets
                                        </li>
                                        <li class="list-inline-item text-uppercase font-size-11">
                                            <i class="fa fa-circle text-success mr-1"></i> Solved Tickets
                                        </li>
                                        <li class="list-inline-item text-uppercase font-size-11">
                                            <i class="fa fa-circle text-info mr-1"></i> Pending Tickets
                                        </li>
                                    </ul>
                                </div>
                                <canvas id="chart-ticket-status"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="">Customer Satisfaction</h6>
                                <h1>
                                    9.8
                                    <small class="text-success">2.1%</small>
                                </h1>
                                <div class="progress" style="height: 10px">
                                    <div class="progress-bar" role="progressbar" style="width: 15%"
                                         aria-valuenow="15"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 30%"
                                         aria-valuenow="30"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
                                         aria-valuenow="20"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="list-group list-group-flush m-t-10">
                                    <div class="list-group-item p-t-b-10 p-l-r-0 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle m-r-10 text-primary"></i>
                                            <span>Excellent</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-20">3,230</div>
                                            <div>58%</div>
                                        </div>
                                    </div>

                                    <div class="list-group-item p-t-b-10 p-l-r-0 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle m-r-10 text-warning"></i>
                                            <span>Good</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-20">3,230</div>
                                            <div>58%</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item p-t-b-10 p-l-r-0 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle m-r-10 text-info"></i>
                                            <span>Fair</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-20">3,230</div>
                                            <div>58%</div>
                                        </div>
                                    </div>
                                    <div class="list-group-item p-t-b-10 p-l-r-0 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-circle m-r-10 text-success"></i>
                                            <span>Poor</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="m-r-20">3,230</div>
                                            <div>58%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
