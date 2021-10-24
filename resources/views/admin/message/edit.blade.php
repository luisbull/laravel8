@extends('admin.admin_master')
@section('admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Message
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session('success')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="py-12">
        <div class="container">
            <div class="row">
              
              <div class="col-md-6">
                <div class="card">

                  <div class="card-header">Edit Message</div>
                  <div class="card-body">
                    <form action="{{ url('message/update/'.$contactMessage->id) }}" method="POST">
                      @csrf
                      
                      <div class="mb-3">
                        <label for="messageName" class="form-label">Update Name</label>
                        <input type="text" name="name" class="form-control" id="messageName" aria-describedby="MessageName" value="{{ $contactMessage->name }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="messageEmail" class="form-label">Update Email</label>
                        <input type="email" name="email" class="form-control" id="messageEmail" aria-describedby="MessageName" value="{{ $contactMessage->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="messageSubject" class="form-label">Update Subject</label>
                        <input type="text" name="subject" class="form-control" id="messageSubject" aria-describedby="MessageSubject" value="{{ $contactMessage->subject }}">
                        @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="messageText" class="form-label">Update Text</label>
                        <textarea type="text" name="message" class="form-control" id="messageText" aria-describedby="MessageText">{{ $contactMessage->message }}</textarea>
                        @error('message')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      
                      
                      <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Update Message</button>
                        <a href="{{ route('contact.message') }}" class="btn btn-secondary btn-default">Cancel</a>
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