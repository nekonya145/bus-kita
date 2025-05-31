<!doctype html>
<html lang="en">
    <x-header>{{ $namepage }}</x-header>
    <body>

        @if(session()->has('userfail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session('userfail') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('keluar'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session('keluar') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session()->has('auth'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-white mb-0">{{ session('auth') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="main-content  mt-0">
            <section>
            <div class="page-header min-vh-100">
                <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-start">
                        <h4 class="font-weight-bolder">Log In</h4>
                        <p class="mb-0">Enter your email and password to log in</p>
                        </div>
                        <div class="card-body">
                        <form role="form" action="/login" method="post">
                            @csrf
                            <div class="mb-3">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" name="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                    <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('img/plcholder.png') }}'); background-position-x: 10%;">
                        <span class="mask bg-gradient-primary opacity-6"></span>
                        <h4 class="mt-5 text-white font-weight-bolder position-relative">"Bus Kita"</h4>
                        <p class="text-white position-relative">The more seamless the application feels, the more work the programmer put into crafting it.</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </section>
        </main>

        @include('partials/core-js')
    </body>
</html>