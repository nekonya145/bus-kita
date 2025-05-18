<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Jadwal</h4>
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rute Bus</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Berangkat</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Pulang</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksebilitas</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($routes as $route)
              <tr>
                <td>
                  <p class="text-sm font-weight-bold mb-0">{{ $route['nama'] }}</p>
                  <p class="text-xs text-secondary mb-0">({{ $route['rute'] }})</p>
                </td>
                <td>
                  <span class="text-xs font-weight-bold">
                    {{ $route['hari'] }}
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $route['time-start'] }}
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $route['time-end'] }}
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $route['aksebilitas'] }}
                  </span>
                </td>
                <td class="align-middle">
                  <a href="#" class="text-primary font-weight-bold text-xs me-2" data-toggle="tooltip" title="Edit Bus">Edit</a>
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
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#tambahJadwalBus">Tambah Jadwal</button>
      </div>
    </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="tambahJadwalBus" tabindex="-1" aria-labelledby="modalTambahBusLabel" aria-hidden="true">
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
    
  </div>
  @include('partials/footer')
  </div>

</x-layout>