<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gymnation - Schedule Class</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-centerClasz justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gymnation</div>
            </a>

            <hr class="sidebar-divider my-0">   

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('schedule_class') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Schedule Class</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('coach') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Coach</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('equipments') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Equipments</span></a>
            </li>

            <li class="nav-item">
                <!-- Authentication -->
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="#" onclick="confirmLogout();" style="cursor: pointer;">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span style="color: #121481">Logout</span>
                    </a>
                </form>
                
                <script>
                    function confirmLogout() {
                        if (confirm("Apakah Anda yakin ingin keluar?")) {
                            document.getElementById('logoutForm').submit();
                        }
                    }
                </script>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <div class="w-full d-sm-flex align-items-center">
                        <h1 class="h3 mb-0 text-gray-800" style="float: inline-start">Schedule Class</h1>
                    </div>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-2 mb-2">
                            <p><a href="{{ route('create_reservation') }}" class="text-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Make Reservation</a></p>
                        </div>
                    </div>

                    <form class="form-inline" method="GET" action="{{ route('classes.search') }}">
                        <input style="width: 80%" class="form-control mr-sm-2" type="search" name="name" placeholder="Search avaliable class" aria-label="Search">
                        <button style="width: 18%" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <div class="table-responsive">
                        <div class="table-wrapper">

                            <!-- Search Results -->
                            @if(request()->has('name'))
                                <p class="text-primary mt-4">Search Result</p>
                                @if($classes->isEmpty())
                                    <p>No classes found.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Coach</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classes as $class)
                                                <tr>
                                                    <td>{{ $class->name }}</td>
                                                    <td>{{ $class->description }}</td>
                                                    <td>{{ $class->start_time }}</td>
                                                    <td>{{ $class->end_time }}</td>
                                                    <td>{{ $class->trainer->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            @endif
                        </div>


                        <div class="d-flex my-4">
                            @foreach ($reservations as $r)
                                <div class="card p-3 bg-white mr-3">
                                    <i class="fa fa-apple"></i>
                                    <div class="about-product text-center mt-2"><img src="../images/meditation.svg" width="100"></div>
                                    <div class="stats mt-2" style="width: 300px">
                                        <div class="d-flex justify-content-between p-price">
                                            <span>Class</span>
                                            <span class="font-weight-bold">{{ \App\Models\Classes::find($r->class_id)->name }}</span>
                                        </div>
                                        {{-- Uncomment and fix this part if needed --}}
                                        {{-- <div class="d-flex justify-content-between p-price">
                                            <span>Coach</span>
                                            <span class="font-weight-bold">{{ $r->class->trainer->name }}</span>
                                        </div> --}}
                                        <div class="d-flex justify-content-between p-price">
                                            <span>Date</span>
                                            <span class="font-weight-bold">{{ $r->reservation_date }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between p-price">
                                            <span>Payment Status</span>
                                            @php
                                                $statusClass = '';
                                                if ($r->payment->status == 'Not Paid') {
                                                    $statusClass = 'text-warning';
                                                } elseif ($r->payment->status == 'Already Paid') {
                                                    $statusClass = 'text-primary';
                                                } elseif ($r->payment->status == 'Verified') {
                                                    $statusClass = 'text-success';
                                                } else {
                                                    $statusClass = 'text-danger';
                                                }
                                            @endphp
                                            <span class="font-weight-bold {{ $statusClass }}">{{ $r->payment->status }}</span>
                                        </div>
                                        
                                        @if ($r->payment->status == 'Not Paid')
                                            <form id="paymentForm-{{ $r->id }}" action="{{ route('update.payment.status', $r->payment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <p id="payNow-{{ $r->id }}" style="font-size: 13px; float: right; margin-top: 30px; cursor: pointer;" class="text-primary">Pay Now ></p>
                                            </form>
                                        @endif
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @foreach ($reservations as $r)
                                    document.getElementById('payNow-{{ $r->id }}').addEventListener('click', function() {
                                        var confirmPayment = confirm('Are you sure you want to confirm the payment?');
                                        if (confirmPayment) {
                                            document.getElementById('paymentForm-{{ $r->id }}').submit();
                                        }
                                    });
                                @endforeach
                            });
                        </script>
                        

                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>
</html>
