@extends('app')
@section('content')

    <!-- ================CREATE OFFICER ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Health Officer Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('officers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" placeholder="Enter First Name">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('firstName') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder="Enter Last Name">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('lastName') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-sm-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" name = "gender">
                                    <option value = "0">Select A Gender</option>
                                    @if (old('gender') == "Male")
                                        <option value="Male" selected>Male</option>
                                    @else
                                        <option value="Male">Male</option>
                                    @endif
                                    @if (old('gender') == "Female")
                                        <option value="Female" selected>Female</option>
                                    @else
                                        <option value="Female">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Add Health Officer</button>
                    
                </form>
            </div>
        </div>
    <!-- ==============END OF CREATE OFFICER===========-->

    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">All Registered Hospitals
                         
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Hospital ID</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Hospital</th>
                                <th>Status</th>
                                <th>No. Of Patients Treated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($healthOfficers as $officer)
                                <tr>
                                    <td>{{$officer->id}}</td>
                                    <td>{{$officer->firstName}} {{$officer->lastName}}</td>
                                    <td>{{$officer->title}}</td>
                                    @if($officer->hospital_id == 200)
                                        <td>Not assigned</td>
                                    @else
                                        <td>{{$officer->hospital->hospitalName}}</td>
                                    @endif
                                    <td>{{$officer->status}}</td>
                                    
                                    <td>{{count($officer->patient)}}</td>
                                    <td>
                                        <a href="{{ route('officers.edit', $officer->id) }}" class="btn btn-sm btn-primary" title = "Edit Officer"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
@endsection