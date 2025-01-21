
@extends('Web.layout.main')

@section('content')

<div class="content-body">
    <div class="container py-4">
    <h2 class="text-light text-center mb-4">{{ $reportTitle }}</h2>

        @if($transactions->isEmpty())
            <p>No transactions found for this report.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-striped table-responsive">
                <thead>
                    <tr>
                       
                        <th>ID</th>
                        <th>Transaction Date</th>
                        <th>Amount</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                         @php
                        $i = 1;
                        @endphp
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{    $i++ }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->remark }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
