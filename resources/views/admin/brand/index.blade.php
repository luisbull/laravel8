@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
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

                  <div class="card-header">All Brand</div>
                  <table class="table">
                      <thead>
                          <tr>
                          <th scope="col">#</th>
                          <th scope="col">Brand Name</th>
                          <th scope="col">Brand Image</th>
                          <th scope="col">Created at</th>
                          <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <!-- @php($i = 1) If using pagination this won't work perfectly -->
                        @foreach($brands as $brand)
                        <tr>
                          <!-- <th>{{ $i++ }}</th> If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                          <th>{{ $brands->firstItem()+$loop->index }}</th> <!-- Prevent pagination to start again from 1 when click next page -->
                          <td>{{ $brand->brand_name }}</td>
                          <td> <img src="{{ asset('storage/'.$brand->brand_image) }}" style="height:40px; width:70px;" alt="" srcset=""> </td>
                          <td>
                            @if($brand->created_at == NULL)
                            <span class="text-danger">No Date Set</span>
                            @else
                            <!-- $brand->created_at->diffForHumans() </td>  using Eloquent - put inside double curly brackets all content inside <td></td> -->
                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                            @endif
                          </td> <!-- using Query Builder -->
                          <td>
                            <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('brand.delete', $brand->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{ $brands->links()}}
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-header">Add Brand</div>
                  <div class="card-body">
                    
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="brandName" class="form-label">Brand name</label>
                          <input type="text" name="brand_name" class="form-control" id="brandName" aria-describedby="BrandName">
                          @error('brand_name')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                          <label for="brandImage" class="form-label">Brand image</label>
                          <input type="file" name="brand_image" class="form-control" id="brandImage" aria-describedby="BrandImage">
                          @error('brand_image')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Brand</button>
                    </form>
                    
                  </div>
                  

                </div>
              </div>

                
            </div>
        </div>
    </div>

</x-app-layout>
@endsection