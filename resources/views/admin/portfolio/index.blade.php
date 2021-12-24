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

                  <div class="card-header">About Data</div>
                  <table class="table">
                      <thead>
                          <tr>
                          <th scope="col" width="5%">#</th>
                          <th scope="col" width="15%">About Title</th>
                          <th scope="col" width="15%">Category</th>
                          <th scope="col" width="35%">Image</th>
                          <th scope="col" width="15%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php($i = 1) <!--If using pagination this won't work perfectly -->
                        @foreach($allImages as $single_image)
                        <tr>
                          <th>{{ $i++ }}</th><!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                          <!--<th>2xcurly brackets $homeAbout->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                          <td>{{ $single_image->title }}</td>
                          <td>{{ $single_image->category }}</td>
                          <td><img src="{{ asset('storage/'.$single_image->image) }}" class="col-md-8" alt=""></td>
                          <td>
                            <a href="{{ route('portfolio.edit', $single_image->id) }}" class="btn btn-info col-md-12">Edit</a><br><br>
                            <a href="{{ route('portfolio.delete', $single_image->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger col-md-12">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <!--  $homeAbout->links() -->
                    

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

                <br><br>
                <div class="card">


                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">Categories</div>
                  <div class="ml-auto">
                    <button type="submit" class="btn btn-success">New</button>
                  </div>
                  <table class="table">
                      <thead>
                          <tr>
                          <th scope="col" width="15%">#</th>
                          <th scope="col" width="15%">Name</th>
                          <th scope="col" width="15%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php($i = 1) <!--If using pagination this won't work perfectly -->
                        @foreach($categories_array as $category)
                        <tr>
                          <th>{{ $i++ }}</th><!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                          <!--<th>2xcurly brackets $messageMessage->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                          <td>{{ $category }}</td>
                          <td>
                            <a href="{{ route('portfolio.edit', $single_image->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('portfolio.edit', $single_image->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <!--  $contactMessage->links() double brackets -->
                  

                </div>


              </div>

                
            </div>
        </div>
    </div>
    
</x-app-layout>
@endsection
