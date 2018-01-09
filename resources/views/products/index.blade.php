@extends('layouts.adminLTE')

@section('content')
  <div class="container">
  <br />
    <a href="{{ route('addProduct') }}" class="btn btn-success create-new-product">เพิ่มสินค้าใหม่</a>
    <div class="box">
      <div class="box-header">
      </div>
        <div class="box-body">
            <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                     <th class="text-center">ลำดับ</th>
                     <th class="text-center">ชื่อสินค้า</th>
                     <th class="text-center">รูปสินค้า</th>
                     <th class="text-center">ข้อมูลสินค้า</th>
                     <th class="text-center">ต้นทุน</th>
                     <th class="text-center">ราคาขาย</th>
                     <th class="text-center">จำนวนสินค้า</th>
                     <th class="text-center">แก้/ลบ ข้อมูล</th>
                  </tr>
              </thead>
              <tfoot>
                 <tr>
                   <th class="text-center">ลำดับ</th>
                   <th class="text-center">ชื่อสินค้า</th>
                   <th class="text-center">รูปสินค้า</th>
                   <th class="text-center">ข้อมูลสินค้า</th>
                   <th class="text-center">ต้นทุน</th>
                   <th class="text-center">ราคาขาย</th>
                   <th class="text-center">จำนวนสินค้า</th>
                   <th class="text-center">แก้/ลบ ข้อมูล</th>
                 </tr>
             </tfoot>
              <tbody>
              </tbody>
            </table>
          </div>
      </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-product">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">

              <div class="alert alert-success create-sucess" style="display:none">
              <p class="create-sucess"><i class="fa fa-check alert-success" aria-hidden="true"></i>  ข้อมูลลูกค้าถูกสร้างขึ้นเสร็จสมบูรณ์</p>
              </div>

              <div class="alert alert-success update-sucess" style="display:none">
              <p class="update-sucess"><i class="fa fa-check alert-success" aria-hidden="true"></i>  ข้อมูลลูกค้าถูกอัพเดทเสร็จสมบูรณ์</p>
              </div>

              <div class="alert alert-success delete-sucess" style="display:none">
              <p class="delete-sucess"><i class="fa fa-check alert-success" aria-hidden="true"></i> ข้อมูลลูกค้าถูกลบเสร็จสมบูรณ์</p>
              </div>

          <form class="form-horizontal" id="productForm" role="form">
              {{ csrf_field() }}

              <div class="form-group cus-id">
                <label class="control-label col-sm-2" for="id">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pid" name="pid" disabled>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2" for="fname">ชือสินค้า</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pname" name="pname">
                </div>
              </div>
              <p class="pname_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pCurrentImage">รูปสินค้าปัจจุบัน</label>
                <div class="col-sm-10 pimage">
                  <img src="">
                </div>
              </div>
              <p class="pimage_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="lname">อัพโหลดรูปใหม่</label>
                <div class="col-sm-10 pimage">
                  <input type="file" class="form-control" id="pphoto" name="pphoto" style="text-align:left;">
                </div>
              </div>
              <p class="pphoto_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pdetail">ข้อมูลสินค้า</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" id="pdetail" name="pdetail" rows="4" cols="50"></textarea>
                </div>
              </div>
              <p class="pdetail_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pcost">ราคาต้นทุน</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pcost"  name="pcost">
                </div>
              </div>
              <p class="pcost_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="psale">ราคาขาย</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="psale" name="psale">
                </div>
              </div>
              <p class="psale_error error text-center alert alert-danger hidden"></p>

              <div class="form-group">
                <label class="control-label col-sm-2" for="pquantity">จำนวนสินค้า</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="pquantity" name="pquantity">
                </div>
              </div>
              <p class="pquantity_error error text-center alert alert-danger hidden"></p>
          </form>

          <div class="deleteContent">
            คุณต้องการที่จะลบลูกค้าชื่อ <span class="dname"></span>  หรือไม่? <span
              class="hidden did"></span>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn actionBtn" data-dismiss="modal">
              <span id="footer_action_button" class='glyphicon'> </span>
            </button>
            <button type="button" class="btn btn-warning closel" data-dismiss="modal">
              <span class='glyphicon glyphicon-remove'></span> Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
