@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Slider</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="sliderTitle">Slider Title</label>
                <input type="text" name="title" class="form-control" id="sliderTitle" placeholder="Enter title">
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="sliderDescription">Slider Description</label>
                <textarea class="form-control" name="description" id="sliderDescription" rows="3" placeholder="Enter description"></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="sliderImage">Slider Image</label>
                <input type="file" name="image" class="form-control" id="sliderImage">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">
                  Submit
                  <i class="fas fa-upload"></i>
                </button>
                <a href="{{ route('home.slider') }}" class="btn btn-secondary btn-default">
                  Cancel
                  <i class="fas fa-undo"></i>
                </a>
              </div>
          </form>
        </div>
      </div>
    </div>

@endsection