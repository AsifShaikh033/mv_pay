@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Qr Code</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List</h4>
                            <!-- <button
                        class="btn btn-primary btn-round ms-auto"
                         id="addUtrButton"
                      >
                        <i class="fa fa-plus"></i>
                        Add QR Code
                      </button> -->
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>QR</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <body>
                                    @foreach($utr_pay as $data)
                                    <tr>
                                        <td>
                                        @if($data->image)
                                        <?php //echo $data->image;die;?>
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                        </td>
                                        <td>
                                     @if($data->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.editUtr', $data->id) }}" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- <button type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-id="{{ $data->id }}"
                                                        class="btn btn-link btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button> -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD QR MODEL -->
<div class="modal fade" id="addUtrModal" tabindex="-1" aria-labelledby="addUtrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.storeUtr') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUtrModalLabel">Add QR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="utrImage" class="form-label">QR Code Image</label>
                        <input type="file" name="image" id="utrImage" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this QR Code? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="{{ route('admin.utr_delete') }}" style="display:inline;">
                            @csrf
                            @method('DELETE') 
                            <input type="hidden" name="id" id="utr_id"> 
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
  
    $(document).ready(function() {
        $('#deleteModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('id'); 
            $(this).find('#banner_id').val(userId); 
        });
        $('#addUtrButton').on('click', function () {
            $('#addUtrModal').modal('show'); 
        });
    });
</script>
@endpush



@endsection

