@extends('app')
@section('content')

    <!-- ================Add a fund ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Direct Fund</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('funds.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class = "col-12">
                            <div class="form-group">
                                    <label>Enter Amount </label>
                                <input type="number" min="10000"class="form-control @error('DirectAmount') is-invalid @enderror" value = "{{ old('DirectAmount') }}" name="DirectAmount" placeholder="Amount" required>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('DirectAmount') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Add Direct Fund</button>
                </form>
            </div>
        </div>
    <!--=============End of add a direct fund=========-->

    <!--=============Add a donation=================-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Add a Donation</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('funds.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class = "col-12">
                            <div class="form-group">
                                    <label>Enter Amount </label>
                                <input type="number" min = "1000" class="form-control @error('Amount') is-invalid @enderror" value = "{{ old('Amount') }}" name="Donation" placeholder="Amount" required>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('Amount') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class = "col-12">
                            <div class="form-group">
                                    <label>Select Donor </label>
                                    <select name="donor" id="donor" class="form-control select2bs4 @error('donor') is-invalid @enderror" style="width: 100%;" required>
                                        <option value = "0">Select Donor</option>
                                        @foreach($donors as $donor)
                                            @if (old('donor') == $donor->id)
                                                <option value="{{ $donor->id }}" selected>{{ $donor->firstName  }} {{ $donor->lastName }} </option>
                                            @else
                                                <option value="{{ $donor->id }}">{{ $donor->firstName }}  {{ $donor->lastName }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('Amount') <span>{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Add Donation</button>
                </form>
            </div>
        </div>
    <!--==========End Add a donation ===================-->



    <!-- ========================Display Table =================== --->
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
                                    <td>Fund Id</td>
                                    <td>Amount </td>
                                    <td>Donor </td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($funds as $fund)
                                    <tr>
                                        <td>{{$fund->id}}</td>

                                        <td>{{ $fund->amountPaid }}</td>

                                        @if($fund->donor)
                                            <td><a href="/donors/{{ $fund->donor_id }}">  {{ $fund->donor->firstName }} {{$fund->donor->lastName}} </a></td>
                                        @else
                                            <td>Direct Amount</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('funds.edit', $fund->id) }}" class="btn btn-sm btn-primary" title = "Edit Fund"><i class="fa fa-edit"></i></a>

                                            <a href="{{ route('funds.delete', $fund->id) }}" class="btn btn-sm btn-danger" title = "Delete Fund"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!--==================End of Display Table====================-->

@endsection
