@extends('layouts.main')
@section('content')

<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-center row">
        <div class="col-sm-7">
          <div class="card-body pe-2">
            @php
              $hour = date("G");
              if ((int)$hour >= 0 && (int)$hour <= 10) {
                  $greet = "Selamat Pagi";
              } else if ((int)$hour >= 11 && (int)$hour <= 14) {
                  $greet = "Selamat Siang";
              } else if ((int)$hour >= 15 && (int)$hour <= 17) {
                  $greet = "Selamat Sore";
              } else if ((int)$hour >= 18 && (int)$hour <= 23) {
                  $greet = "Selamat Malam";
              } else {
                  $greet = "Welcome,";
              }
            @endphp
            @auth
                <h5 class="card-title text-primary text-capitalize">Halo, {{ $greet }} {{  auth()->user()->name  }} 🎉</h5>
            @else
                <h5 class="card-title text-primary">Halo, {{ $greet }} 🎉</h5>
            @endauth
            <p class="mb-4">
              Semoga harimu menyenangkan hari ini.

          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-4 px-0 px-md-4">
            <img
              src="{{ asset('vads.png') }}" style="width:100%;height:auto"
              height="140"
              alt="Dashboard Image"/>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 mb-4">
        <div class="card">
          <div class="card-body">
              <h5 class="text-primary">Tanggal dan Waktu</h5>
              <div class="d-flex align-items-center">
                <i class='bx bx-calendar me-2'></i>
                <span class="fw-medium"> {{ date("l, d M Y.") }}</span>
              </div>
              <div class="d-flex align-items-center mt-2">
                <i class='bx bx-time me-2'></i>
                <span class="fw-medium">
                  @php $time = '<label class="display-time"></label>' . date(" a"); 
                  echo $time;
                  @endphp
                </span>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    
@endsection


@push('js')

<script>
  const displayTime = document.querySelector(".display-time");
  // Time
  function showTime() {
  let time = new Date();
  displayTime.innerText = time.toLocaleTimeString("id-ID", { hour12: false });
  setTimeout(showTime, 1000);
  }

  showTime();
</script>
@endpush