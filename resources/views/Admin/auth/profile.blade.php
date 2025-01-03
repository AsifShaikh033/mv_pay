@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">ADMIN PROFILE</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Details</div>
                        <!-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                    </div>
                    <form action="{{ route('admin.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label for="inlineinput" class="col-md-3 col-form-label">Name</label>
                                    <div>
                                        <input name="name" type="text" class="form-control input-full" id="inlineinput" placeholder="Enter Input" value="{{ $user->name }}" />
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email2">Email Address</label>
                                    <input name="email" type="email" class="form-control" id="email2" placeholder="Enter Email" value="{{ $user->email }}" />
                                    @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    <small id="emailHelp2" class="form-text text-muted">This is your Admin email address</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input  name="password" type="password" class="form-control" id="password" placeholder="Password" />
                              
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Profile</label>
                                    <div class="row">
                                        <div class="col-6 col-sm-4">
                                            <label class="imagecheck mb-4">
                                                <input name="image" type="file" value="1" class="imagecheck-input" />
                                                <figure class="imagecheck-figure">
                                                  <img src="{{ asset('storage/' . $user->image) }}" alt="title" class="avatar-img" />
                                                </figure>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                        
                    </div>
</from>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
