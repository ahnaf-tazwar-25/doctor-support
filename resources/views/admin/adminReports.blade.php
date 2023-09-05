<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/icon3.png" rel="icon">
    <title>Admin - Reports</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/adminindex.css" rel="stylesheet">
    <link href="assets/css/poptext.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>



<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('adminindex') }}">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/icon3.png">
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminindex') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Users
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('createUserUI') }}">
                    <i class="fas fa-wheelchair fa-2x text-success"></i>
                    <span>Create Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('loadAppointments') }}">
                    <i class="fas fa-wheelchair fa-2x text-success"></i>
                    <span>Appointments</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminPatList') }}">
                    <i class="fas fa-wheelchair fa-2x text-success"></i>
                    <span>Patients</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminDocList') }}">
                    <i class="fas fa-stethoscope fa-2x text-primary"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Reports and Others
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminProfile') }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('reports') }}">
                    <i class="fas fa-user"></i>
                    <span>Reports</span>
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
                                <img class="img-profile rounded-circle" src="assets/img/icon3.png"
                                    style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    {{ session('LoggedUser')->title . ' ' . session('LoggedUser')->fullName }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('adminProfile') }}">
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

                    {{-- <button href="{{ route('uploadReport_1')}}" class="btn btn-primary btn-sm">Upload</button> --}}

                    @if ($upload_1 == false)
                        <a style="color: white;" href="{{ route('uploadReport_1') }}"
                            class="pLoader abc btn btn-lg btn-primary btn-lg btn-block mb-3">Upload</a>
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
                                                    <th>Testing Date</th>
                                                    <th>Test Name</th>
                                                    <th>Department</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($reports) > 0)
                                                    @foreach ($reports as $item)
                                                        <tr>
                                                            <td>{{ $item->id }}</td>
                                                            <td>{{ $item->appointmentID }}</td>
                                                            <td>{{ $item->date }}</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->department }}</td>
                                                            <td>
                                                                @if ($item->status == 'active')
                                                                    <form action="{{ route('downLoadReport') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="text" name="fileName"
                                                                            value="{{ $item->id }}" hidden>
                                                                        <button type="submit"
                                                                            class="btn btn-primary btn-sm">Download</button>
                                                                    </form>
                                                                @else
                                                                    <label
                                                                        class="px-2 text-white bg-secondary">Unavailable</label>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>No report available</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($upload_1 == true)
                        <a style="color: white" href="{{ route('reports') }}"
                            class="pLoader abc btn btn-sm btn-primary px-4 mb-3">back</a>
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <th>Appointment ID</th>
                                <th>Date of Appointment</th>
                                <th>Patient's Name</th>
                                <th>Patient's Contact No.</th>
                                <th>Department</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->appointDate }}</td>
                                        <td>{{ $item->nameOfAppointer }}</td>
                                        <td>{{ $item->contactOfAppointer }}</td>
                                        <td>{{ $item->appointDepartment }}</td>
                                        <td>
                                            <form action="{{ route('uploadReport_2') }}" method="POST">
                                                @csrf
                                                <input type="text" name="id" value="{{ $item->id }}"
                                                    hidden>
                                                <input type="text" name="email"
                                                    value="{{ $item->emailOfAppointer }}" hidden>

                                                <input type="text" name="department"
                                                    value="{{ $item->appointDepartment }}" hidden>

                                                <input type="text" name="docNID"
                                                    value="{{ $item->appointDoctor }}" hidden>

                                                <button type="submit" class="btn btn-primary btn-sm">Select</button>
                                            </form>
                                            {{-- @if ($item->status == 'Accept')
                                                <form action="{{ route('uploadReport_2') }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                        hidden>
                                                    <input type="text" name="email"
                                                        value="{{ $item->emailOfAppointer }}" hidden>

                                                    <input type="text" name="department"
                                                        value="{{ $item->appointDepartment }}" hidden>

                                                    <input type="text" name="docNID"
                                                        value="{{ $item->appointDoctor }}" hidden>

                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">Select</button>
                                                </form>
                                            @else
                                                <form action="{{ route('uploadReport_2') }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $item->id }}"
                                                        hidden>
                                                    <input type="text" name="email"
                                                        value="{{ $item->emailOfAppointer }}" hidden>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">Select</button>
                                                </form>
                                            @endif --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($upload_2 == true)
                            <form action="{{ route('uploadReport_3') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div style="border: dotted skyblue; margin-top: 10rem" class="container w-50">
                                    <div>
                                        <h3 class="form-label text-center" for="customFile">Upload patient report</h3>
                                        <br>
                                        <label for="aptId"> <strong>Appointment ID:</strong>
                                            {{ $id }}</label>
                                        <br>
                                        <label for="aptId"> <strong>Patient Email:</strong>
                                            {{ $email }}</label>

                                        <input type="text" class="form-control" placeholder="Name of Report *"
                                            name="name" required>

                                        <input type="text" name="id" value="{{ $id }}" hidden>
                                        <input type="text" name="email" value="{{ $email }}" hidden>
                                        <input type="text" name="report" value="{{ $report }}" hidden>

                                        <br>
                                        <label for="date">Date of delivery:</label>
                                        <input type="date" name="date" class="form-control datepicker"
                                            id="date" placeholder="Date of delivery" required>
                                        <script language="javascript">
                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            today = yyyy + '-' + mm + '-' + dd;
                                            $('#date').attr('min', today);

                                            var maxDate = new Date();
                                            var max_dd = String(maxDate.getDate()).padStart(2, '0');
                                            var max_mm = String(maxDate.getMonth() + 2).padStart(2, '0');
                                            var max_yyyy = maxDate.getFullYear();
                                            maxDate = max_yyyy + '-' + max_mm + '-' + max_dd;
                                            $('#date').attr('max', maxDate);
                                        </script>
                                        <br>
                                        <input type="file" name="reportFile" class="form-control" id="customFile"
                                            accept=".pdf" required />
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                    <br>
                                    <br>
                                </div>
                            </form>
                        @endif
                    @endif






                    <br>
                    <!-- Row -->


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


        </div>
    </div>
    <br>

    </div>

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="me-md-auto text-center">
            <div class=" copyright">
                &copy; Copyright <strong><span>Doctors' Support</span></strong>. All Rights Reserved
            </div>
            <div class="credits text-center">
                Designed by <a href="https://limmexbd.com/" target="_blank" class="text-decoration-none">Limmex
                    Automation</a>
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

    <script>
        $(document).ready(function() {
            $("#abc").click(function() {
                $("#prescription").fadeIn();
                $("#patients").fadeOut();
            });
        });

        // $(document).ready(function() {
        //     $("#abc").click(function() {
        //         $("#test").fadeOut("slow");
        //     });
        // });

        // When the user clicks on div, open the popup
        function functionApplied() {
            var popup = document.getElementById("applied");
            popup.classList.toggle("show");
        }

        function functionAccepted() {
            var popup = document.getElementById("accepted");
            popup.classList.toggle("show");
        }

        function functionRejected() {
            var popup = document.getElementById("rejected");
            popup.classList.toggle("show");
        }

        function functionPaid() {
            var popup = document.getElementById("paid");
            popup.classList.toggle("show");
        }

        function functionUnpaid() {
            var popup = document.getElementById("unpaid");
            popup.classList.toggle("show");
        }
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>






</body>

</html>
