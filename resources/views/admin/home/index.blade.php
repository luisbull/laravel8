@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home About
            </h2>
        </x-slot>

        <div class="py-12">
            <!-- need to decide to use <div class="container">  OR below <div class="mx-2  mb-4 border-b"> -->
            <div class="mx-2  mb-4 border-b">
                <!-- ORIGINAL -->
                {{-- <div class="row">

                    <a href="{{ route('add.about') }}" class="text-right" rel="noopener noreferrer">
                        <button class="btn btn-info">Add About</button>
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
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->
                                    @foreach ($homeAbout as $about)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $homeAbout->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $about->title }}</td>
                                            <td>{{ $about->short_description }}</td>
                                            <td>{{ $about->long_description }}</td>
                                            <td>
                                                <a href="{{ route('about.edit', $about->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('about.delete', $about->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--  $homeAbout->links() -->
                        </div>
                    </div>

                </div> --}}
                <!-- END ORIGINAL -->

                <!-- GRID -->
                <div class="text-right mt-2">
                    <a href="{{ route('add.about') }}" class="btn btn-success">
                        New
                        <i class="fas fa-plus-square"></i>
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
                    <div
                        class="sm:col-span-2 md:col-span-2 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Title</div>
                    <div
                        class="sm:col-span-3 md:col-span-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Short Description</div>
                    <div
                        class="sm:col-span-5 md:col-span-5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Long Description</div>
                    <div
                        class="sm:col-span-2 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sm:text-center">
                        Action</div>
                </div>
                <!-- End Sort Options -->


                @php($i = 1)
                @foreach ($homeAbout as $about)
                    <div class="sm:bg-white sm:border">

                        <div class="flex flex-col sm:grid sm:grid-cols-12 py-2 divide-y divide-gray-200 sm:divide-none">
                            
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2">
                                <div class="rounded-tl-lg col-span-2 sm:hidden bg-blue-400 p-1">Title</div>
                                <div class="rounded-tr-lg col-span-6 sm:col-span-8 p-1 bg-white break-words px-3">{{ $about->title }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3 sm:mr-3">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-words">Short Description</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words px-3">{{ $about->short_description }}
                                </div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-5 md:col-span-5">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Long Description</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words text-justify px-3">{{ $about->long_description }}
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2 mb-2">
                                <div class="rounded-bl-lg col-span-2 sm:hidden bg-blue-400 p-1 flex">Action</div>
                                <div class="rounded-br-lg col-span-6 sm:col-span-8  bg-white">
                                    <div class="flex justify-evenly my-2">

                                        <a href="{{ route('about.edit', $about->id) }}"
                                            class="btn btn-info text-white">
                                            {{-- Edit --}}
                                            <i class="fas fa-edit "></i>
                                        </a>

                                        <a href="{{ route('about.delete', $about->id) }}"
                                            onclick="return confirm('Are you sure you want to delete?')"
                                            class="btn btn-danger">
                                            {{-- Delete --}}
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                <!-- $sliders->links() }} -->
                <!-- END GRID -->

            </div>

        </div>
        </div>

    </x-app-layout>
@endsection
