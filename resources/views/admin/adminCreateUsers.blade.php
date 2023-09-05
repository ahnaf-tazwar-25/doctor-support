<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/img/icon3.png" rel="icon">
    <title>Admin - Create Users</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/adminindex.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

            <li class="nav-item active">
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
            <li class="nav-item">
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
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="col-md-9 register-right" style="margin-left: 5%;">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-bold" id="home-tab" data-toggle="tab" href="#home"
                                role="tab" aria-controls="home" aria-selected="true">Patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-bold" id="profile-tab" data-toggle="tab" href="#profile"
                                role="tab" aria-controls="profile" aria-selected="false">Doctor</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <h3 class="register-heading">Apply as a Patient</h3>
                            {{-- <div class="row register-form"> --}}
                            <form action="{{ route('signupPatDoc') }}" enctype="multipart/form-data"
                                class="row register-form" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fullName"
                                            placeholder="Full Name *" value="" required>
                                    </div>

                                    <div class="form-group">
                                        @if (!session()->has('errors'))
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email *" value="" required>
                                        @endif
                                        @if (session()->has('errors'))
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email *" value="{{ session('errors')->first('email') }}"
                                                required>
                                            <p class="text-danger font-weight-bold">
                                                {{ session('errors')->first('emailError') }}
                                            </p>
                                        @endif
                                    </div>
                                    <input type="text" class="form-control" name="type" value="pat" hidden>

                                    <div class="form-group">
                                        @if (!session()->has('errors'))
                                            <input type="text" maxlength="11" minlength="11" class="form-control"
                                                name="contact" placeholder="Contact Number *" value=""
                                                required>
                                        @endif

                                        @if (session()->has('errors'))
                                            <input type="text" maxlength="11" minlength="11" class="form-control"
                                                name="contact" placeholder="Contact Number *"
                                                value="{{ session('errors')->first('contact') }}" required>
                                            <p class="text-danger font-weight-bold">
                                                {{ session('errors')->first('contactError') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">&nbsp Date of Birth</label>
                                        <input type="date" maxlength="11" minlength="11" class="form-control"
                                            id="dob1" name="dob" placeholder="Date of Birth *"
                                            value="" required>
                                        <script language="javascript">
                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear();
                                            // console.log('yyyy', yyyy);
                                            today = yyyy + '-' + mm + '-' + dd;
                                            $('#dob1').attr('max', today);
                                        </script>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address *"
                                            name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password *" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Confirm Password *" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="maxl">
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Male" checked="">
                                                <span> Male </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Female">
                                                <span>Female </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Other">
                                                <span>Other </span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Upload image input-->
                                    {{-- Upload your Image --}}
                                    {{-- <div class="d-flex text-left">
                                        <input type="file" name="img1" accept="image/*" required>
                                    </div> --}}
                                    <!-- Upload image input-->
                                    <br>
                                    <br>
                                    {{-- <p> <a href="/signin">Already have an account?</a></p> --}}
                                    <input type="submit" class="btn btn-primary btnRegister" value="Register">
                                </div>
                            </form>
                            {{-- </div> --}}
                        </div>


                        <!-- Doctors -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h3 class="register-heading">Apply as a Doctor</h3>
                            <form action="{{ route('signupPatDoc') }}" enctype="multipart/form-data"
                                class="row register-form" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" required name="title" id="title">
                                            <option selected disabled>Title </option>
                                            <option value="Dr.">Dr. </option>
                                            <option value="Prof. Dr.">Prof. Dr. </option>
                                            <option value="Assoc. Prof. Dr.">Assoc. Prof. Dr. </option>
                                            <option value="Asst. Prof. Dr.">Asst. Prof. Dr. </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Full Name *"
                                            name="fullName" required>
                                    </div>
                                    <div class="form-group">
                                        @if (!session()->has('errors'))
                                            <input type="email" class="form-control" placeholder="Email *"
                                                name="email" required>
                                        @endif
                                        @if (session()->has('errors'))
                                            <input type="email" class="form-control" placeholder="Email *"
                                                name="email" value="{{ session('errors')->first('email') }}"
                                                required>
                                            <p class="text-danger font-weight-bold">
                                                {{ session('errors')->first('emailError') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="text" maxlength="11" minlength="11" class="form-control"
                                            placeholder="Phone *" name="contact" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">&nbsp Date of Birth</label>
                                        <input type="date" id="dob2" maxlength="11" minlength="11"
                                            class="form-control" placeholder=" *" name="dob" required>
                                        <script language="javascript">
                                            var today = new Date();
                                            var dd = String(today.getDate()).padStart(2, '0');
                                            var mm = String(today.getMonth() + 1).padStart(2, '0');
                                            var yyyy = today.getFullYear() - 25;
                                            today = yyyy + '-' + mm + '-' + dd;
                                            $('#dob2').attr('max', today);
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Office Address *"
                                            name="address" required>
                                    </div>

                                    <div class="form-group">
                                        <div class="maxl">
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Male" checked="">
                                                <span> Male </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Female">
                                                <span>Female </span>
                                            </label>
                                            <label class="radio inline">
                                                <input type="radio" name="gender" value="Other">
                                                <span>Other </span>
                                            </label>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="department" id="department" class="form-control">
                                            <option selected disabled>Select Department</option>
                                            <option value="CARDIAC AND VASCULAR SURGERY">CARDIAC AND VASCULAR SURGERY
                                            </option>
                                            <option value="CARDIOLOGY (INTERVENTIONAL)">CARDIOLOGY (INTERVENTIONAL)
                                            </option>
                                            <option value="CHILD DEVELOPMENT">CHILD DEVELOPMENT</option>
                                            <option value="MEDICINE">MEDICINE</option>
                                            <option value="NEURO SURGERY">NEURO SURGERY</option>
                                            <option value="NEUROMEDICINE">NEUROMEDICINE</option>
                                            <option value="PSYCHIATRY">PSYCHIATRY</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" maxlength="7" minlength="7" class="form-control"
                                            placeholder="BMDC Registration Number *" name="bmdcRegNum" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" maxlength="10" minlength="10" class="form-control"
                                            placeholder="NID/Passport Number *" name="nidPassport" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="fees" class="form-control" placeholder="Consultation Fees *"
                                            name="fees" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *"
                                            name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password *"
                                            name="password_confirmation" required>
                                    </div>

                                    <!-- Upload image input-->
                                    Upload your Image
                                    <div class="d-flex text-left">
                                        <input type="file" name="img2" accept="image/*" required>
                                    </div>
                                    <!-- Upload image input-->
                                    <br>
                                    <br>
                                    {{-- <p> <a href="/signin">Already have an account?</a></p> --}}

                                    <input type="submit" class="btn btn-primary btnRegister" value="Register">

                                </div>
                            </form>
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
</body>

</html>
