<!doctype html>
<html lang="en">
  <x-header>{{ $namepage }}</x-header>
  <body class="g-sidenav-show bg-white">
    
    <div class="bg-gradient-primary position-absolute w-100" style="background-image: url('{{ asset('img/bgdiv.png') }}'); background-position-y: 50%; min-height:5rem"><span class="mask bg-primary opacity-3"></span></div>
    <x-aside></x-aside>
    <main class="main-content position-relative border-radius-lg">
      @include('partials/navbar')
      {{ $slot }}
    </main>

    @include('partials/core-js')
  </body>
  
</html>