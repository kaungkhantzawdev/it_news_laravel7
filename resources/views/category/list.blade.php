<div class="">
    <table class="table mb-0 table-hover table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Owner</th>
            <th>Control</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Category::with("getUser")->get() as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->getUser->name }}</td>
                <td>
                    <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-primary">edit</a>
                    <form action="{{ route('category.destroy', $category->id) }}" class="d-inline-block" id="form{{ $category->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-sm btn-danger" onclick="return showAlert({{ $category->id }})">delete</button>
                    </form>
                </td>
                <td>
                    <small>
                        <i class="feather-calendar"></i>
                        {{ $category->created_at->format('d M Y') }}
                    </small>
                    <br>
                    <small>
                        <i class="feather-clock"></i>
                        {{ $category->created_at->format('h:i A') }}
                    </small>
                </td>
                <td>
                    <small>
                        <i class="feather-calendar"></i>
                        {{ $category->updated_at->format('d M Y') }}
                    </small>
                    <br>
                    <small>
                        <i class="feather-clock"></i>
                        {{ $category->updated_at->format('h:i A') }}
                    </small>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@section('foot')
    <script>
        function showAlert(id) {
            Swal.fire({
                title: 'Are you sure <br> to delete this category?',
                text: "Really Sure",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted',
                        'This Category is deleted',
                        'success'
                    );
                    setTimeout(function () {
                        $("#form"+id).submit();
                    }, 1500)
                }
            })
        }
    </script>
@endsection
