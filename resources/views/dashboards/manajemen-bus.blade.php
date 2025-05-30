<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Bus</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container">
    {{-- BARIS PERTAMA --}}
    <div class="row align-items-center justify-content-center px-3 pb-3">
      <h4>List Data Bus</h4>
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plat</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rute</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($busses as $bus)
                @php
                $route = $routes[$bus['route_id']] ?? null;
                $driver = $drivers[$bus['driver_id']] ?? null;
                @endphp
              <tr>
                <td>
                  <h6 class="mb-0 text-sm">{{ $bus['plat'] }}</h6>
                </td>
                <td>
                  <p class="text-sm font-weight-bold mb-0">{{ $route['nama'] }}</p>
                  <p class="text-xs text-secondary mb-0">({{ $route['rute'] }})</p>
                </td>
                <td>
                  <h6 class="mb-0 text-sm">{{ $driver['nama'] }}</h6>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $bus['status'] }}
                  </span>
                </td>
                <td class="align-middle">
                  <a href="#" class="text-primary font-weight-bold text-xs me-2" data-bs-toggle="modal" data-bs-target="#editBus">Edit</a>
                  <a href="#" class="text-danger font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- BARIS KEDUA --}}
    <div class="row align-items-center justify-content-center px-3">
      <div class="col-sm-6 d-flex justify-content-center">
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#tambahBus">Tambah Bus</button>
      </div>
    </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="tambahBus" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/tambah-bus" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahBusLabel">Tambah Bus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="nama_bus" class="form-control" placeholder="Nama Bus">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editBus" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/tambah-bus" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahBusLabel">Edit Bus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="nama_bus" class="form-control" placeholder="Nama Bus">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>
  @include('partials/footer')
  </div>

</x-layout>