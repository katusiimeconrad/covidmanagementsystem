@extends('app')
@section('content')

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif

    @if(Session::has('fail'))
    <div class="alert alert-danger">
       {{Session::get('fail')}}
    </div>
    @endif

    <!-- FUNDS CARD -->
    <div class="col-12">
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $available_funds }}</h3>

                <p>Available Funds</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            </div>
        </div>
    </div>


    <div class="col-12">
    <!-- ================ MAKE A PAYMENT ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">MAKE PAYMENT</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <button type="submit" name="Make Payment">Make Payment</button>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('payment') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============== END OF MAKE PAYMENT ===========-->

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
                                    <td><a href="/payments/{{ $payment->id }}"> {{ $payment->amount }} </a></td>
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

