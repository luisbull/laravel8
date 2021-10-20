@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Service</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('store.service') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="serviceIcon">Service Icon</label>
                <input type="text" name="icon" class="form-control" id="serviceIcon" placeholder="Enter icon">
                @error('icon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input class="form-control" name="name" id="serviceName" rows="3" placeholder="Enter service name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="serviceDescription">Service Description</label>
                <textarea class="form-control" name="description" id="serviceDescription" rows="3" placeholder="Enter service description"></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                <a href="{{ route('home.service') }}" class="btn btn-secondary btn-default">Cancel</a>
              </div>
          </form>
        </div>
      </div>
    </div>

@endsection