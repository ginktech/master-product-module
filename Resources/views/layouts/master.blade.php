<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        {{-- Laravel Vite - CSS File --}}
        {{-- {{ module_vite('build-product', 'Resources/assets/sass/app.scss') }} --}}
        @stack('css')
    </head>
    <body>
        <div class="container py-5">
            <div class="row align-items-end mb-4">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <h1 class="mb-0 fs-3 fw-bolder text-uppercase">{!! config('masterproduct.name') !!}</h1>
                </div>
                <div class="col-lg-8">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-product.index') ? 'active' : '' }}" href="{{ route('master-product.index') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-product.brands.*') ? 'active' : '' }}" href="{{ route('master-product.brands.index') }}">Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-product.categories.*') ? 'active' : '' }}" href="{{ route('master-product.categories.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('master-product.products.*') ? 'active' : '' }}" href="{{ route('master-product.products.index') }}">Products</a>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </div>
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-product', 'Resources/assets/js/app.js') }} --}}

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @stack('js')
    </body>
</html>
