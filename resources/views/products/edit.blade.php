@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">อัพเดทข้อมูล สินค้า</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{action('ProductController@update', $id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">

                        <div class="form-group{{ $errors->has('productCode') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">รหัสสินค้า</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="productCode" value="{{ $product->product_code }}" required autofocus>

                                @if ($errors->has('productCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">ชื่อสินค้า</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="productName" value="{{ $product->product_name }}" required>

                                @if ($errors->has('productName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productDetail') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">รายระเอียดสินค้า</label>

                            <div class="col-md-6">
                                <textarea id="password" type="password" rows="4" cols="50" class="form-control" name="productDetail" required>{{ $product->product_detail }}</textarea>

                                @if ($errors->has('productDetail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productDetail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="password-confirm" class="col-md-4 control-label">รูปภาพสินค้า ปัจจุบัน</label>
                          <div  class="col-md-4"><img src="{{action('ProductController@showPicture', $product['product_id'])}}"></div>
                        </div>

                        <div class="form-group{{ $errors->has('productImage') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">อัพรูปภาพใหม่</label>
                            <div class="col-md-4">
                              <input class="file-image" type="file" id="form-file" name="productImage" class="" />

                              @if ($errors->has('productImage'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('productImage') }}</strong>
                                  </span>
                              @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productCostPrice') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">ราคาต้นทุน</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="productCostPrice" value="{{ $product->product_cost_price }}" required>
                                @if ($errors->has('productCostPrice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productCostPrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productSalePrice') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">ราคาขาย</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="productSalePrice" value="{{ $product->product_sale_price }}" required>
                                @if ($errors->has('productSalePrice'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productSalePrice') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productQuantity') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">จำนวนสิ้นค้า</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="productQuantity" value="{{ $product->product_quantity }}" required>
                                @if ($errors->has('productQuantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productQuantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="name" class="col-md-4 control-label">USER ID</label>

                          <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="userID" value="{{ Auth::user()->id }}" required autofocus>
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    อัพเดทข้อมูล สินค้า
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
