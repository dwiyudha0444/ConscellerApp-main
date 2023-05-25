<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <style>
            body {
                background-color: #FF7F50;
            }

            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-lg-0">
                    <div class="card cascading-right"
                        style="
                    background: hsla(0, 0%, 100%, 0.55);
                    backdrop-filter: blur(30px);
                    ">
                        <div class="card-body p-5 shadow-5">
                            <h2 class="fw-bold mb-5 text-center">Daftar Sebagai Klien</h2>
                            <form action="{{ route('registerClient') }}" method="POST">
                                @csrf
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">Nama Lengkap</label>
                                            <input type="text" name="name" id="form3Example1" class="form-control"
                                                value="{{ old('name') }}" />
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Email</label>
                                            <input type="email" name="email" id="form3Example2" class="form-control"
                                                value="{{ old('email') }}" />
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">Password</label>
                                            <input type="password" name="password" id="form3Example1"
                                                class="form-control" />
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" id="form3Example2"
                                                class="form-control" />
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label" for="form3Example2">Pilih Industri</label>
                                        <select class="form-select">
                                            <option selected>-- Pilih Industri --</option>
                                            <option value="#">1</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example2">Nomor Telepon</label>
                                            <input type="number" name="phone" id="form3Example2" class="form-control"
                                                value="{{ old('phone') }}" />
                                            <div class="form-text">Pastikan No.hp anda benar dan aktif</div>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p>Dengan melakukan pendaftaran, saya setuju dengan <a href=""> Kebijakan
                                            Privasi, Peraturan Klien</a> dan syarat & <a href=""> <a
                                                href="">Ketentuan Collancer</a></p>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">
                                        Daftar dan Lanjutkan
                                    </button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Sudah punya akun?<span><a href="{{ route('login') }}">masuk</a></span></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-lg-0">
                    <img src="{{ asset('templates/frontend') }}/img/logo-model.jpg" height="700px"
                        class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
