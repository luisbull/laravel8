@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit About
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
              
              <div class="col-md-6">
                <div class="card">

                  <div class="card-header">Edit Contact</div>
                  <div class="card-body">
                    <form action="{{ url('contact/update/'.$homeContact->id) }}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label for="contactAddress" class="form-label">Update Address</label>
                        <textarea type="text" name="address" class="form-control" id="contactAddress" aria-describedby="ContactAddress">{{ $homeContact->address }}</textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="contactEmail" class="form-label">Update Email</label>
                        <input type="email" name="email" class="form-control" id="contactEmail" aria-describedby="ContactEmail" value="{{ $homeContact->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="contactPhone" class="form-label">Update Phone</label>
                        <input type="text" name="phone" class="form-control" id="contactPhone" aria-describedby="ContactPhone" value="{{ $homeContact->phone }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      
                      <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update Contact</button>
                        <a href="{{ route('home.contact') }}" class="btn btn-secondary btn-default">Cancel</a>
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