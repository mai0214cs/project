@extends('Admin.layout')
@section('header')
{{trans('admin.PageAddAttributeGroup')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageAddAttributeGroup')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif  
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.attributegroup.store')}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.name')}}</label>
                <div class="col-sm-9"><input class="form-control" name="name" value="{{old('name')}}" /></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.type')}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="type">
                        @foreach($type as $item)
                        <option {{old('type')==$item?'selected="selected"':''}} value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.order')}}</label>
                <div class="col-sm-9"><input class="form-control" name="order" value="{{old('order')==''?999:old('order')}}" /></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.status')}}</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input name="status" value="Show" {{in_array(old('status'),['Show',''])?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                    </label>
                    <label class="radio-inline">
                        <input name="status" value="Hide" {{old('status')=='Hide'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                    </label>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonAdd') ?></button>
        <a href="{{route('admin.product.attributegroup.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')
            @endsection