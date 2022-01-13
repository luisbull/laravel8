@extends('admin.admin_master')
@section('admin')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit About
            </h2>
        </x-slot>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="py-12">
            <div class="container">
                <div class="row">

                    <div class="col-sm-10 col-md-8">
                        <div class="card">

                            <div class="card-header">Edit About</div>
                            <div class="card-body">
                                <form action="{{ route('about.update', $homeAbout->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="aboutTitle" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" id="aboutTitle"
                                            aria-describedby="Title" value="{{ $homeAbout->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="aboutShortDescription" class="form-label">Short Description</label>
                                        <textarea rows="3" type="text" name="short_description" class="form-control"
                                            id="aboutShortDescription"
                                            aria-describedby="ShortDescription">{{ $homeAbout->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="aboutLongDescription" class="form-label">Long Description</label>
                                        <textarea rows="6" type="text" name="long_description" class="form-control"
                                            id="aboutLongDescription"
                                            aria-describedby="LongDescription">{{ $homeAbout->long_description }}</textarea>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                            <i class="fas fa-upload"></i>
                                        </button>
                                        <a href="{{ route('home.about') }}" class="btn btn-secondary">
                                            Cancel
                                            {{-- <i class="fas fa-window-close"></i> --}}
                                            <i class="fas fa-undo"></i>
                                        </a>
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
