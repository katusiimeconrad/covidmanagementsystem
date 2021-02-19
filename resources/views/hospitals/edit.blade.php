@extends('app')

@section('content')
    <!-- ================EDIT HOSPITAL ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Hospital Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('hospitals.update') }}" method="POST">
                    @csrf
                    <input type = "hidden" value = "{{$hospital->id}}" name = "id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control @error('hospitalName') is-invalid @enderror" name="hospitalName" placeholder="Enter Hospital Name" value = "{{old('hospitalName',$hospital->hospitalName)}}">
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
                                    @if (old('hospitalType',$hospital->hospitalType) == "General")
                                        <option value="General" selected>General</option>
                                    @else
                                        <option value="General">General</option>
                                    @endif
                                    @if (old('hospitalType',$hospital->hospitalType) == "Regional Referral")
                                        <option value="Regional Referral" selected>Regional Referral</option>
                                    @else
                                        <option value="Regional Referral">Regional Referral</option>
                                    @endif
                                    @if (old('hospitalType',$hospital->hospitalType) == "National Referral")
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
                                        @if (old('district_id',$hospital->district_id) == $district->id)
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
                        <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Update Hospital</button>
                    
                </form>
            </div>
        </div>
    <!-- ==============END OF EDIT HOSPITAL===========-->

    <ul id="tree-data" style="display:none">
        <li id="root" class="nav-item">
            {{$hospital->hospitalName}}
            <ul type="vertical">
                <li>
                    {{'Supervisor'}}
                    <ul>
                    @foreach ($healthOfficers as $officer)
                        <li>{{$officer->firstName.' '.$officer->lastName}}</li>
                    @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <div id="tree-view"></div>
    
@endsection