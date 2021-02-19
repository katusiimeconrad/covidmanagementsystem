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
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Role</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                            @foreach( $this_month as $this_)
                                <tr>
                                    <td>{{$this_->id}}</td>
                                    <td>{{$this_->healthOfficer->firstName}} {{$this_->healthOfficer->lastName}}</td>
                                    <td>{{ number_format($this_->amount) }} </a></td>
                                    <td>{{$this_->healthOfficer->title}}</td>
                                    <td>{{$this_->time}}</td>
                                </tr>
                            @endforeach
                            @foreach( $other as $this_2)
                                <tr>
                                    <td>{{$this_2->id}}</td>
                                    <td>{{\App\Models\User::find($this_2->user_id)->name}}</td>
                                    <td>{{ number_format($this_2->amount) }} </a></td>
                                    <td>Admin</td>
                                    <td>{{$this_2->time}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

