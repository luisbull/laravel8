@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Home About
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

              <a href="{{ route('add.about')}}" class="text-right" rel="noopener noreferrer">
                <button class="btn btn-info">Add About</button>  
              </a> <br><br>
              
              <div class="col-md-12">
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
                          <th scope="col" width="15%">Short Description</th>
                          <th scope="col" width="35%">Long Description</th>
                          <th scope="col" width="15%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                         @php($i = 1) <!--If using pagination this won't work perfectly -->
                        @foreach($homeAbout as $about)
                        <tr>
                           <th>{{ $i++ }}</th><!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                          <!--<th>2xcurly brackets $homeAbout->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                          <td>{{ $about->title }}</td>
                          <td>{{ $about->short_description }}</td>
                          <td>{{ $about->long_description }}</td>
                          <td>
                            <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  <!--  $homeAbout->links() -->
                </div>
              </div>

                
            </div>
        </div>
    </div>

</x-app-layout>
@endsection