<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jumopet Online Payment System - Powered by Doltech Solutions - Register</title>

    <!-- Custom fonts for this template-->
    <link href="asstes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-primary d-flex justify-content-center align-items-center" style="min-height: 100vh">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class=" col-lg-7 col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-10 mx-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register New User</h1>
                                    </div>
                                    <div class="text-center">
                                        <small class="  mb-4 text-danger">Please copy and save the password!</small>
                                    </div>
                                    <form method="POST" action="/register">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Name" value="{{old('name')}}">
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address" value="{{old('email')}}">
                                            @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" value="{{old('username')}}">
                                            @error('username')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control " id="role" name="role" placeholder="Role" required>
                                                <option value="Role">Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="cashier">Cashier</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select class="form-control " id="store" name="store_id" placeholder="Store" required>
                                                <option value="1">Select Store</option>
                                                @foreach ($stores as $store )
                                                <option value="{{$store->id}}">{{$store->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password_confirmation" placeholder="Confirm Password">
                                            @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>


                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Register User" />


                                    </form>
                                    <!-- <div class="text-center">
                                        <small>Already register? <a href="/login">Login</a></small>
                                    </div> -->
                                    <footer class="sticky-footer bg-white">
                                        <div class="container my-auto">
                                            <div class="copyright text-center my-auto">
                                                <span>Copyright &copy; Powered by Doltech Solutions</span>
                                            </div>
                                        </div>
                                    </footer>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>