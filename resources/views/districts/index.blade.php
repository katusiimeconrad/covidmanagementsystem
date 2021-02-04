@extends('app')
@section('content')

    <!-- ================CREATE DISTRICT ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">District Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('districts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>District Name</label>
                                <input type="text" class="form-control @error('districtName') is-invalid @enderror" name="districtName" placeholder="Enter District Name" value={{old('districtName')}}>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('districtName') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Region</label>
                                <select class="form-control @error('districtRegion') is-invalid @enderror" name = "districtRegion">
                                    <option value = "0">Select A Region</option>
                                    @if (old('districtRegion') == "East")
                                        <option value="East" selected>East</option>
                                    @else
                                        <option value="East">East</option>
                                    @endif
                                    @if (old('districtRegion') == "North")
                                        <option value="North" selected>North</option>
                                    @else
                                        <option value="North">North</option>
                                    @endif
                                    @if (old('districtRegion') == "Central")
                                        <option value="Central" selected>Central</option>
                                    @else
                                        <option value="Central">Central</option>
                                    @endif
                                    @if (old('districtRegion') == "west")
                                        <option value="West" selected>West</option>
                                    @else
                                        <option value="West">West</option>
                                    @endif
                                    @if (old('districtRegion') == "South")
                                        <option value="South" selected>South</option>
                                    @else
                                        <option value="South">South</option>
                                    @endif
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('districtRegion') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Add district</button>
                    
                </form>
            </div>
        </div>
    <!-- ==============END OF CREATE DISTRICT===========-->

    <div class="row">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">All Registered districts
                         
                    </h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>District ID</th>
                                <th>Name</th>
                                <th>No. Of Hospitals</th>
                                <th>No. Of Health Officers</th>
                                <th>No. Of Patients</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($districts as $district)
                                <tr>
                                    <td>{{$district->id}}</td>
                                    <td>{{$district->districtName}}</td>
                                    <td>{{count($district->hospital)}}</td>
                                        <!-- count officers in district -->
                                            @php($officers = 0)
                                            @foreach($district->hospital as $hospital)
                                                @php($officers = $officers + $hospital->officerNumber)
                                            @endforeach
                                        <!-- end of officer count -->    
                                    <td>{{$officers}}</td>
                                        <!-- count patients in district -->
                                            @php($patients = 0)
                                            @foreach($district->hospital as $hospital)
                                                @foreach($hospital->patient as $patient)
                                                    @php($patients++)
                                                @endforeach
                                            @endforeach    
                                        <!-- end of patient count -->
                                    <td>{{$patients}}</td>
                                    <td class = "text-center">
                                        <a href="{{ route('districts.edit', $district->id) }}" class="btn btn-sm btn-primary" title = "view district"><i class="fa fa-edit"></i></a>
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