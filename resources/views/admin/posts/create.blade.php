<x-admin-master>

    @section('content')
        <h1> Create a post </h1>
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
            <!--the name attribute in the input should be exactly the same as database column-->
            <div class="form-group">
                <label for="title"> Title </label>
                <input type="text" name="title" class="form-control" placeholder="enter title">
            </div>
            <div class="form-group">
                <label for="file"> File </label>
                <input type="file" name="post_image" class="form-control-file" placeholder="enter title">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Submit </button>


        </form>
    @endsection

</x-admin-master>