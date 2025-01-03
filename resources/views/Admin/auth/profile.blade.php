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
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label for="inlineinput" class="col-md-3 col-form-label">Name</label>
                                    <div>
                                        <input type="text" class="form-control input-full" id="inlineinput" placeholder="Enter Input" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email2">Email Address</label>
                                    <input type="email" class="form-control" id="email2" placeholder="Enter Email" value="{{ $user->email }}" />
                                    <small id="emailHelp2" class="form-text text-muted">This is your Admin email address</small>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Image Check</label>
                                    <div class="row">
                                        <div class="col-6 col-sm-4">
                                            <label class="imagecheck mb-4">
                                                <input name="imagecheck" type="checkbox" value="1" class="imagecheck-input" />
                                                <figure class="imagecheck-figure">
												@if($user->image && file_exists(public_path('storage/admin/profile/' . $user->image)))
    <img src="{{ asset('storage/admin/profile/' . $user->image) }}" alt="title" class="imagecheck-image" />
@else
<img src="{{ asset('storage/admin/profile/' . $user->image) }}" alt="title" class="imagecheck-image" />
@endif


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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
