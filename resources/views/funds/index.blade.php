@extends('app')
@section('content')

    <!-- ================Add a fund ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Fund</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('funds.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Enter Amount </label>
                                <input type="number" class="form-control @error('Amount') is-invalid @enderror" value = "{{ old('Amount') }}" name="amount" placeholder="Amount">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('Amount') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group-text">
                                    <label> Select a type  </label>
                                        <div class="input-group">
                                            <label>Direct</label>
                                        <input class="form-check-input" type="radio" name="Type" value="Direct" aria-selected="true">
                                        </div>

                                        <div class="input-group">
                                            <label>Donation</label>
                                        <input class="form-check-input" type="radio" name="Type" value="Donation" id="donationD">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <script>

                                $( "donationD" ).click(function() {
                                    alert("works!");
                                });

                        </script>
@endsection
