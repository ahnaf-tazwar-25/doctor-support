<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/icon3.png" rel="icon">
    <title>Doctor - Prescription</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/adminindex.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
</head>
<style>
    .close {
        cursor: pointer;
        padding: 12px 16px;
        transform: translate(0%, -50%);
    }
</style>


<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('doctorindex') }}">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/icon3.png">
                </div>
                <div class="sidebar-brand-text mx-3">Doctor</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('doctorindex') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Users
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('doctorPatList') }}">
                    <i class="fas fa-wheelchair fa-2x text-success"></i>
                    <span>Patients</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('doctorDocList') }}">
                    <i class="fas fa-stethoscope fa-2x text-primary"></i>
                    <span>Doctors</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                My Profile
            </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('docProfile') }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
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
                                    src="/userImage/{{ session('LoggedUser')->image }}" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    {{ session('LoggedUser')->title . ' ' . session('LoggedUser')->fullName }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('docProfile') }}">
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


                {{-- <a style="align-items: flex-end" class="" href="{{ URL::previous() }}">X</a> --}}
                <a style="color: white" href="{{ route('doctorPatList') }}"
                    class="pLoader abc btn btn-sm btn-primary px-4 mb-3 ml-3">back</a>
                <!-- Container Fluid-->
                <div id="patients">
                    <div class="container-fluid" id="container-wrapper">
                        <div class="d-sm-flex align-items-right justify-content-between mb-4">
                            <div></div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('doctorindex') }}">Home</a></li>
                                <li class="breadcrumb-item">Tables</li>
                                <li class="breadcrumb-item active" aria-current="page">Prescription</li>
                            </ol>
                        </div>

                        <div style="border: 5px solid rgb(175, 175, 219)" class="row">
                            <div class="col-md-4">
                                <div class="section-title text-center">
                                    <br>
                                    <h3><b>Patient Details</b></h3><br>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    {{-- Patient Details --}}
                                    <div style="border: 5px double rgb(175, 175, 219)">
                                        <div class="container">
                                            <div class="h5" id="patientDetails"><br>
                                                <div style="padding-bottom: 3%"> Name: <b> {{ $fullName }}
                                                        <br></b>
                                                </div>
                                                <div style="padding-bottom: 3%"> Phone: <b> {{ $contact }}
                                                        <br></b></div>
                                                <div style="padding-bottom: 3%"> Email: <b> {{ $email }}
                                                        <br></b></div>
                                                <div style="padding-bottom: 3%"> Date of Birth: <b>
                                                        {{ $dob }}
                                                        <br></b></div>
                                                <div style="padding-bottom: 3%"> Age: <b> {{ $age2 }}<br></b>
                                                </div>
                                                <div style="padding-bottom: 3%"> Gender: <b>
                                                        {{ $gender }}<br></b></div>
                                                <div style="padding-bottom: 3%"> Address: <b>
                                                        {{ $address }}<br></b></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Patient Details --}}

                            {{-- Add Prescription Form --}}

                            <div class="col-md-8">
                                <div class="section-title text-center">
                                    <br>
                                    <h3><b>Prescription</b></h3><br>
                                </div>
                                @if (count($prescriptions) == 0)
                                    <form action="{{ route('prescription') }}" method="POST"
                                        class="php-email-form w-100">
                                        @csrf
                                        <input type="hidden" name="patEmail" value="{{ $email }}">
                                        <input type="hidden" name="aptID" value="{{ $aptID }}">
                                        <div class="row" id="test">
                                            <div class="col-md-3 form-group mt-3">
                                                <input required type="text" name="medicine[]" class="form-control"
                                                    id="name" placeholder="Medicine Name">
                                            </div>
                                            <div class="col-md-3 form-group mt-3">
                                                <input required class="form-control" type="text" name="times[]"
                                                    placeholder="How many Times">
                                            </div>
                                            <div class="col-md-3 form-group mt-3">
                                                <input required class="form-control" type="text" name="days[]"
                                                    placeholder="How many Days">
                                            </div>
                                            <div class="col-md-3 form-group mt-3">
                                                <input required class="form-control" name="suggession[]"
                                                    rows="1" placeholder="Suggestion (Optional)">
                                            </div>
                                        </div>
                                        <br>
                                        <button class="btn-success btn" type="button" onclick="myFunction()">Add
                                            More</button>
                                        <button class="btn-danger btn" type="button"
                                            onclick="removeFunction()">Remove</button>
                                        <div id="">

                                            <div class="text-center"><input class="btn-primary btn" type="submit"
                                                    value="Submit"></div>
                                            <br>
                                        </div>
                                    </form>
                                @else
                                    <article>
                                        <table class="table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Medicine Name</th>
                                                    <th scope="col">How many Times (Daily)</th>
                                                    <th scope="col">How many Days</th>
                                                    <th scope="col">Suggession</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < count($prescriptions); $i++)
                                                    <tr>
                                                        <th scope="row">{{ $i + 1 }}</th>
                                                        <td> {{ $prescriptions[$i]->medicine }} </td>
                                                        <td> {{ $prescriptions[$i]->times }} </td>
                                                        <td> {{ $prescriptions[$i]->days }} </td>
                                                        <td> {{ $prescriptions[$i]->suggession }} </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </article>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->

                @if (count($reports))
                    <div class="table-responsive p-3">
                        <div class="section-title text-center">
                            <br>
                            <h3><b>Report(s)</b></h3><br>
                        </div>
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
                @endif


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
        </div>
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



    <script>
        var x = 1;

        function removeFunction() {
            if (x > 1) {
                var element = document.getElementById('test');
                element.removeChild(element.lastElementChild);
                element.removeChild(element.lastElementChild);
                element.removeChild(element.lastElementChild);
                element.removeChild(element.lastElementChild);
                x--;
            }
        }

        function myFunction() {
            x++;
            var a =
                '<div class="col-md-3 form-group mt-3"> <input required type="text" name="medicine[]" class="form-control" id="name" placeholder="Medicine Name"></div>';
            var b =
                '<div class="col-md-3 form-group mt-3"> <input required class="form-control" type="text" name="times[]" placeholder="How many Times"></div>';
            var c =
                '<div class="col-md-3 form-group mt-3"> <input required class="form-control" type="text" name="days[]" placeholder="How many Days"></div>';
            var d =
                '<div class="col-md-3 form-group mt-3"> <input required class="form-control" name="suggession[]" rows="1" placeholder="Suggestion (Optional)"></div>';

            document.getElementById("test").innerHTML += a + b + c + d;
            document.getElementById("addSubmit").remove();
        }
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/ruang-admin.min.js"></script>


</body>

</html>


{{-- <div class="col-md-3 form-group mt-3">
    <input type="text" name="medicine[]" class="form-control" id="name" placeholder="Medicine Name">
</div>
<div class="col-md-3 form-group mt-3">
    <input class="form-control" type="text" name="times[]" placeholder="How many Times">
</div>
<div class="col-md-3 form-group mt-3">
    <input class="form-control" type="text" name="days[]" placeholder="How many Days">
</div>
<div class="col-md-3 form-group mt-3">
    <input class="form-control" name="suggession[]" rows="1" placeholder="Suggestion (Optional)">
</div> --}}
