<aside class="sidenav bg-default navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4">
    <div class="sidenav-header">
      <img src="{{ asset('img/Brazuca Airport.png') }}" width="250px" height="150px">
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <x-aside-item href='/' :isActive="request()->is('/')" icon="tv-2">Dashboard</x-aside-item>
        <x-aside-item href='/manajemen-bus' :isActive="request()->is('manajemen-bus')" icon="bus-front-12">Manajemen Bus</x-aside-item>
        <x-aside-item href='/rute-bus' :isActive="request()->is('rute-bus')" icon="calendar-grid-58">Rute Bus</x-aside-item>
        <x-aside-item href='/live-monitoring' :isActive="request()->is('live-monitoring')" icon="ambulance">Live Monitoring</x-aside-item>
      </ul>
    </div>
</aside>