@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Portfolio
            </h2>
        </x-slot>
        <!-- ORIGINAL -->
        {{-- <div class="py-12">
            <div class="container">
                <div class="row">

                    <div class="col-md-8">
                        <div class="card">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card-header">Projects</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col" width="15%">About Title</th>
                                        <!-- <th scope="col" width="15%">Cat_id</th> -->
                                        <th scope="col" width="15%">Category</th>
                                        <th scope="col" width="35%">Image</th>
                                        <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->


                                    @foreach ($allImages as $single_image)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $homeAbout->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $single_image->title }}</td>
                                            <!-- <td> $single_image->cat_id }}</td> -->
                                            <td>{{ $single_image->cat_name }}</td>
                                            <td><img src="{{ asset('storage/' . $single_image->image) }}"
                                                    class="col-md-8" alt=""></td>
                                            <td>
                                                <a href="{{ route('portfolio.edit', $single_image->id) }}"
                                                    class="btn btn-info col-md-12">Edit</a><br><br>
                                                <a href="{{ route('portfolio.delete', $single_image->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger col-md-12">Delete</a>
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
                                        <input type="file" name="image[]" multiple="" class="form-control" id="allImages"
                                            aria-describedby="AllImages">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="portfolioTitle" class="form-label">Title</label>
                                        <input type="text" name="portfolio_title" multiple="" class="form-control"
                                            id="portfolioTitle" aria-describedby="portfolioTitle">
                                        @error('portfolio_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="portfolioCategory" class="form-label">Category</label>
                                        <select class="form-control" id="portfolioCategory" name="portfolio_category"
                                            aria-describedby="portfolioCategory">
                                            <option value="" selected>Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <div class="card-header">Categories</div>
                            <div class="ml-auto">
                                <a href="{{ route('portfolio.addCategory') }}" class="btn btn-success">New</a>
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
                                    @php($i = 1)
                                    <!--If using pagination this won't work perfectly -->
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                            <!--<th>2xcurly brackets $messageMessage->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a href="{{ route('portfolio.editCategory', $category->id) }}"
                                                    class="btn btn-info">EditX</a>
                                                <a href="{{ route('portfolio.deleteCategory', $category->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger">Delete</a>
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
        </div> --}}
        <!-- END ORIGINAL -->

        {{-- GRID --}}
        {{-- <x-table> --}}
        <div class="mx-2  mb-4 border-b">
            {{-- <div class="text-right mt-2">
                <a href="" class="btn btn-success">
                    New
                    <i class="fas fa-plus-square"></i>
                </a> <br><br>
            </div> --}}

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="sm:grid sm:grid-cols-12">

                <div class="sm:grid sm:grid-cols-12 sm:col-span-8 sm:my-2">
                    <!-- Sort Options -->
                    <div class="hidden sm:grid sm:grid-cols-12 sm:col-span-12 sm:my-0 sm:bg-gray-100 sm:py-3 sm:border">
                        <div
                            class="sm:col-span-1 md:col-span-1 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            #</div>
                        <div
                            class="sm:col-span-2 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            title</div>
                        <div
                            class="sm:col-span-4 md:col-span-3 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            category</div>
                        <div
                            class="sm:col-span-4 md:col-span-4 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                            image</div>
                        <div
                            class="sm:col-span-1 md:col-span-2 text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer sm:text-center">
                            action</div>
                    </div>
                    <!-- End Sort Options --> 
    
                    @php($i = 1)
                    @foreach ($allImages as $single_image)
                    <div class="sm:bg-white sm:border sm:col-span-12">
    
                        <div class="flex flex-col sm:grid sm:grid-cols-12 py-2 divide-y divide-gray-200 sm:divide-none ">
                            <div class="grid grid-cols-8 sm:col-span-1 md:col-span-1">
                                <div class="rounded-tl-lg col-span-2 sm:hidden bg-blue-400 p-1">#</div>
                                <div class="rounded-tr-lg col-span-6 sm:col-span-8 p-1 bg-white">{{ $i++ }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1">title</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $single_image->title }}</div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-3 md:col-span-3">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1 break-all">Category</div>
                                <div class="col-span-6 sm:col-span-8 p-1 bg-white break-words">{{ $single_image->cat_name }}
                                </div>
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-4 md:col-span-4">
                                <div class="col-span-2 sm:hidden bg-blue-400 p-1">Image</div>
                                <img src="{{ asset('storage/' . $single_image->image) }}" class="col-span-6 sm:col-span-8" alt=""
                                    srcset="">
                            </div>
                            <div class="grid grid-cols-8 sm:col-span-2 md:col-span-2 mb-2">
                                <div class="rounded-bl-lg col-span-2 sm:hidden bg-blue-400 p-1 flex">Action</div>
                                <div class="rounded-br-lg col-span-6 sm:col-span-8  bg-white">
                                    <div class="flex justify-evenly my-2">
    
                                        <a href="{{ route('portfolio.edit', $single_image->id) }}" class="btn btn-info text-white">
                                            {{-- Edit --}}
                                            <i class="fas fa-edit "></i>
                                        </a>
    
                                        <a href="{{ route('portfolio.delete', $single_image->id) }}"
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

                <div class="sm:grid sm:grid-cols-12 sm:col-span-4 sm:my-2 sm:mx-3">

                     <!--NEW PROJECT-->
                    <div class="card sm:col-span-12">

                        <div class="card-header text-gray-500 uppercase">New Project</div>
                        <div class="card-body">
                            <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="allImages" class="form-label">Image</label>
                                    <input type="file" name="image[]" multiple="" class="form-control" id="allImages"
                                        aria-describedby="AllImages">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="portfolioTitle" class="form-label">Title</label>
                                    <input type="text" name="portfolio_title" multiple="" class="form-control"
                                        id="portfolioTitle" aria-describedby="portfolioTitle">
                                    @error('portfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="portfolioCategory" class="form-label">Category</label>
                                    <select class="form-control" id="portfolioCategory" name="portfolio_category"
                                        aria-describedby="portfolioCategory">
                                        <option value="" selected>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                    <!--END NEW PROJECT-->

                    <!--NEW CATEGORY-->
                    <br><br>
                    <div class="card sm:col-span-12">
                        <div class="card-header text-gray-500 uppercase">Categories</div>
                        <div class="ml-auto">
                            <a href="{{ route('portfolio.addCategory') }}" class="btn btn-success">New</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="15%">#</th>
                                    <th scope="col" width="15%">Name</th>
                                    <th scope="col" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                <!--If using pagination this won't work perfectly -->
                                @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <!-- If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                                        <!--<th>2xcurly brackets $messageMessage->firstItem()+$loop->index 2xcurly brackets</th>  Prevent pagination to start again from 1 when click next page -->
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('portfolio.editCategory', $category->id) }}"
                                                class="btn btn-info text-white">
                                                {{-- Edit --}}
                                                <i class="fas fa-edit "></i>
                                            </a>
                                            <a href="{{ route('portfolio.deleteCategory', $category->id) }}"
                                                onclick="return confirm('Are you sure you want to delete?')"
                                                class="btn btn-danger">
                                                {{-- Delete --}}
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--  $contactMessage->links() double brackets -->

                    </div>
                    <!--END NEW CATEGORY-->
                    
                </div>


            </div>

            


            


        </div>
        {{-- </x-table> --}}
        {{-- END GRID --}}

    </x-app-layout>
@endsection
