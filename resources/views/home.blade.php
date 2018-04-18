@extends('layouts.adminLTE')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Examples</a></li>
    <li class="active">Pace page</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Small boxes (Stat box) -->
    <div class="row">
      <!-- ./col -->

      <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-aqua">
           <div class="inner">
             <h3>เพิ่มข้อมูลสินค้า</h3>

             <p>เพิ่มข้อมูลสินค้าใหม่</p>
           </div>
           <div class="icon">
             <i class="fa fa-shopping-cart"></i>
           </div>
           <a href="{{ route('productDashboard') }}" class="small-box-footer">
             คลิก <i class="fa fa-arrow-circle-right"></i>
           </a>
         </div>
       </div>
       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
         <!-- small box -->
         <div class="small-box bg-green">
           <div class="inner">
             <h3>รายรับ-รายจ่าย</h3>

             <p>ข้อมูลรายรับรายจ่าย</p>
           </div>
           <div class="icon">
             <i class="ion ion-stats-bars"></i>
           </div>
           <a href="#" class="small-box-footer">
             คลิก <i class="fa fa-arrow-circle-right"></i>
           </a>
         </div>
     </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>เพิ่มข้อมูลลูกค้า</h3>

            <p>เพิ่มข้อมูลลูกค้าใหม่</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ route('CustomerList') }}" class="small-box-footer">
            คลิก <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>สรุปข้อมูล </h3>

            <p>ข้อมูลการ ซื้อ - ขาย</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">
            คลิก <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </section>
@endsection
