@extends('layouts.adminLTE')

@section('content')
  <div class="container">
        <br/>

          <div class="alert alert-success" style="display:none">
            <p>ข้อมูลลูกค้าถูก แก้ไขเรียบร้อยแล้ว</p>
          </div><br/>

          <h3 class="box-title" style="text-align:center">ข้อมูลลูกค้า</h3>
          <a class="btn btn-success create-new-product">เพิ่มลูกค้าใหม่</a>
            <div class="box">
              <div class="box-header">
              </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">ชื่อ</th>
                        <th class="text-center">นามสกุล</th>
                        <th class="text-center">ที่อยู่</th>
                        <th class="text-center">อีเมลล์</th>
                        <th class="text-center">เบอร์ติดต่อ</th>
                        <th class="text-center">แก้/ลบ ข้อมูล</th>
                      </tr>
                    </thead>
                    <tfoot>
                       <tr>
                         <th class="text-center">#</th>
                         <th class="text-center">ชื่อ</th>
                         <th class="text-center">นามสกุล</th>
                         <th class="text-center">ที่อยู่</th>
                         <th class="text-center">อีเมลล์</th>
                         <th class="text-center">เบอร์ติดต่อ</th>
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
    			<div class="modal-content">
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

  					<form class="form-horizontal" role="form">
                {{ csrf_field() }}

                <div class="form-group cus-id">
    							<label class="control-label col-sm-2" for="id">ID</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="fid" disabled>
    							</div>
    						</div>

                <div class="form-group">
    							<label class="control-label col-sm-2" for="fname">ชื่อ</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="fname">
    							</div>
    						</div>
                <p class="fname_error error text-center alert alert-danger hidden"></p>

                <div class="form-group">
    							<label class="control-label col-sm-2" for="lname">นามสกุล</label>
    							<div class="col-sm-10">
    								<span><input type="text" class="form-control" id="lname" style="text-align:left;"></span>
    							</div>
    						</div>
                <p class="lname_error error text-center alert alert-danger hidden"></p>

    						<div class="form-group">
    							<label class="control-label col-sm-2" for="address">ที่อยู่</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="address">
    							</div>
    						</div>
                <p class="address_error error text-center alert alert-danger hidden"></p>

    						<div class="form-group">
    							<label class="control-label col-sm-2" for="email">อีเมลล์</label>
    							<div class="col-sm-10">
    								<input type="email" class="form-control" id="email">
    							</div>
    						</div>
                <p class="email_error error text-center alert alert-danger hidden"></p>

    						<div class="form-group">
    							<label class="control-label col-sm-2" for="phone">เบอร์ติดต่อ</label>
    							<div class="col-sm-10">
    								<input type="text" class="form-control" id="phone">
    							</div>
    						</div>
                <p class="phone_error error text-center alert alert-danger hidden"></p>
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
