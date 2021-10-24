@extends('admin.admin_master')
@section('admin')

    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Create Message</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('store.message') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group">
                <label for="messageName">Message Name</label>
                <input type="text" name="name" class="form-control" id="messageName" placeholder="Enter name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="messageEmail">Message Email</label>
                <input type="text" name="email" class="form-control" id="messageEmail" placeholder="Enter email">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="messageSubject">Message Subject</label>
                <input type="text" name="subject" class="form-control" id="messageSubject" rows="3" placeholder="Enter subject">
                @error('subject')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="messageText">Message Text</label>
                <textarea class="form-control" name="message" id="messageText" rows="3" placeholder="Enter message"></textarea>
                @error('message')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                <a href="{{ route('contact.message') }}" class="btn btn-secondary btn-default">Cancel</a>
              </div>
          </form>
        </div>
      </div>
    </div>

@endsection