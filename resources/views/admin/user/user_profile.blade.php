@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Update Profile</h2>
        </div>

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{ session('error')}}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <span aria-hidden="true">&times;</span>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{ session('success')}}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
          <form action="{{ route('profile.update.dashboard') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="profileName">Profile Name</label>
                <input type="text" name="profile_name" class="form-control" id="profileName" placeholder="Profile name" value="{{ $userProfile->name }}">
                @error('profile_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="profileEmail">Profile Email</label>
                <input type="email" name="profile_email" class="form-control" id="profileEmail" placeholder="Profile email" value="{{ $userProfile->email }}">
                @error('profile_email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="profileImage">Profile Image</label>
                <input type="file" name="profile_image" class="form-control" id="profileImage"  value="{{ asset('storage/'.$userProfile->profile_photo_path) }}">
                @error('profile_image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="">
                <img src="{{ asset('storage/'.$userProfile->profile_photo_path) }}" class="w-25 p-3" alt="" srcset="">
              </div>

              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-default">Cancel</a>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection