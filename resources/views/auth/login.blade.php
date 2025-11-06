<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Login Page </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico')}}">

        <!-- App css -->
        <link href="{{ asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="{{ asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

        <style>
            .page-login {
                align-items: center;
                display: flex;
                min-height: 100vh;
            }
            .account-page-bg {
                background: url("{{ asset('backend/assets/images/background.jpg')}}");
                background-size: cover;
                margin: 0;
                padding: 0;
            }
            .bg-footer {
                background-image: linear-gradient(to right, blue , orange);
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        </style>

    </head>

    <body class="account-page-bg">
        <!-- Begin page -->
        
        <div class="page-login">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 px-5">
                        <div class="card border border-primary shadow-lg">
                            <div class="card-body p-4">
                                <h1>Masuk</h1>
                                <form  method="POST" action="{{ route('login') }}" class="mt-3">
                                    @csrf

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="email" type="email" id="email" required="" placeholder="Username">
                                        <label for="floatingInput">Username</label>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" type="password" required="" id="password" placeholder="Password">
                                        <label for="floatingInput">Password</label>
                                        @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Remember me & Forgot password --}}
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Ingat Saya
                                            </label>
                                        </div>
                                        <div>
                                            <a href="{{ route('password.request') }}">Lupa password?</a>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary w-100" type="submit"> Log in </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-lg-block d-none">
                        <div class="text-justify">
                            <h1 class="display-4 mb-3">Selamat Datang!</h1>
                            <p>Selamat Datang di aplikasi <strong>SePeDa</strong> (Sistem Pelaporan Daerah) Pemerintah Daerah Kabupaten Hulu Sungai Utara.</h1>
                            <p>Untuk memulai silahkan isikan username dan password anda, kemudian klik tombol Log in untuk masuk ke dalam aplikasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- END wrapper -->
        <footer class="bg-footer text-white text-center py-2">
            <p class="mb-0">SePeDa &copy 2025 - Pemerintah Daerah Kabupaten Hulu Sungai Utara</p>
        </footer>

        <!-- Vendor -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>

        <!-- App js-->
        <script src="{{ asset('backend/assets/js/app.js')}}"></script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
         }
         @endif 
        </script>
    </body>

</html>