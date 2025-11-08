<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Halaman Login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SePeDa (Sistem Pelaporan Daerah) data Indikator Kinerja Kunci (IKK) Pemerintah Daerah Kabupaten Hulu Sungai Utara"/>
        <meta name="author" content="Dewa Kreatif"/>
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
                background: url("{{ asset('backend/assets/images/background.webp')}}") center;
                background-size: cover;
                margin: 0;
                padding: 0;
            }
            .bg-footer {
                background-image: linear-gradient(to right, #0d2882 , #fbab12);
                position: absolute;
                bottom: 0;
                width: 100%;
            }
            .border-primary {
                border: 2px solid !important;
                border-radius: 12px;
                border-top-color: #0d2882 !important;
                border-left-color: #0d2882 !important;
                border-right-color: #fbab12 !important;
                border-bottom-color: #fbab12 !important;
            }
            .btn-primary {
                background-image: linear-gradient(to right, #0d2882 , #fbab12);
                border: none;
                border-radius: 50px;
            }
            .btn-primary:hover {
                background-image: linear-gradient(to right, #fbab12 , #0d2882);
                border: none;
            }
            h1, p {
                color: #000;
            }
            h2 {
                color: #0d2882;
            }
            .form-control {
                border-radius: 24px;
            }
        </style>

    </head>

    <body class="account-page-bg">
        <!-- Begin page -->
        <div class="page-login">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 px-5">
                        <div class="text-center mb-4">
                            <img src="{{ asset('backend/assets/images/sepeda.png') }}" alt="" height="80px" class="block w-100 d-md-none">
                            <img src="{{ asset('backend/assets/images/sepeda.png') }}" alt="" height="80px" class="d-none d-md-block mx-auto">
                        </div>
                        <div class="card border border-primary shadow-lg">
                            <div class="card-body p-4">
                                <h2>Masuk</h2>
                                <form  method="POST" action="{{ route('login') }}" class="mt-3">
                                    @csrf

                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <div class="form-group mb-3">
                                        <input class="form-control" name="username" type="text" id="username" required="" placeholder="Username">
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <input class="form-control" name="password" type="password" required="" id="password" placeholder="Password">
                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                            <i class="icon-dual" data-feather="eye"></i>
                                        </span>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Remember me & Forgot password --}}
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label" for="remember">
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
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('backend/assets/images/logo-setda.png') }}" alt="" height="50px" class="me-2">
                            <img src="{{ asset('backend/assets/images/logo-bangkit.png') }}" alt="" height="50px">
                        </div>
                        <div class="text-justify">
                            <h1 class="display-4 mb-3">Selamat Datang!</h1>
                            <p>Selamat Datang di aplikasi <strong>SePeDa</strong> (Sistem Pelaporan Daerah) Pemerintah Daerah Kabupaten Hulu Sungai Utara.</h1>
                            <p>Portal resmi untuk pelaporan dan monitoring data Indikator Kinerja Kunci (IKK).</p>
                            <p>Silakan Log in menggunakan akun SKPD, Verifikator, atau Administrator Anda untuk memulai sesi pelaporan dan monitoring kinerja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- END wrapper -->
        <footer class="bg-footer text-white text-center py-2">

            <p class="mb-0 text-white">SePeDa &copy; <script>document.write(new Date().getFullYear())</script> - Pemerintah Daerah Kabupaten Hulu Sungai Utara</p>
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

        <script>
            document.getElementById('togglePassword').addEventListener('click', function (e) {
                const password = document.getElementById('password');
                const icon = this.querySelector('i');
                
                // Toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle the icon
                if (type === 'password') {
                    icon.setAttribute('data-feather', 'eye-off');
                } else {
                    icon.setAttribute('data-feather', 'eye');
                }
                feather.replace();
            });
        </script>
    </body>

</html>