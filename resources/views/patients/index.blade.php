@extends('app')
@section('content')
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Hospital</th>
                    <th>Health Officer</th>
                    <th>District</th>
                    <th>Category</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{$patient->id}}</td>
                        <td>{{$patient->firstName}} {{$patient->lastName}}</td>
                        <td>{{$patient->healthOfficer->hospital->hospitalName}}</td>
                        <td>
                            {{$patient->healthOfficer->firstName}} 
                            {{$patient->healthOfficer->lastName}}
                        </td>
                        <td>{{$patient->healthOfficer->hospital->district->districtName}}</td>
                        <td>
                            @if ($patient->category == 'yes')
                                Symptomatic
                            @else
                                Assymptomatic
                            @endif
                        </td>
                        <td>{{$patient->genderName}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection