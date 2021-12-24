@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Project
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

                  <div class="card-header">Edit Project</div>
                  <div class="card-body">
                    
                    <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $portfolio->image }}">
                        <div class="mb-3">
                          <img src="{{ asset('storage/'.$portfolio->image) }}" alt="" srcset="">
                          <label for="portfolioImage" class="form-label">Image</label>
                          <input type="file" name="portfolio_image" multiple="" class="form-control" id="portfolioImage" aria-describedby="PortfolioImage">
                          @error('portfolio_image')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="portfolioTitle" class="form-label">Title</label>
                          <input type="text" name="portfolio_title" multiple="" class="form-control" id="portfolioTitle" aria-describedby="portfolioTitle" value="{{ $portfolio->title }}">
                          @error('portfolio_title')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="portfolioCategory" class="form-label">Category</label>
                          <select class="form-control" id="portfolioCategory" name="portfolio_category" aria-describedby="portfolioCategory">
                            <option value="{{$portfolio->category}}" selected>{{$portfolio->category}}</option>
                            @foreach($categories_array as $category)
                              <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                          </select>
                          @error('portfolio_category')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                          <button type="submit" class="btn btn-primary">Update project</button>
                          <a href="{{ route('all.multiImage') }}" class="btn btn-secondary btn-default">Cancel</a>
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