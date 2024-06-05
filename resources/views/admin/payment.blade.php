<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gymnation - Payments</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gymnation</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">   

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>User</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.coach') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Coach</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.classes') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Classes</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.payment') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Payments</span></a>
            </li>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <!-- Page Heading -->
                    <div class="w-full d-sm-flex align-items-center">
                        <h1 class="h3 mb-0 text-gray-800" style="float: inline-start">Payments (Pembayaran)</h1>
                    </div>
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::check())
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @endif
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div id="reservations-container" class="d-flex my-4">
                        @if ($reservations->isEmpty())
                            <p style="font-size: 12px" class="text-warning">[!] No data available</p>
                        @else
                            @foreach ($reservations as $r)
                                <div class="card p-3 bg-white mr-3">
                                    <i class="fa fa-apple"></i>
                                    <div class="about-product text-center mt-2"><img src="../images/meditation.svg" width="100"></div>
                                    <div class="stats mt-2" style="width: 300px">
                                        <div class="d-flex justify-content-between p-price">
                                            <span>User</span>
                                            <span class="font-weight-bold">{{ $r->user->name }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between p-price">
                                            <span>Class</span>
                                            <span class="font-weight-bold">{{ \App\Models\Classes::find($r->class_id)->name }}</span>
                                        </div>
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
                                            <form class="payment-form" action="{{ route('update.payment_admin.status', $r->payment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <p class="pay-now" style="font-size: 13px; float: right; margin-top: 30px; cursor: pointer; color: #3572EF">Verify Now ></p>
                                            </form>
                                        @elseif ($r->payment->status == 'Already Paid')
                                            <form class="payment-form" action="{{ route('update.payment_admin.status', $r->payment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <p class="pay-now" style="font-size: 13px; float: right; margin-top: 30px; cursor: pointer; color: #3572EF">Verify Now ></p>
                                            </form>
                                        @else
                                            <form class="reservation-form" action="{{ route('delete.reservation', $r->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p class="delete-now" style="font-size: 13px; float: right; margin-top: 30px; cursor: pointer; color: #FF0000">Delete ></p>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif        
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('reservations-container').addEventListener('click', function(event) {
                                if (event.target.classList.contains('pay-now')) {
                                    var confirmPayment = confirm('Are you sure you want to verify this payment?');
                                    if (confirmPayment) {
                                        event.target.closest('.payment-form').submit();
                                    }
                                }
                    
                                if (event.target.classList.contains('delete-now')) {
                                    var confirmDelete = confirm('Are you sure you want to delete this reservation?');
                                    if (confirmDelete) {
                                        event.target.closest('.reservation-form').submit();
                                    }
                                }
                            });
                        });
                    </script>
                    
                    
                </div>
                        

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>