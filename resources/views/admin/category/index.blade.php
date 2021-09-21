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
                          <th scope="col">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <!-- @php($i = 1) If using pagination this won't work perfectly -->
                        @foreach($categories as $category)
                        <tr>
                          <!-- <th>{{ $i++ }}</th> If using pagination this won't work perfectly - It would start from 1 again when changing page -->
                          <th>{{ $categories->firstItem()+$loop->index }}</th> <!-- Prevent pagination to start again from 1 when click next page -->
                          <td>{{ $category->category_name }}</td>
                          <!-- <td>{{ $category->user_id }}</td> read commment from line below -->
                          <td> {{$category->user->name}} </td> <!-- using Eloquent - using the table relation created in Model/Category.php to use UserName instead UserID -->
                          <!--<td>$category->name</td>  using Query Builder-->
                          <td>
                            @if($category->created_at == NULL)
                            <span class="text-danger">No Date Set</span>
                            @else
                            <!-- $category->created_at->diffForHumans() </td>  using Eloquent - put inside double curly brackets all content inside <td></td> -->
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                            @endif
                          </td> <!-- using Query Builder -->
                          <td>
                            <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                            <a href="" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                  {{ $categories->links()}}
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
