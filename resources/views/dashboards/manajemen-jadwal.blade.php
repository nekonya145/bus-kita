<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Jadwal</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="text-white mb-0">{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
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
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
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
                    {{ $route['aksesibilitas'] }}
                  </span>
                </td>
                <td class="align-middle">
                  <a href="#" class="text-primary font-weight-bold text-xs me-2" data-bs-toggle="modal" data-bs-target="#editJadwalBus">Edit</a>
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
    <div class="modal fade" id="tambahJadwalBus" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">

            <form action="/tambah-rute" method="POST">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal Bus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="mb-3">
                  <label for="nama_rute" class="form-label">Nama Rute</label>
                  <input type="text" name="nama_rute" class="form-control @error('nama_rute') is-invalid @enderror" placeholder="Contoh: MBG XYZ" value="{{ old('nama_rute') }}" required>
                  @error('nama_rute')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="jalur_rute" class="form-label">Jalur Rute</label>
                  <input type="text" name="jalur_rute"  class="form-control @error('jalur_rute') is-invalid @enderror" placeholder="Contoh: Berua - Pangkep" value="{{ old('jalur_rute') }}" required>
                  @error('jalur_rute')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="jam_keberangkatan" class="form-label">Waktu Berangkat</label>
                    <input type="time" name="jam_keberangkatan" class="form-control @error('jam_keberangkatan') is-invalid @enderror" value="{{ old('jam_keberangkatan') }}" required>
                    @error('jam_keberangkatan')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="jam_kepulangan" class="form-label">Waktu Pulang</label>
                    <input type="time" name="jam_kepulangan" class="form-control @error('jam_kepulangan') is-invalid @enderror" value="{{ old('jam_kepulangan') }}" required>
                    @error('jam_kepulangan')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="mb-3">
                    <label for="hari_keberangkatan" class="form-label">Hari Keberangkatan</label>
                    <select class="form-select @error('hari_keberangkatan') is-invalid @enderror" name="hari_keberangkatan" required>
                      <option value="" disabled selected>-- Pilih Hari --</option>
                      <option value="Senin" @if(old('hari_keberangkatan') == 'Senin') selected @endif>Senin</option>
                      <option value="Selasa" @if(old('hari_keberangkatan') == 'Selasa') selected @endif>Selasa</option>
                      <option value="Rabu" @if(old('hari_keberangkatan') == 'Rabu') selected @endif>Rabu</option>
                      <option value="Kamis" @if(old('hari_keberangkatan') == 'Kamis') selected @endif>Kamis</option>
                      <option value="Jumat" @if(old('hari_keberangkatan') == 'Jumat') selected @endif>Jumat</option>
                      <option value="Sabtu" @if(old('hari_keberangkatan') == 'Sabtu') selected @endif>Sabtu</option>
                      <option value="Minggu" @if(old('hari_keberangkatan') == 'Minggu') selected @endif>Minggu</option>
                    </select>
                    @error('hari_keberangkatan')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
              </div>
            </form>

        </div>
      </div>
    </div>

    <div class="modal fade" id="editJadwalBus" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/tambah-bus" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahBusLabel">Edit Jadwal Bus</h5>
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