<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Karchers</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">List of Karchers</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Karchers</div>
            <div><a href="{{ route('karcher.create') }}" class="btn btn-primary">Create</a></div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}

            </div>
        @endif

        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>LONGITUDE</th>
                        <th>LATITUDE</th>
                        <th>ADDRESS</th>
                        <th>DIRECTOR</th>
                        <th>PHONE</th>
                        <th>COUNTPERSONS</th>
                    </tr>
                    @if ($karcher->isNotEmpty())
                    @foreach ($karcher as $k)
                    <tr valign="middle">
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->longitude }}</td>
                        <td>{{ $k->latitude }}</td>
                        <td>{{ $k->address }}</td>
                        <td>{{ $k->director }}</td>
                        <td>{{ $k->phone }}</td>
                        <td>{{ $k->countPersons }}</td>
                        <td>
                            <a href="{{ route('karcher.edit', $k->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <a href="#" onclick="deleteEmployee({{ $k->id }})" class="btn btn-outline-danger btn-sm">Delete</a>
                            <form id="employee-edit-action-{{ $k->id }}" action="{{ route('karcher.destroy',$k->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>

                    @endforeach

                    @else
                        <tr>
                            <td colspan="6">Record Not Found</td>
                        </tr>
                    @endif


                </table>
            </div>

            <div class="mx-2">
                {{ $karcher->links() }}
            </div>

        </div>



    </div>



</body>
</html>
<script>
    function deleteKarcher(id) {
        if(confirm("Are you sure you  want to delete?")) {
            document.getElementById('karcher-edit-action-'+id).submit();

        }

    }
</script>
