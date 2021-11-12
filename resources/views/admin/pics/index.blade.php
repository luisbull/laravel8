@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Projects
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              
              <div class="col-md-8">
                <div class="card">

                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All Projects</div>
                  <div class="card-group">
                    <!-- <table class="table">
                    </table> -->
                    @foreach($allImages as $single_image)
                      <div class="col-md-4 mt-5">
                        <div class="card">
                          <div> {{ $single_image->title }} </div>
                          <div> {{ $single_image->category }} </div>
                          <img src="{{ asset('storage/'.$single_image->image) }}" alt="">
                          <div> {{ asset($single_image->id) }} </div><br>
                          <button type="submit" class="btn btn-info">Edit</button>
                          <a href="" class="btn btn-secondary btn-danger">Delete-logic pending</a>
                        </div>
                      </div>
                    @endforeach
                  </div>

                </div>
              </div>

              <div class="col-md-4">
                <div class="card">

                  <div class="card-header">New Project</div>
                  <div class="card-body">
                    
                  <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      
                      <div class="mb-3">
                        <label for="allImages" class="form-label">Image</label>
                        <input type="file" name="image[]" multiple="" class="form-control" id="allImages" aria-describedby="AllImages">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="portfolioTitle" class="form-label">Title</label>
                        <input type="text" name="portfolio_title" multiple="" class="form-control" id="portfolioTitle" aria-describedby="portfolioTitle">
                        @error('portfolio_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="portfolioCategory" class="form-label">Category</label>
                        <select class="form-control" id="portfolioCategory" name="portfolio_category" aria-describedby="portfolioCategory">
                          <option value="" selected>Select category</option>
                          @foreach($categories_array as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                          @endforeach
                        </select>
                        @error('portfolio_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <button type="submit" class="btn btn-primary">Add project</button>
                    </form>
                    
                  </div>
                  

                </div>
              </div>

                
            </div>
        </div>
    </div>
    
</x-app-layout>
@endsection
