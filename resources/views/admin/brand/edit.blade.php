@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="py-12">
        <div class="container">
            <div class="row">
              
              <div class="col-md-4">
                <div class="card">

                  <div class="card-header">Edit Brand</div>
                  <div class="card-body">
                    <form action="{{ route('brand.update', $brands->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                      <div class="mb-3">
                        <label for="brandName" class="form-label">Update Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brandName" aria-describedby="BrandName" value="{{ $brands->brand_name }}">
                        @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="brandImage" class="form-label">Update Brand Image</label>
                        <input type="file" name="brand_image" class="form-control" id="brandImage" aria-describedby="BrandImage" value="{{ $brands->brand_image }}">
                        @error('brand_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <img src="{{ asset('storage/'.$brands->brand_image) }}" alt="" srcset="">
                        
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <a href="{{ route('all.brand') }}" class="btn btn-secondary btn-default">Cancel</a>
                      </div>
                    </form>
                  </div>
                  

                </div>
              </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
@endsection