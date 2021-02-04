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
            </tr>
        </thead>
        <tbody>
            @foreach($hospitals as $hospital)
                <tr>
                    <td>{{$hospital->id}}</td>
                    <td><a href="{{route('hospitals.edit',$hospital->id)}}">{{$hospital->hospitalName}}</a></td>
                    <td>{{$hospital->district->region}}</td>
                    <td>{{$hospital->district->districtName}}</td>
                    <td>{{$hospital->hospitalType}}</td>
                    <td>0</td>
                    <td>{{$hospital->officerNumber}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>