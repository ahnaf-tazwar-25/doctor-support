<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .register {
            background: -webkit-linear-gradient(left, #7771e0, #210b55);
            margin-top: 3%;
            padding: 3%;
        }

        .register-left {
            text-align: center;
            color: #fff;
            margin-top: 4%;
        }

        .register-left input {
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            width: 60%;
            background: #f8f9fa;
            font-weight: bold;
            color: #383d41;
            margin-top: 30%;
            margin-bottom: 3%;
            cursor: pointer;
        }

        .register-right {
            background: #f8f9fa;
            border-top-left-radius: 10% 50%;
            border-bottom-left-radius: 10% 50%;
        }

        .register-left img {
            margin-top: 15%;
            margin-bottom: 5%;
            width: 25%;
            -webkit-animation: mover 2s infinite alternate;
            animation: mover 1s infinite alternate;
        }

        @-webkit-keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        body {
            background-image: url("assets/css/doctor.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Varela Round', sans-serif;
            line-height: 1.5;
            margin: 0;
            min-block-size: 100vh;
            padding: 5vmin;
        }

        .register-left p {
            font-weight: lighter;
            padding: 12%;
            margin-top: -9%;
        }

        .register .register-form {
            padding: 10%;
            margin-top: 10%;
        }

        .btnRegister {
            float: right;
            margin-top: 10%;
            border: none;
            border-radius: 1.5rem;
            padding: 2%;
            background: #0062cc;
            color: #fff;
            font-weight: 600;
            width: 50%;
            cursor: pointer;
        }

        .register .nav-tabs {
            margin-top: 3%;
            border: none;
            background: #103863;
            border-radius: 1.5rem;
            width: 25.5%;
            float: right;
        }

        .register .nav-tabs .nav-link {
            padding: 2%;
            height: 34px;
            font-weight: 600;
            color: #fff;
            border-top-right-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }

        .register .nav-tabs .nav-link:hover {
            border: none;
        }

        .register .nav-tabs .nav-link.active {
            width: 100px;
            color: #0062cc;
            border: 2px solid #0062cc;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }

        .register-heading {
            text-align: center;
            margin-top: 8%;
            margin-bottom: -15%;
            color: #495057;
        }

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

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login / SignUp</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Titleicons -->
    <link href="assets/img/icon3.png" rel="icon">
</head>


<body>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <a href="/"><img src="assets/img/icon3.png" alt=""></a>
                <h3><b>Book Appointment</b></h3>
                <p>You are 2 minutes away from booking an appointment!</p>

            </div>
            <div class="col-md-9 register-right">
                {{-- <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Patient</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Doctor</a>
                    </li>
                </ul> --}}
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Book an Appointment</h3>
                        {{-- <div class="row register-form"> --}}
                        <form action="{{ route('appointStoredPublic') }}"class="row register-form" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name *"
                                        required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address *" name="address"
                                        required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group maxl">
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

                                <div class="form-group">
                                    <label for="date">&nbsp Appointment Date*</label>
                                    <input id="date" type="date" maxlength="11" minlength="11"
                                        class="form-control" name="appointDate" value="" required>
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
                                </div>
                                <div class="form-group">
                                    <label for="date">&nbsp Date of Birth*</label>
                                    <input id="date2" type="date" maxlength="11" minlength="11"
                                        class="form-control" name="dob" value="" required>
                                    <script language="javascript">
                                        var today = new Date();
                                        var dd = String(today.getDate()).padStart(2, '0');
                                        var mm = String(today.getMonth() + 1).padStart(2, '0');
                                        var yyyy = today.getFullYear();
                                        today = yyyy + '-' + mm + '-' + dd;
                                        $('#date2').attr('max', today);

                                        
                                    </script>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email *"
                                        required>

                                </div>
                                <div class="form-group">
                                    <input type="text" maxlength="11" minlength="11" class="form-control"
                                        name="contact" placeholder="Contact Number *" id="contact" required>
                                </div>
                                <div class="form-group">
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="" selected disabled>Select Department</option>
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
                                    <div class="validate"></div>
                                </div>
                                <div class="form-group pt-4">
                                    <select name="doctor" id="doctor" class="col-md-12 form-control" required>
                                        <option value="" selected disabled>No Doctors Available</option>
                                        {{ csrf_field() }}
                                    </select>
                                    <div class="validate"></div>
                                </div>

                                <div class="form-group"></div>
                                <div class="form-group"></div>
                                <div class="form-group"></div>


                            </div>
                            <div class="col-12 form-group">
                                <textarea class="form-control" id="message" name="message" rows="1" placeholder="Reason for Appointment "
                                    required></textarea>
                            </div>
                            <input id="book" type="submit" class="btnRegister btn-primary" value="Book Now!">
                        </form>
                        {{-- </div> --}}
                    </div>


                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
        $("#book").click(function() {
            var date1 = $("#date").val();
            var department1 = $("#department").val();
            var doctor1 = $("#doctor").val();
            var message1 = $("#message").val();
            var contact = $("#contact").val();
            var email = $("#email").val();

            /*if (date1 == '' || department1 == '' || doctor1 == '' || message1 == '' || contact == '' || email == '') {
                // swal({
                //     title: "Error!",
                //     position: 'top-end',
                //     text: "Please fill all the fields!",
                //     icon: "error",
                //     button: "OK"
                // });
            } else {
                swal({
                    title: "Success!",
                    position: 'top-end',
                    icon: "success",
                    text: "Appointment has been successfully booked!",
                    button: "OK",
                }).then(() => {
                    // window.location.replace("/");
                });
            }*/

        })
    </script>


    <script>
        $(document).ready(function() {

            var token = $('input[name="_token"]').val();

            var department = $('input[name="department"]').val();

            function load_data(department = "None") {
                $.ajax({
                    url: "{{ route('loadDoctorPublic') }}",
                    method: "POST",
                    data: {
                        department: department,
                        _token: token
                    },
                    success: function(data) {
                        // console.log(data);
                        document.getElementById("doctor").innerHTML = data;
                    }
                })
            }

            $(document).on('change', '#department', function() {
                var id = $(this).data('id');
                var e = document.getElementById("department");
                var strUser = e.options[e.selectedIndex].text;
                // alert(strUser);
                load_data(strUser, token);
            });
        });
    </script>


</body>

</html>
