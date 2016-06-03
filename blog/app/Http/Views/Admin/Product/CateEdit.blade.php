@extends('Admin.layout')
@section('header')
{{trans('product.cateedit')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('product.cateedit')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.category.update',$item['id'])}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="id" value="{{$item['id']}}" />



        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin chung</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.catename')}}</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="txtName" value="{{$item['name']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateparent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="selectParent">
                                <option value="0">Không lựa chọn</option>
                                @foreach($menu as $m)
                                <option {{$item['parent_id']==$m['id']?'selected="selected"':''}} value="{{$m['id']}}">{{$m['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateavatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imagetxtAvatar"><img style="width:100px;" src="{{imageReset($item['avatar'])}}" alt="Hình ảnh" /></div>
                            <input type="hidden" class="form-control" name="txtAvatar" value="{{imageReset($item['avatar'])}}" />
                            <input onclick="selectFileWithCKFinder('txtAvatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.catestatus')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="rdoStatus" value="Y" {{$item['status']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="N" {{$item['status']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin SEO</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateorder')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtOrder" value="{{$item['orderby']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateseotitle')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOTitle" value="{{$item['seotitle']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateseokeyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOKeyword" value="{{$item['seokeywords']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateseodescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEODescription" value="{{$item['seodescription']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtAlias" value="{{$item['alias']}}" /></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.product.category.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection