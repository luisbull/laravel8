@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home Contact
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="container">
                <div class="row">

                    <a href="{{ route('add.contact') }}" class="text-right" rel="noopener noreferrer">
                        <button class="btn btn-info">Add Contact</button>
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

                            <div class="card-header">Contact Data</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">Address</th>
                                        <th scope="col" width="35%">Email</th>
                                        <th scope="col" width="15%">Phone</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->
                                    @foreach ($homeContact as $contact)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $homeContact->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $contact->address }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>
                                                <a href="{{ route('contact.edit', $contact->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ route('contact.delete', $contact->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--  $homeContact->links() -->
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="mx-2  mb-4 border-b">
            <div class="text-right mt-2">
                <a href="{{ route('add.slider') }}" class="btn btn-success">
                    Add
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
                    class="sm:col-span-1 md:col-span-1 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    #</div>
                <div
                    class="sm:col-span-2 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    address</div>
                <div
                    class="sm:col-span-4 md:col-span-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    email</div>
                <div
                    class="sm:col-span-4 md:col-span-4 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                    phone</div>
                <div
                    class="sm:col-span-1 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sm:text-center">
                    action</div>
            </div>
            <!-- End Sort Options -->


            @php($i = 1)
            @foreach ($homeContact as $contact)
                <div class="sm:bg-white sm:border">

                    <div class="flex flex-col sm:grid sm:grid-cols-12 py-2 divide-y divide-gray-200 sm:divide-none ">
                        <div class="grid grid-cols-8 sm:col-span-1 md:col-span-1">
                            <div class="rounded-tl-lg col-span-2 sm:hidden bg-blue-400 p-1">#</div>
                            <div class="rounded-tr-lg col-span-6 sm:col-span-8 p-1 bg-white">{{ $i++ }}</div>
                        </div>
                        <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2">
                            <div class="col-span-2 sm:hidden bg-blue-400 p-1">Address</div>
                            <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $contact->address }}</div>
                        </div>
                        <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3">
                            <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Email</div>
                            <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $contact->email }}
                            </div>
                        </div>
                        <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3">
                            <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Phone</div>
                            <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $contact->phone }}
                            </div>
                        </div>
                        <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2 mb-2">
                            <div class="rounded-bl-lg col-span-2 sm:hidden bg-blue-400 p-1 flex">Action</div>
                            <div class="rounded-br-lg col-span-6 sm:col-span-8  bg-white">
                                <div class="flex justify-evenly my-2">

                                    <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-info text-white">
                                        {{-- Edit --}}
                                        <i class="fas fa-edit "></i>
                                    </a>

                                    <a href="{{ route('contact.delete', $contact->id) }}"
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


        </div>
        {{-- </x-table> --}}
        {{-- END GRID --}}

    </x-app-layout>
@endsection
