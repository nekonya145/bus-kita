<x-layout>
    <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
    
    <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
      {{-- BARIS PERTAMA --}}
      <div class="row">
          <div class="col">
            <h1>Manajemen Bus</h1>
            <h1>Manajemen Bus</h1>
            <h1>Manajemen Bus</h1>
          </div>
      </div>

    @include('partials/footer')
  </div>

</x-layout>