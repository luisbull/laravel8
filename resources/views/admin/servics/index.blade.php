@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Services
            </h2>
        </x-slot>

        <div class="py-12">
            <!-- need to decide to use <div class="container">  OR below <div class="mx-2  mb-4 border-b"> -->
            <div class="mx-2  mb-4 border-b">
                <!-- ORIGINAL -->
                {{-- <div class="row">

                    <a href="{{ route('add.service') }}" class="text-right" rel="noopener noreferrer">
                        <button class="btn btn-info">Add Service</button>
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

                            <div class="card-header">Service Data</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">Service Icon</th>
                                        <th scope="col" width="35%">Service Name</th>
                                        <th scope="col" width="15%">Service Description</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->
                                    @foreach ($homeService as $service)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $homeService->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $service->service_icon }}</td>
                                            <td>{{ $service->service_name }}</td>
                                            <td>{{ $service->service_description }}</td>
                                            <td>
                                                <a href="{{ route('service.edit', $service->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('service.delete', $service->id) }}"
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
                <!-- ORIGINAL -->

                <!-- GRID -->
                <div class="text-right mt-2">
                    <a href="{{ route('add.service') }}" class="btn btn-success">
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
                        Icon</div>
                    <div
                        class="sm:col-span-3 md:col-span-3 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Name</div>
                    <div
                        class="sm:col-span-5 md:col-span-5 px-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Description</div>
                    <div
                        class="sm:col-span-2 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sm:text-center">
                        Action</div>
                </div>
                <!-- End Sort Options -->


                @php($i = 1)
                @foreach ($homeService as $service)
                    <div class="sm:bg-white sm:border">

                        <div class="flex flex-col sm:grid sm:grid-cols-12 py-2 divide-y divide-gray-200 sm:divide-none">

                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2">
                                <div class="rounded-tl-lg col-span-2 sm:hidden bg-blue-400 p-1">Icon</div>
                                <div class="rounded-tr-lg col-span-6 sm:col-span-8 p-1 bg-white break-words px-3">
                                    {{ $service->service_icon }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3 sm:mr-3">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-words">Name</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words px-3">
                                    {{ $service->service_name }}
                                </div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-5 md:col-span-5">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Description</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words text-justify px-3">
                                    {{ $service->service_description }}
                                </div>
                            </div>

                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2 mb-2">
                                <div class="rounded-bl-lg col-span-2 sm:hidden bg-blue-400 p-1 flex">Action</div>
                                <div class="rounded-br-lg col-span-6 sm:col-span-8  bg-white">
                                    <div class="flex justify-evenly my-2">

                                        <a href="{{ route('service.edit', $service->id) }}" class="btn btn-info text-white">
                                            {{-- Edit --}}
                                            <i class="fas fa-edit "></i>
                                        </a>

                                        <a href="{{ route('service.delete', $service->id) }}"
                                            onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
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

    </x-app-layout>
@endsection
