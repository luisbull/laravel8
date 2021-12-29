@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Category
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

                  <div class="card-header">New Category</div>
                  <div class="card-body">
                    
                    <form action="{{ route('portfolio.storeCategory') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                          <label for="portfolioCategory" class="form-label">Category</label>
                          <input type="text" name="portfolio_category" multiple="" class="form-control" id="portfolioCategory" aria-describedby="portfolioCategory" value="">
                          @error('portfolio_category')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                          <button type="submit" class="btn btn-primary">Create category</button>
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