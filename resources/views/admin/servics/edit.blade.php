@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Service
            </h2>
        </x-slot>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="py-12">
            <div class="container">
                <div class="row">

                    <div class="col-sm-10 col-md-8">
                        <div class="card">

                            <div class="card-header">Edit Service</div>
                            <div class="card-body">
                                <form action="{{ route('service.update', $homeService->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="serviceIcon">Service Icon</label>
                                        <input type="text" name="icon" class="form-control" id="serviceIcon"
                                            placeholder="Enter icon" value="{{ $homeService->service_icon }}">
                                        @error('icon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="serviceName">Service Name</label>
                                        <input class="form-control" name="name" id="serviceName" rows="3"
                                            placeholder="Enter service name" value="{{ $homeService->service_name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="serviceDescription">Service Description</label>
                                        <textarea rows="6" class="form-control" name="description" id="serviceDescription"
                                            rows="3"
                                            placeholder="Enter service description">{{ $homeService->service_description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                            <i class="fas fa-upload"></i>
                                        </button>
                                        <a href="{{ route('home.service') }}" class="btn btn-secondary">
                                            Cancel
                                            {{-- <i class="fas fa-window-close"></i> --}}
                                            <i class="fas fa-undo"></i>
                                        </a>
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
