<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">

                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All Category</div>
                  <table class="table">
                      <thead>
                          <tr>
                          <th scope="col">#</th>
                          <th scope="col">Cagtegory Name</th>
                          <th scope="col">User</th>
                          <th scope="col">Created at</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach($categories as $category)
                        <tr>
                          <th>{{ $i++ }}</th>
                          <td>{{ $category->category_name }}</td>
                          <td>{{ $category->user_id }}</td>
                          <td>
                            @if($category->created_at == NULL)
                            <span class="text-danger">No Date Set</span>
                            @else
                            <!-- $category->created_at->diffForHumans() </td>  using Eloquent - put inside double curly brackets all content inside <td></td> -->
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td> <!-- using Query Builder -->
                            @endif
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">

                  <div class="card-header">Add Category</div>
                  <div class="card-body">
                    <form action="{{ route('store.category')}}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label for="categoryName" class="form-label">Category name</label>
                        <input type="text" name="category_name" class="form-control" id="categoryName" aria-describedby="CategoryName">
                        @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                  </div>
                  

                </div>
              </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
