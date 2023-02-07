<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Karchers</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Something to write</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Edit Employees</div>
            <div><a href="{{ route('karcher.index') }}" class="btn btn-primary">Back</a></div>
        </div>

        <form action="{{ route('karcher.update', $karcher->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">NAME</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Name" value="{{ old('name', $karcher->name) }}">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>


                    <div class="mb-3">
                        <br><br><label for="longitude" class="form-label">Longtitude</label><br>
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" placeholder="Enter Longitude" value="{{ old('longitude', $karcher->longitude) }}"><br>
                        @error('longitude')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="latitude" class="form-label">Latitude</label><br>
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" placeholder="Enter Latitude" value="{{ old('latitude', $karcher->latitude) }}"><br>
                        @error('latitude')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="address" class="form-label">ADDRESS</label><br>
                        <textarea name="address" id="address" rows="4" placeholder="Enter Address" class="form-control">{{ old('address', $karcher->address) }}</textarea><br>
                        @error('address')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="director" class="form-label">DIRECTOR</label><br>
                        <input type="text" class="form-control @error('director') is-invalid @enderror" name="director" id="director" placeholder="Enter Director" value="{{ old('director', $karcher->director) }}"><br>
                        @error('director')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <br><br><label for="phone" class="form-label">PHONE</label><br>
                        <label>
                            <input type="text" class="form-control border-white_light_1 rounded-8" placeholder="+998 (99) 999-99-99" value="{{old('phone',$karcher->phone)}}" >
                        </label>
                        @error('phone')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <br><label for="countPersons" class="form-label">countPersons</label><br>
                        <label>
                            <input type="text" class="form-control border-white_light_1 rounded-8" value="{{old('countPersons',$karcher->countPersons)}}" >
                        </label>
                        @error('countPersons')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

{{--                      <div class="mb-3">--}}
{{--                        <label for="image" class="form-label">Image</label>--}}
{{--                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">--}}
{{--                        @error('image')--}}
{{--                        <p class="invalid-feedback">{{ $message }}</p>--}}
{{--                        @enderror--}}
{{--                        <div class="pt-3">--}}
{{--                            @if ($employee->image != '' && file_exists(public_path().'/uploads/employees/'.$employee->image))--}}
{{--                            <img src="{{ url('/uploads/employees/'.$employee->image) }}" width="90px" height="90px" alt="" class="rounded">--}}
{{--                        @endif--}}
{{--                        </div>--}}

{{--                      </div>--}}

                </div>
            </div>

            <button type="submit" class="btn btn-primary my-3">Update Karcher</button>
        </form>

    </div>

</body>
</html>
