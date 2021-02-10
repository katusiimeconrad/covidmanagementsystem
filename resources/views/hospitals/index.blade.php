@extends('app')
@section('content')

    <!-- ================CREATE HOSPITAL ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Hospital Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('hospitals.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control @error('hospitalName') is-invalid @enderror" value = "{{ old('hospitalName')}}" name="hospitalName" placeholder="Enter Hospital Name">
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('hospitalName') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hopital Type</label>
                                <select class="form-control @error('hospitalType') is-invalid @enderror" name = "hospitalType">
                                    <option value = "0">Select A Hospital Type</option>
                                    @if (old('hospitalType') == "General")
                                        <option value="General" selected>General</option>
                                    @else
                                        <option value="General">General</option>
                                    @endif
                                    @if (old('hospitalType') == "Regional Referral")
                                        <option value="Regional Referral" selected>Regional Referral</option>
                                    @else
                                        <option value="Regional Referral">Regional Referral</option>
                                    @endif
                                    @if (old('hospitalType') == "National Referral")
                                        <option value="National Referral" selected>National Referral</option>
                                    @else
                                        <option value="National Referral">National Referral</option>
                                    @endif
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('hospitalType') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-12">
                            <div class="form-group">
                                <label class="control-label" for="district_id">District:</label>
                                <select name="district_id" id="district_id" class="form-control select2bs4 @error('district_id') is-invalid @enderror" style="width: 100%;">
                                    <option value = "0">Select A District</option> 
                                    @foreach($districts as $district)
                                        @if (old('district_id') == $district->id)
                                            <option value="{{ $district->id }}" selected>{{$district->districtName }}</option>
                                        @else
                                            <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback active">
                                    <i class="fa fa-exclamation-circle fa-fw"></i> @error('district_id') <span>{{ $message }}</span> @enderror
                                </div>
                            </div>     
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Add Hospital</button>
                    
                </form>
            </div>
        </div>
    <!-- ==============END OF CREATE HOSPITAL===========-->

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
                                <th>Region</th>
                                <th>District</th>
                                <th>Hospital Type</th>
                                <th>No. Of Patients</th>
                                <th>No. Of Health Officers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <td>{{$hospital->id}}</td>
                                    <td>{{$hospital->hospitalName}}</td>
                                    <td>{{$hospital->district->region}}</td>
                                    <td>{{$hospital->district->districtName}}</td>
                                    <td>{{$hospital->hospitalType}}</td>
                                    <td>{{count($hospital->patient)}}</td>
                                    <td>{{count($hospital->healthOfficer)}}</td>
                                    <td class = "text-center">
                                        <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-sm btn-primary" title = "Edit Hospital"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ==============END OF HOSPITAL LIST===========-->

    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Hospitals Heirarchical Structure</h3>
                </div>
                <div class="card-body" >
                    <ul id="tree-data" style="display:none">
                        <li id="root">
                            National Referral (Director)
                            <ul>
                                <li id="node1">
                                    Staff
                                </li>					
                                <li id="node2">
                                    Regional Referral (Head Officer)
                                    <ul>
                                        <li id="node3">
                                            Staff
                                        </li>
                                        <li id="node18" class="last">
                                            General Hospital (Head Officer)
                                            <ul>
                                                <li id="node19">
                                                    Staff
                                                </li>
                                                
                                                <li id="node20">
                                                    Covid-19 Health Officer
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            Senior Covid-19 Health officer
                                        </li>
                                    </ul>
                                </li>					
                                <li id="node21">
                                    Covid-19 Referral Superintendent
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                    <div id="tree-view"></div>		
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <!-- AREA CHART -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Area Chart</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
    
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
              <!-- BAR CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Bar Chart</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col (RIGHT) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

  
@endsection