@extends('Admin.layout')
@section('header')
{{trans('news.listedit')}}
@endsection
@section('content')
<link href="/src/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<script src="/src/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="/src/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
<script src="/src/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/src/ckfinder/ckfinder.js" type="text/javascript"></script>

<div class="col-lg-12">
    <h1 class="page-header">{{trans('news.listedit')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.news.list.update',$item['id'])}}" method="POST" class="form-horizontal" role="form">
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
                        <label class="control-label col-sm-3">{{trans('news.listname')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtName" value="{{$item['name']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listparent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="selectParent">
                                @foreach($category as $cate)
                                <option {{$item['category_id']==$cate['id']?'selected="selected"':''}} value="{{$cate['id']}}">{{$cate['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listavatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imagetxtAvatar"><img style="width:140px;" src="{{imageReset($item['avatar'])}}" alt="Hình ảnh" /></div>
                            <input type="hidden" class="form-control" name="txtAvatar" value="{{imageReset($item['avatar'])}}" />
                            <input onclick="selectFileWithCKFinder('txtAvatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listdescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtDescription" value="{{$item['description']}}" /></div>
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
                        <label class="control-label col-sm-3">{{trans('news.listorder')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtOrder" value="{{$item['orderby']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseotitle')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOTitle" value="{{$item['seotitle']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseokeyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOKeyword" value="{{$item['seokeywords']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseodescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEODescription" value="{{$item['seodescription']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtAlias" value="{{$item['alias']}}" /></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.liststatus')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="Y" {{$item['status']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="N" {{$item['status']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listnew')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdonew" value="Y" {{$item['new']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdonew" value="N" {{$item['new']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listhot')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdohot" value="Y" {{$item['hot']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdohot" value="N" {{$item['hot']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listfeature')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdofeature" value="Y" {{$item['feature']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdofeature" value="N" {{$item['feature']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('news.listdetail')}}</label>
                <textarea name="txtDetail" id="txtDetail"><?= $item['detail'] ?></textarea>
                <script>CKEDITOR.replace('txtDetail');</script>
            </div>
        </div>

        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.news.list.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection