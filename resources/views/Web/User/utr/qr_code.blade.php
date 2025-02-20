@extends('Web.layout.main')

@section('content')
<div class="content-body">
<div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="m-auto">
                                <thead>
                                    <tr>
                                        <th>QR</th>
                                    </tr>
                                </thead>
                                <body>
                                    @foreach($utr_pay as $data)
                                    <tr>
                                        <td class="text-center">
                                        @if($data->image)
                                        <?php //echo $data->image;die;?>
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="Logo" class="img-fluid" height="" width="50%" style="margin-top: 100px;"/>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                    </div>
                    
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
