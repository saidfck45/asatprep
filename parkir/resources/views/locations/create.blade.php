@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Add Location</h6>
                <a href="{{ route('locations.index') }}" class="btn bg-gradient-secondary btn-sm mb-0">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="form-control-label">Location Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Gedung A" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="capacity_motor" class="form-control-label">Capacity Motor</label>
                            <input type="number" class="form-control @error('capacity_motor') is-invalid @enderror" id="capacity_motor" name="capacity_motor" value="{{ old('capacity_motor', 3) }}" min="0" required>
                            @error('capacity_motor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="capacity_car" class="form-control-label">Capacity Car</label>
                            <input type="number" class="form-control @error('capacity_car') is-invalid @enderror" id="capacity_car" name="capacity_car" value="{{ old('capacity_car', 3) }}" min="0" required>
                            @error('capacity_car')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="capacity_truck" class="form-control-label">Capacity Truck/Bus</label>
                            <input type="number" class="form-control @error('capacity_truck') is-invalid @enderror" id="capacity_truck" name="capacity_truck" value="{{ old('capacity_truck', 3) }}" min="0" required>
                            @error('capacity_truck')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn bg-gradient-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Location
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
