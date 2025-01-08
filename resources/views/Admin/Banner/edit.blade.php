@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Banner Setting</h3>
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
                        <div class="card-title"> Details</div>
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
                      <form action="{{ route('admin.updatbanner', $Data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="logo">Banner</label>
                                        <input type="file" name="image" id="bannerImage" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                      
                                        @if($Data->image)
                                        <img src="{{ asset('storage/' . $Data->image) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <input type="number" name="priority" value="{{ $Data->priority}}" id="priority" class="form-control" min="0" max="10" placeholder="Enter priority">
                                </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" {{ $Data->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $Data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
