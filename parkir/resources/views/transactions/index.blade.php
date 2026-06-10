@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    
    <!-- STATS MINI CARDS ROW (Motor, Mobil, Truck, Total Active) -->
    <div class="row mb-4">
        <!-- Motor Card -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="border-radius: 1rem;">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Motor Parkir</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $motorParkedCount }}
                                    <span class="text-success text-xs font-weight-bold">aktif</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape shadow text-center border-radius-md d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(310deg, #7928CA, #FF0080);">
                                <i class="fa-solid fa-motorcycle text-white" style="font-size: 1.3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobil Card -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="border-radius: 1rem;">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Mobil Parkir</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $carParkedCount }}
                                    <span class="text-success text-xs font-weight-bold">aktif</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape shadow text-center border-radius-md d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(310deg, #1171EF, #11CDEF);">
                                <i class="fa-solid fa-car text-white" style="font-size: 1.3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Truck Card -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card" style="border-radius: 1rem;">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Truck Parkir</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $truckParkedCount }}
                                    <span class="text-success text-xs font-weight-bold">aktif</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape shadow text-center border-radius-md d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(310deg, #f5365c, #f56036);">
                                <i class="fa-solid fa-truck text-white" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Active Tickets -->
        <div class="col-xl-3 col-sm-6">
            <div class="card" style="border-radius: 1rem;">
                <div class="card-body p-3">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kendaraan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $motorParkedCount + $carParkedCount + $truckParkedCount }}
                                    <span class="text-secondary text-xs font-weight-bold">total</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape shadow text-center border-radius-md d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: linear-gradient(310deg, #2d3748, #4a5568);">
                                <i class="fa-solid fa-square-parking text-white" style="font-size: 1.3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TOP CARDS ROW -->
    <div class="row">
        
        <!-- CARD 1: CLOCK CARD -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-cover text-center text-white h-100 position-relative overflow-hidden" 
                 style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}'); min-height: 180px; border-radius: 1rem;">
                <span class="mask bg-gradient-dark opacity-7 position-absolute start-0 top-0 w-100 h-100"></span>
                <div class="card-body z-index-2 d-flex flex-column justify-content-between p-3 relative">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <img src="{{ asset('assets/img/logo-ct.png') }}" class="h-100" style="max-height: 35px;" alt="logo">
                    </div>
                    <div>
                        <h5 class="text-white font-weight-bolder mb-0" id="clockDay">Monday</h5>
                        <p class="text-xs text-white opacity-8 mb-2" id="clockDate">8 December 2025</p>
                    </div>
                    <div>
                        <h3 class="text-white font-weight-bolder mb-0" id="clockTime" style="letter-spacing: 2px;">13:22:28</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: GEDUNG A -->
        @php
            $gedungA = $locations->where('name', 'Gedung A')->first();
            $capA_motor = $gedungA ? $gedungA->capacity_motor : 3;
            $capA_car = $gedungA ? $gedungA->capacity_car : 0;
            $capA_truck = $gedungA ? $gedungA->capacity_truck : 0;
            
            $remA_motor = $gedungA ? $gedungA->getRemainingCapacity('Motor') : 0;
            $remA_car = $gedungA ? $gedungA->getRemainingCapacity('Car') : 0;
            $remA_truck = $gedungA ? $gedungA->getRemainingCapacity('Truck/Bus/Other') : 0;
            
            // Check if occupied (any vehicle is parked)
            $isA_occupied = ($remA_motor < $capA_motor) || ($remA_car < $capA_car) || ($remA_truck < $capA_truck);
        @endphp
        <div class="col-lg-2 col-md-4 mb-4">
            <div class="card text-center h-100" style="border-radius: 1rem; box-shadow: 0 10px 30px 0 rgba(0,0,0,0.05);">
                <div class="card-body p-3 d-flex flex-column justify-content-between align-items-center">
                    
                    <!-- Pink/Purple Gradient Square Box with Building Icon & Status Circle -->
                    <div class="border-radius-lg p-2 d-flex flex-column align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FF007F 0%, #7928CA 100%); box-shadow: 0 4px 15px rgba(121, 40, 202, 0.25);">
                        <i class="fa-solid fa-building text-white text-xs mb-1" style="font-size: 11px !important;"></i>
                        <div class="rounded-circle {{ $isA_occupied ? 'bg-dark' : 'bg-white' }}" style="width: 16px; height: 16px; opacity: {{ $isA_occupied ? '0.7' : '1' }};"></div>
                    </div>
                    
                    <div class="mt-2 w-100">
                        <h6 class="text-sm font-weight-bolder mb-1 text-dark">Gedung A</h6>
                        <!-- Capacity Row (Grey) -->
                        <div class="d-flex align-items-center justify-content-center gap-2 text-secondary text-xxs font-weight-bold">
                            <span><i class="fa-solid fa-motorcycle text-xxs me-1"></i>{{ $capA_motor }}</span>
                            <span><i class="fa-solid fa-car text-xxs me-1"></i>{{ $capA_car }}</span>
                            <span><i class="fa-solid fa-truck text-xxs me-1"></i>{{ $capA_truck }}</span>
                        </div>
                    </div>
                    
                    <!-- Availability Status Row (Plain colored icons + text) -->
                    <div class="d-flex align-items-center justify-content-center gap-3 pt-2 w-100 border-top mt-2">
                        <span class="font-weight-bolder text-xs {{ $remA_motor > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-motorcycle me-1"></i>{{ $remA_motor }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remA_car > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-car me-1"></i>{{ $remA_car }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remA_truck > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-truck me-1"></i>{{ $remA_truck }}
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- CARD 3: GEDUNG B -->
        @php
            $gedungB = $locations->where('name', 'Gedung B')->first();
            $capB_motor = $gedungB ? $gedungB->capacity_motor : 3;
            $capB_car = $gedungB ? $gedungB->capacity_car : 3;
            $capB_truck = $gedungB ? $gedungB->capacity_truck : 0;
            
            $remB_motor = $gedungB ? $gedungB->getRemainingCapacity('Motor') : 0;
            $remB_car = $gedungB ? $gedungB->getRemainingCapacity('Car') : 0;
            $remB_truck = $gedungB ? $gedungB->getRemainingCapacity('Truck/Bus/Other') : 0;
            
            $isB_occupied = ($remB_motor < $capB_motor) || ($remB_car < $capB_car) || ($remB_truck < $capB_truck);
        @endphp
        <div class="col-lg-2 col-md-4 mb-4">
            <div class="card text-center h-100" style="border-radius: 1rem; box-shadow: 0 10px 30px 0 rgba(0,0,0,0.05);">
                <div class="card-body p-3 d-flex flex-column justify-content-between align-items-center">
                    
                    <!-- Pink/Purple Gradient Square Box with Building Icon & Status Circle -->
                    <div class="border-radius-lg p-2 d-flex flex-column align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FF007F 0%, #7928CA 100%); box-shadow: 0 4px 15px rgba(121, 40, 202, 0.25);">
                        <i class="fa-solid fa-building text-white text-xs mb-1" style="font-size: 11px !important;"></i>
                        <div class="rounded-circle {{ $isB_occupied ? 'bg-dark' : 'bg-white' }}" style="width: 16px; height: 16px; opacity: {{ $isB_occupied ? '0.7' : '1' }};"></div>
                    </div>
                    
                    <div class="mt-2 w-100">
                        <h6 class="text-sm font-weight-bolder mb-1 text-dark">Gedung B</h6>
                        <!-- Capacity Row (Grey) -->
                        <div class="d-flex align-items-center justify-content-center gap-2 text-secondary text-xxs font-weight-bold">
                            <span><i class="fa-solid fa-motorcycle text-xxs me-1"></i>{{ $capB_motor }}</span>
                            <span><i class="fa-solid fa-car text-xxs me-1"></i>{{ $capB_car }}</span>
                            <span><i class="fa-solid fa-truck text-xxs me-1"></i>{{ $capB_truck }}</span>
                        </div>
                    </div>
                    
                    <!-- Availability Status Row (Plain colored icons + text) -->
                    <div class="d-flex align-items-center justify-content-center gap-3 pt-2 w-100 border-top mt-2">
                        <span class="font-weight-bolder text-xs {{ $remB_motor > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-motorcycle me-1"></i>{{ $remB_motor }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remB_car > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-car me-1"></i>{{ $remB_car }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remB_truck > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-truck me-1"></i>{{ $remB_truck }}
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- CARD 4: GEDUNG C -->
        @php
            $gedungC = $locations->where('name', 'Gedung C')->first();
            $capC_motor = $gedungC ? $gedungC->capacity_motor : 3;
            $capC_car = $gedungC ? $gedungC->capacity_car : 3;
            $capC_truck = $gedungC ? $gedungC->capacity_truck : 3;
            
            $remC_motor = $gedungC ? $gedungC->getRemainingCapacity('Motor') : 0;
            $remC_car = $gedungC ? $gedungC->getRemainingCapacity('Car') : 0;
            $remC_truck = $gedungC ? $gedungC->getRemainingCapacity('Truck/Bus/Other') : 0;
            
            $isC_occupied = ($remC_motor < $capC_motor) || ($remC_car < $capC_car) || ($remC_truck < $capC_truck);
        @endphp
        <div class="col-lg-2 col-md-4 mb-4">
            <div class="card text-center h-100" style="border-radius: 1rem; box-shadow: 0 10px 30px 0 rgba(0,0,0,0.05);">
                <div class="card-body p-3 d-flex flex-column justify-content-between align-items-center">
                    
                    <!-- Pink/Purple Gradient Square Box with Building Icon & Status Circle -->
                    <div class="border-radius-lg p-2 d-flex flex-column align-items-center justify-content-center" 
                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #FF007F 0%, #7928CA 100%); box-shadow: 0 4px 15px rgba(121, 40, 202, 0.25);">
                        <i class="fa-solid fa-building text-white text-xs mb-1" style="font-size: 11px !important;"></i>
                        <div class="rounded-circle {{ $isC_occupied ? 'bg-dark' : 'bg-white' }}" style="width: 16px; height: 16px; opacity: {{ $isC_occupied ? '0.7' : '1' }};"></div>
                    </div>
                    
                    <div class="mt-2 w-100">
                        <h6 class="text-sm font-weight-bolder mb-1 text-dark">Gedung C</h6>
                        <!-- Capacity Row (Grey) -->
                        <div class="d-flex align-items-center justify-content-center gap-2 text-secondary text-xxs font-weight-bold">
                            <span><i class="fa-solid fa-motorcycle text-xxs me-1"></i>{{ $capC_motor }}</span>
                            <span><i class="fa-solid fa-car text-xxs me-1"></i>{{ $capC_car }}</span>
                            <span><i class="fa-solid fa-truck text-xxs me-1"></i>{{ $capC_truck }}</span>
                        </div>
                    </div>
                    
                    <!-- Availability Status Row (Plain colored icons + text) -->
                    <div class="d-flex align-items-center justify-content-center gap-3 pt-2 w-100 border-top mt-2">
                        <span class="font-weight-bolder text-xs {{ $remC_motor > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-motorcycle me-1"></i>{{ $remC_motor }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remC_car > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-car me-1"></i>{{ $remC_car }}
                        </span>
                        <span class="font-weight-bolder text-xs {{ $remC_truck > 0 ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid fa-truck me-1"></i>{{ $remC_truck }}
                        </span>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- CARD 5: TICKETS DETAIL PREVIEW -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100" style="border-radius: 1rem;">
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="text-sm font-weight-bolder mb-0">Tickets</h6>
                        <a href="{{ route('transactions.view-all') }}" class="btn btn-outline-primary btn-xs mb-0 px-2 text-uppercase font-weight-bolder" style="border-color: #cb0c9f; color: #cb0c9f;">
                            VIEW ALL
                        </a>
                    </div>
                    
                    @if($latestTransaction)
                        <div class="bg-gray-50 border-radius-md p-2 text-start">
                            <p class="text-xxs font-weight-bold text-secondary mb-1">
                                {{ $latestTransaction->created_at->format('Y-m-d H:i:s') }}
                            </p>
                            <h6 class="text-xs font-weight-bolder mb-0 text-dark">
                                #{{ $latestTransaction->ticket_number }}
                            </h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-2 pt-1 border-top">
                            <a href="{{ route('transactions.download-ticket', $latestTransaction->ticket_number) }}" target="_blank" class="text-xs font-weight-bold text-secondary d-flex align-items-center gap-1">
                                <i class="fa-solid fa-file-pdf text-danger text-sm"></i> PDF
                            </a>
                        </div>
                    @else
                        <p class="text-xs text-secondary text-center py-3">Belum ada tiket transaksi.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- TRANSACTION INPUT FORM CARD -->
    <div class="row">
        <div class="col-12">
            
            <!-- Alert success/error messages -->
            @if(session('success'))
                <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>Sukses!</strong> {{ session('success') }}</span>
                    @if(session('ticket_url'))
                        <br>
                        <a href="{{ session('ticket_url') }}" target="_blank" class="btn btn-white btn-xs mt-2 mb-0 text-success">
                            <i class="fa-solid fa-file-pdf me-1"></i> Buka/Cetak Tiket PDF
                        </a>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
                    <span class="alert-text">{{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card" style="border-radius: 1.5rem;">
                
                <!-- Tab Switching Navigation -->
                <div class="p-3 bg-gray-50 border-bottom d-flex justify-content-between align-items-center" style="border-radius: 1.5rem 1.5rem 0 0;">
                    <div class="nav-wrapper position-relative end-0 w-50">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active font-weight-bold text-xs" id="btn-mode-exit" data-bs-toggle="tab" href="#exit-mode-tab" role="tab" aria-selected="true">
                                    <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar (Exit Vehicle)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 font-weight-bold text-xs" id="btn-mode-enter" data-bs-toggle="tab" href="#enter-mode-tab" role="tab" aria-selected="false">
                                    <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk (Enter Vehicle)
                                </a>
                            </li>
                        </ul>
                    </div>
                    <span class="text-xs text-secondary font-weight-bold"><i class="fa-solid fa-circle-info me-1"></i> Pilih mode transaksi</span>
                </div>

                <div class="card-body p-4 tab-content">
                    
                    <!-- MODE 1: EXIT VEHICLE FORM (Active by default based on image) -->
                    <div class="tab-pane fade show active" id="exit-mode-tab" role="tabpanel">
                        <form action="{{ route('transactions.store-exit') }}" method="POST" id="exitForm">
                            @csrf
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-weight-bolder text-gradient text-primary m-0" style="background-image: linear-gradient(310deg, #7928CA, #B80075);">
                                    Transaction <span class="font-weight-light text-secondary text-lg">Input Form</span>
                                </h4>
                                <button type="submit" class="btn font-weight-bolder text-xs px-4 py-2" style="background-color: #1e293b; color: #fff; border-radius: 10px;">
                                    + EXIT VEHICLE
                                </button>
                            </div>

                            <div class="row">
                                <!-- Field 1: Ticket Number Selection -->
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 border-radius-xl bg-white" style="min-height: 100px; border-color: #cb0c9f !important;">
                                        <label class="text-xxs font-weight-bold text-secondary text-uppercase d-block mb-1">Ticket Number</label>
                                        <select name="transaction_id" id="transaction_id" class="form-select border-0 font-weight-bolder text-dark p-0" style="font-size: 24px; outline: none; box-shadow: none;" required>
                                            <option value="">PILIH TIKET</option>
                                            @foreach($parkedTransactions as $pt)
                                                <option value="{{ $pt->id }}">{{ $pt->ticket_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Field 2: Police Number Input -->
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 border-radius-xl bg-white" style="min-height: 100px; border-color: #cb0c9f !important;">
                                        <label for="plate_number" class="text-xxs font-weight-bold text-secondary text-uppercase d-block mb-1">Police Number</label>
                                        <input type="text" name="plate_number" id="plate_number" class="form-control border-0 font-weight-bolder text-dark p-0 text-uppercase" placeholder="INPUT PLAT NOMOR" style="font-size: 24px; outline: none; box-shadow: none;" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Ticket Details Info (Hidden if no ticket selected) -->
                            <div class="row mt-2 d-none" id="exit_ticket_info">
                                <div class="col-12">
                                    <div class="bg-gray-100 border-radius-lg p-3 text-start">
                                        <span class="text-xs text-secondary font-weight-bold d-block mb-1"><i class="fa-solid fa-circle-info me-1"></i> Detail Tiket Aktif:</span>
                                        <div class="d-flex flex-wrap gap-4 text-xs font-weight-bold text-dark">
                                            <span><strong>Lokasi:</strong> <span id="exit_info_location">-</span></span>
                                            <span><strong>Tipe Kendaraan:</strong> <span id="exit_info_vehicle_type">-</span></span>
                                            <span><strong>Waktu Masuk:</strong> <span id="exit_info_entry_time">-</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- MODE 2: ENTER VEHICLE FORM -->
                    <div class="tab-pane fade" id="enter-mode-tab" role="tabpanel">
                        <form action="{{ route('transactions.store-entry') }}" method="POST" id="entryForm">
                            @csrf
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="font-weight-bolder text-gradient text-primary m-0" style="background-image: linear-gradient(310deg, #7928CA, #B80075);">
                                    Transaction <span class="font-weight-light text-secondary text-lg">Input Form</span>
                                </h4>
                                <button type="submit" class="btn font-weight-bolder text-xs px-4 py-2" style="background-color: #1e293b; color: #fff; border-radius: 10px;">
                                    + ENTER VEHICLE
                                </button>
                            </div>

                            <div class="row">
                                <!-- Field 1: Select Location -->
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 border-radius-xl bg-white" style="min-height: 100px; border-color: #cb0c9f !important;">
                                        <label for="location_id" class="text-xxs font-weight-bold text-secondary text-uppercase d-block mb-1">Pilih Lokasi (Gedung)</label>
                                        <select name="location_id" id="location_id" class="form-select border-0 font-weight-bolder text-dark p-0" style="font-size: 24px; outline: none; box-shadow: none;" required>
                                            <option value="">PILIH LOKASI</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Field 2: Select Vehicle Type -->
                                <div class="col-md-6 mb-3">
                                    <div class="border p-3 border-radius-xl bg-white" style="min-height: 100px; border-color: #cb0c9f !important;">
                                        <label for="vehicle_type_id" class="text-xxs font-weight-bold text-secondary text-uppercase d-block mb-1">Pilih Jenis Kendaraan</label>
                                        <select name="vehicle_type_id" id="vehicle_type_id" class="form-select border-0 font-weight-bolder text-dark p-0" style="font-size: 24px; outline: none; box-shadow: none;" required>
                                            <option value="">PILIH JENIS</option>
                                            @foreach($vehicleTypes as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Capacity checker dynamically -->
                            <div class="row mt-2">
                                <div class="col-12 text-center">
                                    <span class="text-xs text-secondary font-weight-bold">
                                        Kapasitas Tersedia: <strong class="text-primary" id="entryCapacityText">-</strong>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        
        // 1. DYNAMIC DIGITAL CLOCK
        function updateClock() {
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            
            const now = new Date();
            const dayName = days[now.getDay()];
            const dateNum = now.getDate();
            const monthName = months[now.getMonth()];
            const yearNum = now.getFullYear();
            
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            
            $('#clockDay').text(dayName);
            $('#clockDate').text(dateNum + ' ' + monthName + ' ' + yearNum);
            $('#clockTime').text(hours + ' : ' + minutes + ' : ' + seconds);
        }
        
        setInterval(updateClock, 1000);
        updateClock(); // Run instantly on load

        // 2. AJAX Exit Form Details
        $('#transaction_id').on('change', function() {
            const id = $(this).val();
            if (id) {
                $.ajax({
                    url: "/tickets/" + id + "/details",
                    method: 'GET',
                    success: function(response) {
                        $('#exit_location').val(response.location);
                        $('#exit_vehicle_type').val(response.vehicle_type);
                        $('#exit_entry_time').val(response.entry_time);
                        
                        // Show active ticket metadata preview bar
                        $('#exit_info_location').text(response.location);
                        $('#exit_info_vehicle_type').text(response.vehicle_type);
                        $('#exit_info_entry_time').text(response.entry_time);
                        $('#exit_ticket_info').removeClass('d-none');
                    },
                    error: function() {
                        $('#exit_location').val('');
                        $('#exit_vehicle_type').val('');
                        $('#exit_entry_time').val('');
                        $('#exit_ticket_info').addClass('d-none');
                    }
                });
            } else {
                $('#exit_location').val('');
                $('#exit_vehicle_type').val('');
                $('#exit_entry_time').val('');
                $('#exit_ticket_info').addClass('d-none');
            }
        });

        // 3. AJAX Enter Form Capacity Check
        function checkEnterCapacity() {
            const locationId = $('#location_id').val();
            const vehicleTypeId = $('#vehicle_type_id').val();

            if (locationId && vehicleTypeId) {
                $.ajax({
                    url: "{{ route('transactions.check-capacity') }}",
                    method: 'GET',
                    data: {
                        location_id: locationId,
                        vehicle_type_id: vehicleTypeId
                    },
                    success: function(response) {
                        $('#entryCapacityText').text(response.remaining + ' slot');
                    },
                    error: function() {
                        $('#entryCapacityText').text('-');
                    }
                });
            } else {
                $('#entryCapacityText').text('-');
            }
        }
        
        $('#location_id, #vehicle_type_id').on('change', checkEnterCapacity);

        // 4. Show SweetAlert output for exit fee calculations
        @if(session('exit_success'))
            Swal.fire({
                title: 'Transaksi Keluar Berhasil!',
                html: `
                    <div class="text-start p-3 bg-gray-100 border-radius-lg">
                        <p class="mb-2 text-xs"><strong>Nomor Tiket:</strong> {{ session('ticket_number') }}</p>
                        <p class="mb-2 text-xs"><strong>Total Lama Parkir:</strong> {{ session('duration') }} Jam</p>
                        <hr class="my-2 horizontal dark">
                        <h4 class="text-danger font-weight-bolder mb-0 text-center">Total Bayar: Rp {{ session('total_fee') }}</h4>
                    </div>
                `,
                icon: 'success',
                confirmButtonText: 'Selesai',
                confirmButtonColor: '#cb0c9f'
            });
        @endif
    });
</script>
@endsection
