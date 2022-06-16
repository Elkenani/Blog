<x-admin-master>
    @section('content')
        <h1> Profile for : {{$user->name}} </h1>

        <div class="row">
            <div>
                <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <img height="100px" class="img-profile rounded-circle" src="{{$user->avatar}}">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                    <div>
                        <label for="username">UserName:</label><br>
                        <input type="text" id="username" name="username" value="{{$user->username}}" class="form-control"><br>
                        @error('username')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control"><br>
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value="{{$user->email}}" class="form-control"><br>
                        @error('email')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>     
                    <div>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" class="form-control"><br>
                        @error('password')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>   
                    <div>
                        <label for="password-confirmation">Confirm Password:</label><br>
                        <input type="password" id="password-confirmaton" name="password_confirmation" class="form-control"><br>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>  
                    <button type="submit" class="btn btn-primary"> Submit </button>         
                </form>
            </div>
        </div>
        <br>
        <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Options</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Options</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($roles as $role)
                      <tr>
                        <td><input type="checkbox"
                            @foreach($user->roles as $user_role)
                                @if($user_role->slug == $role->slug)
                                    checked
                                @endif
                            @endforeach
                        ></td>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td>
                            <form method="post" action="{{route('user.role.attach', $user)}}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-primary"
                                    @if($user->roles->contains($role))
                                        disabled
                                    @endif     
                                >
                                    Attach
                                </button>
                                <input type="hidden" name="role" value="{{$role->id}}">
                            </form>   
                        </td>
                        <td>
                            <form method="post" action="{{route('user.role.detach', $user)}}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger"
                                    @if(!$user->roles->contains($role))
                                        disabled
                                    @endif >
                                    Detach
                                </button>
                                <input type="hidden" name="role" value="{{$role->id}}">
                            </form> 
                            
                        </td>      
                      </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    @endsection
</x-admin-master>