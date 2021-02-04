@extends('app')

@section('content')

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
            <li>
                Hey
            </li>
        </ul>
    </li>
    </ul>
    <div id="tree-view"></div>

@endsection