@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>Edit Vehicle Type</h6>
                <a href="{{ route('vehicle-types.index') }}" class="btn bg-gradient-secondary btn-sm mb-0">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('vehicle-types.update', $vehicleType->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name" class="form-control-label">Vehicle Type Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $vehicleType->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="perjam_pertama" class="form-control-label">Tarif Jam Pertama (Rp)</label>
                            <input type="number" class="form-control @error('perjam_pertama') is-invalid @enderror" id="perjam_pertama" name="perjam_pertama" value="{{ old('perjam_pertama', $vehicleType->perjam_pertama) }}" min="0" required>
                            @error('perjam_pertama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="perjam_berikutnya" class="form-control-label">Tarif Jam Berikutnya (Rp)</label>
                            <input type="number" class="form-control @error('perjam_berikutnya') is-invalid @enderror" id="perjam_berikutnya" name="perjam_berikutnya" value="{{ old('perjam_berikutnya', $vehicleType->perjam_berikutnya) }}" min="0" required>
                            @error('perjam_berikutnya')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="max_perhari" class="form-control-label">Batas Maksimal Perhari (Rp)</label>
                            <input type="number" class="form-control @error('max_perhari') is-invalid @enderror" id="max_perhari" name="max_perhari" value="{{ old('max_perhari', $vehicleType->max_perhari) }}" min="0" required>
                            @error('max_perhari')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn bg-gradient-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Update Vehicle Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
