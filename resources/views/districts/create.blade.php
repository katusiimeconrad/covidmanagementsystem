@extends('app')
@section('content')
    <form>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>District Name</label>
                    <input type="text" class="form-control is-invalid" placeholder="Enter ...">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Region</label>
                    <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
@endsection