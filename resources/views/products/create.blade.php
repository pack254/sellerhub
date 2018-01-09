@extends('layouts.adminLTE')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ลงสินค้าใหม่</div>
                @if (\Session::has('success'))
                <div class="alert alert-success">
                  <p>{{ \Session::get('success') }}</p>
                </div><br />
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('products') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('productCode') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">รหัสสินค้า</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="productCode" value="{{ old('productCode') }}" required autofocus>

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
                                <input id="email" type="text" class="form-control" name="productName" value="{{ old('productName') }}" required>

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
                                <textarea id="password" type="password" rows="4" cols="50" class="form-control" name="productDetail" required></textarea>

                                @if ($errors->has('productDetail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('productDetail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('productImage') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">รูปภาพ</label>
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
                                <input id="password-confirm" type="text" class="form-control" name="productCostPrice" required>
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
                                <input id="password-confirm" type="text" class="form-control" name="productSalePrice" required>
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
                                <input id="password-confirm" type="text" class="form-control" name="productQuantity" required>
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
                                <button type="submit" class="btn btn-primary">
                                    ลงสินค้า
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
