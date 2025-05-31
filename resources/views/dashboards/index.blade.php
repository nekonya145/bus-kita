<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session()->has('loggedin'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('loggedin') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
    {{-- BARIS PERTAMA --}}
    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
        <div class="row p-3 rounded shadow-lg d-flex mx-2" style="background: #f5eedc">
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahBus">0</p>
              </div>
              </div>
              <p class="m-0">Jumlah Bus</p>
            </div>
          </div>
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahRoute">0</p>
              </div>
              </div>
              <p class="m-0">Jumlah Rute</p>
            </div>
          </div>
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2 mx-auto">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahSiswa">0</p>
              </div>
              </div>
              <p class="m-0">Jumlah Siswa</p>
            </div>
          </div>

        </div>
        </div>
    </div>

    {{-- BARIS Kedua --}}
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
        <div class="rounded p-3 mx-2 shadow-lg" style="background: #f5eedc">
          <h4>Live Map</h4>

            <div id="map" class="rounded" style="min-height: 50vh;"></div>
            <script>
            const map = L.map('map').setView([-4.132041466037736, 120.03455798756075], 15);
            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            const busIcon = L.icon({
                iconUrl: '{{ asset('img/marker.png') }}',
                iconSize: [38, 38],
                iconAnchor: [20, 20],
                popupAnchor: [0, -20],
            });

            const busses = {!! json_encode($busses) !!};
            const routes = {!! json_encode($routes) !!};
            const siswas = {!! json_encode($siswas) !!};

            document.getElementById('jumlahBus').textContent = `${Object.keys(busses).length}`;
            document.getElementById('jumlahRoute').textContent = `${Object.keys(routes).length}`;
            document.getElementById('jumlahSiswa').textContent = `${Object.keys(siswas).length}`;

            Object.entries(busses).forEach(([key, bus]) => {
              const [lat, lng] = bus.koordinat.split(',').map(coord => parseFloat(coord.trim()));
              const marker = L.marker([lat, lng], { icon: busIcon }).addTo(map);
              const routeInfo = routes[bus.route_id] || {};

              L.marker([lat, lng], {icon: busIcon})
                  .addTo(map)
                  .bindPopup(`<b>${bus.namabus}</b><br>${routeInfo.rute}<br>${bus.status}`);
            });

            </script>

        </div>
    </div>

  @include('partials/footer')
  </div>

</x-layout>