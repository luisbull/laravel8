@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Slider
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

                  <div class="card-header">Edit Slider</div>
                  <div class="card-body">
                    <form action="{{ route('slider.update', $sliders->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                      <div class="mb-3">
                        <label for="sliderTitle" class="form-label">Update Slider Name</label>
                        <input type="text" name="slider_title" class="form-control" id="sliderTitle" aria-describedby="SliderTitle" value="{{ $sliders->title }}">
                        @error('slider_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="sliderDescription" class="form-label">Update Slider Name</label>
                        <input type="text" name="slider_description" class="form-control" id="sliderDescription" aria-describedby="SliderDescription" value="{{ $sliders->description }}">
                        @error('slider_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="sliderImage" class="form-label">Update Slider Image</label>
                        <input type="file" name="slider_image" class="form-control" id="sliderImage" aria-describedby="SliderImage" value="{{ $sliders->image }}">
                        @error('slider_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <img src="{{ asset('storage/'.$sliders->image) }}" alt="" srcset="">
                        
                      </div>
                      <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                        <a href="{{ route('home.slider') }}" class="btn btn-secondary btn-default">Cancel</a>
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