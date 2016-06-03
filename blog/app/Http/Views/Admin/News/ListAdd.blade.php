@extends('Admin.layout')
@section('header')
{{trans('news.listadd')}}
@endsection
@section('content')
<link href="/src/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<script src="/src/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="/src/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
<script src="/src/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/src/ckfinder/ckfinder.js" type="text/javascript"></script>

<div class="col-lg-12">
    <h1 class="page-header">{{trans('news.listadd')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.news.list.store')}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin chung</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listname')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtName" value="{{old('txtName')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listparent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="selectParent">
                                @foreach($category as $item)
                                <option {{old('selectParent')==$item['id']?'selected="selected"':''}} value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listavatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imagetxtAvatar"><img style="width: 140px;" src="/image.png" alt="Hình ảnh" /></div>
                            <input type="hidden" class="form-control" name="txtAvatar" value="{{old('txtAvatar')}}" />
                            <input onclick="selectFileWithCKFinder('txtAvatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listdescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtDescription" value="{{old('txtDescription')}}" /></div>
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
                        <div class="col-sm-9"><input class="form-control" name="txtOrder" value="{{old('txtOrder')==''?999:old('txtOrder')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseotitle')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOTitle" value="{{old('txtSEOTitle')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseokeyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOKeyword" value="{{old('txtSEOKeyword')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listseodescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEODescription" value="{{old('txtSEODescription')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtAlias" value="{{old('txtAlias')}}" /></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.liststatus')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" {{old('rdoStatus')==1?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" {{old('rdoStatus')==0?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listnew')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdonew" value="Y" {{old('rdonew')==1?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdonew" value="N" {{old('rdonew')==0?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listhot')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdohot" value="Y" {{old('rdohot')==1?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdohot" value="N" {{old('rdohot')==0?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('news.listfeature')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="rdofeature" value="Y" {{old('rdofeature')==1?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="rdofeature" value="N" {{old('rdofeature')==0?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('news.listdetail')}}</label>
                <textarea name="txtDetail" id="txtDetail"><?= old('txtDetail') ?></textarea>
                <script>CKEDITOR.replace('txtDetail');</script>
            </div>
        </div>

        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonAdd') ?></button>
        <a href="{{route('admin.news.list.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection