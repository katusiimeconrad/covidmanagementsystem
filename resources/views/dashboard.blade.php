@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>

          <p>Confirmed Cases</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Deaths</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>44</h3>

          <p>Recovered</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <!-- Charts -->
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