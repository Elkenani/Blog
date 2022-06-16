<x-admin-master>
    @section('content')
        <h1>Edit Role: {{$role->name}}</h1>
        @if(session()->has('role-updated'))
            <div class="alert alert-success">
                {{session('role-updated')}}
            </div>
        @endif
        <div class="col-sm-6">
        <form method="post" action="{{route('roles.update', $role->id)}}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="test" name="name" class="form-control" id="name" value="{{$role->name}}">
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
        </div>
    @endsection
</x-admin-master>