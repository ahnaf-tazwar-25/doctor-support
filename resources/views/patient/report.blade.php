<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/icon3.png" rel="icon">
    <title>Medical Report</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/adminindex.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        /* Upload Image  */

        #upload {
            opacity: 0;
        }

        #upload-label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
        }

        .image-area {
            border: 2px dashed rgba(248, 248, 248, 0.993);
            padding: 1rem;
            position: relative;
        }

        .image-area::before {
            content: 'Uploaded image result';
            color: rgb(167, 177, 238);
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            z-index: 1;
        }

        .image-area img {
            z-index: 2;
            position: relative;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('patientindex') }}">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/icon3.png">
                </div>
                <div class="sidebar-brand-text mx-3">Patient</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('patientindex') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('patientDocList') }}">
                    <i class="fas fa-stethoscope"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('appointment') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointment</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                My Profile
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('report') }}">
                    <i class="fas fa-file"></i>
                    <span>Medical Report</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('appointHistory') }}">
                    <i class="fas fa-file-medical-alt"></i>
                    <span>Appointment History</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('presHistory') }}">
                    <i class="fas fa-file-prescription"></i>
                    <span>Prescription History</span>
                </a>
            </li>

            <hr class="sidebar-divider">

        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="/userImage/patient.png" style="max-width: 60px">
                                <span
                                    class="ml-2 d-none d-lg-inline text-white small">{{ session('LoggedUser')->fullName }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Medical Reports </h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('patientindex') }}">Home</a></li>
                            <li class="breadcrumb-item">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Reports List</li>
                        </ol>
                    </div>


                    <br>
                    <!-- Row -->
                    <div class="row">
                        <!-- Reports -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Reports List</h6>
                                </div>



                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Report ID</th>
                                                <th>Appointment ID</th>
                                                <th>Report Deliery Date</th>
                                                <th>Test Name</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->appointmentID }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->department }}</td>
                                                    <td>
                                                        @if ($item->status == 'active')
                                                            <form action="{{ route('downLoadReport') }}" method="POST">
                                                                @csrf
                                                                <input type="text" name="fileName"
                                                                    value="{{ $item->id }}" hidden>
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Download</button>
                                                            </form>
                                                        @else
                                                            <label class="px-2 text-white bg-secondary">Unavailable</label>
                                                        @endif
            
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Warning!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Cancel</button>
                                    <a href="{{ route('signout') }}" class="btn btn-primary"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy; Copyright <strong><span>Doctors' Support</span></strong>. All Rights Reserved
                    </div>
                    <div class="credits">
                        Designed by <a href="https://limmexbd.com/" target="_blank">Limmex Automation</a>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable 
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover
        });
    </script>

</body>

</html>
