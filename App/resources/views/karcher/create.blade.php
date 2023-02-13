@extends('layout.app')
@section('content')
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">List of Karchers</div>
        </div>
    </div>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Karcher</div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Karchers</div>
            <div><a href="{{ route('karcher.index') }}" class="btn btn-primary">Back</a></div>
        </div>

        <form action="{{ route('karcher.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card border-0 shadow-lg">
                <div class="card-body">

                    <div class="mb-3">
                        <br><br><label for="name" class="form-label">NAME</label><br>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter Name" value="{{ old('name') }}"><br>
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>

                    <div class="mb-3">
                        <br><br><label for="longitude" class="form-label">Longtitude</label><br>
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="longitude" placeholder="Enter Longitude" value="{{ old('longitude') }}"><br>
                        @error('longitude')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="latitude" class="form-label">Latitude</label><br>
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="latitude" placeholder="Enter Latitude" value="{{ old('latitude') }}"><br>
                        @error('latitude')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="address" class="form-label">ADDRESS</label><br>
                        <textarea name="address" id="address" rows="4" placeholder="Enter Address" class="form-control"></textarea><br>
                        @error('address')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <br><br><label for="director" class="form-label">DIRECTOR</label><br>
                        <input type="text" class="form-control @error('director') is-invalid @enderror" name="director" id="director" placeholder="Enter Director" value="{{ old('director') }}"><br>
                        @error('director')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <br><br><label for="phone" class="form-label">PHONE</label><br>
                        <label>
                            <input name="phone" type="text" class="form-control border-white_light_1 rounded-8" placeholder="+998 (99) 999-99-99">
                        </label>
                        @error('phone')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <br><label for="countPersons" class="form-label">countPersons</label><br>
                        <label>
                            <input name="countPersons" type="text" class="form-control border-white_light_1 rounded-8" placeholder="1" >
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
{{--                      </div>--}}

                </div>
            </div>

            <button type="submit" class="btn btn-primary my-3">Save Karcher</button>
        </form>

    </div>

</body>
@endsection
