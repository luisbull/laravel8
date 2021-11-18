@extends('admin.admin_master')
@section('admin')

<div class="col-md-4">
    <div class="card">

      <div class="card-header">Edit Project</div>
      <div class="card-body">
        
      <form action="{{ route('store.images') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="old_image" value="{{ $portfolio->image }}">
          <div class="mb-3">
            <label for="allImages" class="form-label">Image</label>
            <input type="file" name="image[]" multiple="" class="form-control" id="allImages" aria-describedby="AllImages">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="portfolioTitle" class="form-label">Title</label>
            <input type="text" name="portfolio_title" multiple="" class="form-control" id="portfolioTitle" aria-describedby="portfolioTitle" value="{{ $portfolio->title }}">
            @error('portfolio_title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <label for="portfolioCategory" class="form-label">Category</label>
            <select class="form-control" id="portfolioCategory" name="portfolio_category" aria-describedby="portfolioCategory">
              <option value="{{$portfolio->category}}" selected>{{$portfolio->category}}</option>
              @foreach($categories_array as $category)
                <option value="{{ $category }}">{{ $category }}</option>
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
</div>

@endsection