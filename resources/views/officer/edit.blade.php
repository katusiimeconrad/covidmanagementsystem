@extends('app')
@section('content')
    <!-- ================EDIT OFFICER ===============-->
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
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value = "{{old('firstName',$officer->firstName)}}" placeholder="Enter First Name">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('firstName') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror" value = "{{old('lastName',$officer->lastName)}}" name="lastName" placeholder="Enter Last Name">
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
                                    @if (old('gender',$officer->genderName) == "Male")
                                        <option value="Male" selected>Male</option>
                                    @else
                                        <option value="Male">Male</option>
                                    @endif
                                    @if (old('gender',$officer->genderName) == "Female")
                                        <option value="Female" selected>Female</option>
                                    @else
                                        <option value="Female">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hospital</label>
                                <input type="text" class="form-control" value = "{{$officer->hospital->hospitalName}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-sm-6">
                            <label>Title</label>
                            <input type="text" class="form-control" value = "{{$officer->title}}" disabled>
                        </div>
                        <div class = "col-sm-6">
                            <label>No Of Treated</label>
                            <input type="text" class="form-control" value = "{{count($officer->patient)}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class = "col-sm-6">
                            <label>Status</label>
                            <input type="text" class="form-control" value = "{{$officer->status}}" disabled>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Edit Health Officer</button>
                </form>
            </div>
        </div>
    <!-- ==============END OF EDIT OFFICER===========-->

@endsection