@extends('app')
@section('content')
    <!-- ================ EDIT DISTRICT ===============-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">District Update</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('districts.update') }}" method="POST">
                    @csrf
                    <input type = "hidden" value ="{{$district->id}}" name = "id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>District Name</label>
                            <input type="text" class="form-control @error('districtName') is-invalid @enderror" value = "{{old('districtName',$district->districtName)}}" name="districtName" placeholder="Enter District Name">
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
                                    @if (old('districtRegion',$district->region) == "East")
                                        <option value="East" selected>East</option>
                                    @else
                                        <option value="East">East</option>
                                    @endif
                                    @if (old('districtRegion',$district->region) == "North")
                                        <option value="North" selected>North</option>
                                    @else
                                        <option value="North">North</option>
                                    @endif
                                    @if (old('districtRegion',$district->region) == "Central")
                                        <option value="Central" selected>Central</option>
                                    @else
                                        <option value="Central">Central</option>
                                    @endif
                                    @if (old('districtRegion',$district->region) == "west")
                                        <option value="West" selected>West</option>
                                    @else
                                        <option value="West">West</option>
                                    @endif
                                    @if (old('districtRegion',$district->region) == "South")
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
                        <button type="submit" class="btn btn-info float-right" ><i class="fas fa-plus"></i> Update district</button>
                    
                </form>
            </div>
        </div>
    <!-- ==============END OF EDIT DISTRICT===========-->


    
@endsection