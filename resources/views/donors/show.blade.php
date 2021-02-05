@extends('app')
@section('content')

    <!-- ================ DONOR INFORMATION ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"> {{$donor->firstName}} {{$donor->lastName}} </h3>
            </div>
            <div class="card-body">

                    <div class="row">
                        <div>
                            <label> Gender </label>
                            <h3> {{ $donor -> gender }} </h3>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div>
                            <label> Total Donation </label>
                            <h3> {{ $donations->sum('amountPaid') }} </h3>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    <!-- ==============END OF ADD DONOR===========-->

    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">All Donors

                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Donnation Id</td>
                                <td>Amount</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->id }}</td>
                                    <td>{{ $donation->amountPaid }}</a></td>
                                    <td>{{ $donation->date_created  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
