@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">User Setting</h3>
            <ul class="breadcrumbs mb-3">
                <!-- <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li> -->
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">User Details</div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.updateUser', $Data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <!-- Web Title and Tagline -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="web_title">name</label>
                                        <input type="text" name="name" class="form-control" id="web_title" value="{{ $Data->name }}" placeholder="Enter Name" required>
                                        {{-- <small class="form-text text-muted">Web Title Name</small> --}}
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Last name </label>
                                        <input type="text" name="last_name" class="form-control" id="last_name " value="{{ $Data->last_name}}" placeholder="Enter last name ">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Email </label>
                                        <input type="text" name="email" class="form-control" id="email" value="{{ $Data->email }}" placeholder="Enter email " required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Balance </label>
                                        <input type="text" name="balance" class="form-control" id="balance " value="{{ $Data->balance }}" placeholder="Enter email " readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Mobile Number </label>
                                        <input type="number" name="mob_number" class="form-control" id="phone " value="{{ $Data->mob_number }}" placeholder="Enter Phone " required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Address </label>
                                        <input type="text" name="address" class="form-control" id="address " value="{{ $Data->address }}" placeholder="Enter Address " >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">City </label>
                                        <input type="text" name="city" class="form-control" id="city " value="{{ $Data->city}}" placeholder="Enter Address ">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="profile" class="form-control" id="profile">
                                        @if($Data->identity_image)
                                        <img src="{{ asset('storage/' . $Data->identity_image) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save</button>
                                {{-- <button type="reset" class="btn btn-danger">Reset</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
