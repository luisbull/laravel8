@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Sliders
            </h2>
        </x-slot>
        <!-- ORIGINAL -->
        {{-- <div class="py-12">
            <div class="container">
                <div class="row">

                    <a href="{{ route('add.slider') }}" class="text-right" rel="noopener noreferrer">
                        <button class="btn btn-info">Add Slider</button>
                    </a> <br><br>

                    <div class="col-md-12">
                        <div class="card">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card-header">Sliders</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">Title</th>
                                        <th scope="col" width="35%">Description</th>
                                        <th scope="col" width="15%">Image</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $sliders->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td> <img src="{{ asset('storage/' . $slider->image) }}" style="height:40px; width:70px;" alt="" srcset=""> </td>
                                            <td>
                                                <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('slider.delete', $slider->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--  $sliders->links() -->
                        </div>
                    </div>


                </div>
            </div>
        </div> --}}
        <!-- END ORIGINAL -->

        {{-- GRID --}}
        {{-- <x-table> --}}
        <div class="mx-2  mb-4 border-b">
          <div class="text-right mt-2">
            <a href="{{ route('add.slider') }}" class="btn btn-success">
                New
                <i  class="fas fa-plus-square"></i>
            </a> <br><br>
          </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Sort Options -->
                <div class="hidden sm:grid sm:grid-cols-12  sm:my-0 sm:bg-gray-100 sm:py-3 sm:border">
                    <div class="sm:col-span-1 md:col-span-1 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">#</div>
                    <div class="sm:col-span-2 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">title</div>
                    <div class="sm:col-span-4 md:col-span-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">description</div>
                    <div class="sm:col-span-4 md:col-span-4 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">image</div>
                    <div class="sm:col-span-1 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sm:text-center">action</div>
                </div>
                <!-- End Sort Options -->


                @php($i = 1)
                @foreach ($sliders as $slider)
                    <div class="sm:bg-white sm:border">

                        <div class="flex flex-col sm:grid sm:grid-cols-12 py-2 divide-y divide-gray-200 sm:divide-none ">
                            <div class="grid grid-cols-8 sm:col-span-1 md:col-span-1">
                                <div class="rounded-tl-lg col-span-2 sm:hidden bg-blue-400 p-1">#</div>
                                <div class="rounded-tr-lg col-span-6 sm:col-span-8 p-1 bg-white">{{ $i++ }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1">title</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $slider->title }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Description</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $slider->description }}
                                </div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-4 md:col-span-4">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1">Image</div>
                                <img src="{{ asset('storage/' . $slider->image) }}" class="col-span-6 sm:col-span-8" alt="" srcset="">
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2 mb-2">
                                <div class="rounded-bl-lg col-span-2 sm:hidden bg-blue-400 p-1 flex">Action</div>
                                <div class="rounded-br-lg col-span-6 sm:col-span-8  bg-white">
                                  <div class="flex justify-evenly my-2">

                                    <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info text-white">
                                      {{-- Edit --}}
                                      <i  class="fas fa-edit "></i>
                                    </a>

                                    <a href="{{ route('slider.delete', $slider->id) }}"
                                      onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
                                        {{-- Delete --}}
                                        <i  class="fas fa-trash-alt"></i>
                                    </a>
                                  </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                <!-- $sliders->links() }} -->


        </div>
        {{-- </x-table> --}}
        {{-- END GRID --}}

    </x-app-layout>
@endsection
