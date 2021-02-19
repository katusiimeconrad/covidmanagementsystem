@extends('app')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">PAYMENTS

                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td><a href="/payments/{{ $payment->id }}"> {{ $payment->id }} </a> </td>
                                    <td><a href="/payments/{{ $payment->id }}"> {{ number_format($payment->amount) }} </a></td>
                                    <td>{{ $payment->date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

