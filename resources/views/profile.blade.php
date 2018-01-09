@extends('layouts.adminLTE')
@section('content')
<section class="content-header">
    <h1>
      Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Profile</a></li>
    </ol>
</section>
<section class="content" style="margin-top:20px">
    <img src="/upload/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
    <h2>{{ $user->name }}'s Profile</h2>
    <form enctype="multipart/form-data" action="/profile" method="POST">
        <label>Update Profile Image</label>
        <input type="file" name="avatar">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="pull-center btn btn-sm btn-primary" style="margin-left:420px;">
    </form>
</section>
@endsection
