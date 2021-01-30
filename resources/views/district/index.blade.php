<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Districts</title>
</head>
<body>

    <ul>
        @foreach ($districts as $district)

            <li> {{ $district /*->districtName */ }} <li>

        @endforeach
    </ul>


    <hr>
    <div>
        <form action="districts" method="POST">
           {{ csrf_field() }}

            <h4>Enter New District</h4>
            <div class="form-group">
                <label>District Name : </label>
                <input type="text" placeholder="District Name" name="name">
            </div>

            <div class="form-group">
                <label>District Code</label>
                <input type="text" placeholder="Like KLA, WAK, GUL, MBRA" name="code">
            </div>
        <input type="submit" value="Add New District">

    </div>

    <div>
        <form action="districts" method="GET">
            @method('DELETE')
           {{ csrf_field() }}

           <h4>Enter District to Delete </h4>
           <div class="form-group">
               <label>District Name : </label>
               <input type="text" placeholder="District Name" name="name">
           </div>
        </form>
    </div>

    <div>
        <form action="{{route("district.show")}}" method="GET">
            {{ csrf_field() }}
            <h4>Search for a district </h4>
           <div class="form-group">
               <label>District Name : </label>
               <input type="text" placeholder="District Name" name="name">
           </div>
        </form>
    </div>








</body>
</html>



