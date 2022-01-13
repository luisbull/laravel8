@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-10">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create About</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="sliderTitle">About Title</label>
                <input type="text" name="title" class="form-control" id="sliderTitle" placeholder="Enter title">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="AboutShortDescription">About Short Description</label>
                <textarea class="form-control" name="short_description" id="AboutShortDescription" rows="3" placeholder="Enter short description"></textarea>
                @error('short_description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="AboutLongDescription">About Long Description</label>
                <textarea class="form-control" name="long_description" id="AboutLongDescription" rows="3" placeholder="Enter long description"></textarea>
                @error('long_description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-footer pt-4  mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">
                  Submit
                  <i class="fas fa-upload"></i>
                </button>
                <a href="{{ route('home.about') }}" class="btn btn-secondary btn-default">
                  Cancel
                  <i class="fas fa-undo"></i>
                </a>
              </div>
          </form>
        </div>
      </div>
    </div>

@endsection