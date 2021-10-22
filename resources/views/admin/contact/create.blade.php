@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Contact</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('store.contact') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="contactAddress">Contact Address</label>
                <textarea class="form-control" name="address" id="contactAddress" rows="3" placeholder="Enter address"></textarea>
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="contactEmail">Contact Email</label>
                <input type="email" name="email" class="form-control" id="contactEmail" placeholder="Enter email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="contactPhone">Contact Phone</label>
                <input type="text" name="phone" class="form-control" id="contactPhone" rows="3" placeholder="Enter phone">
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                <a href="{{ route('home.contact') }}" class="btn btn-secondary btn-default">Cancel</a>
              </div>
          </form>
        </div>
      </div>
    </div>

@endsection