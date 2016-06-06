@extends('Admin.layout')
@section('header')
{{trans('admin.PageEditAttributeGroup')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageEditAttributeGroup')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif  
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.attributegroup.update', $item->id)}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.name')}}</label>
                <div class="col-sm-9"><input class="form-control" name="name" value="{{$item->name}}" /></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.type')}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="type">
                        @foreach($type as $items)
                        <option {{$item->type==$items?'selected="selected"':''}} value="{{$items}}">{{$items}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.order')}}</label>
                <div class="col-sm-9"><input class="form-control" name="order" value="{{$item->order}}" /></div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">{{trans('admin.status')}}</label>
                <div class="col-sm-9">
                    <label class="radio-inline">
                        <input name="status" value="Show" {{$item->status=='Show'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                    </label>
                    <label class="radio-inline">
                        <input name="status" value="Hide" {{$item->status=='Hide'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                    </label>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.product.attributegroup.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')
            @endsection