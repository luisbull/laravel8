@extends('admin.admin_master')
@section('admin')
    

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Edit Service</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('service.update', $homeService->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="serviceIcon">Service Icon</label>
                <input type="text" name="icon" class="form-control" id="serviceIcon" placeholder="Enter icon" value="{{ $homeService->service_icon}}">
                @error('icon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input class="form-control" name="name" id="serviceName" rows="3" placeholder="Enter service name" value="{{ $homeService->service_name }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="serviceDescription">Service Description</label>
                <textarea class="form-control" name="description" id="serviceDescription" rows="3" placeholder="Enter service description">{{ $homeService->service_description}}</textarea>
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