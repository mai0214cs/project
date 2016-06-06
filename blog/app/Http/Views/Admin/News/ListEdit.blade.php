@extends('Admin.layout')
@section('header')
{{trans('admin.PageEditListNews')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageEditListNews')}}</h1>
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
                    <h3 class="panel-title">{{trans('admin.infocommon')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.name')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="title" value="{{$item['title']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_page">
                                @foreach($cate as $itemcate)
                                <option {{$item['id_page']==$itemcate['id']?'selected="selected"':''}} value="{{$itemcate['id']}}">{{$itemcate['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('news.listavatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imageavatar"><img style="width:140px;" src="{{imageReset($item['avatar'])}}" alt="{{$item['title']}}" /></div>
                            <input type="hidden" class="form-control" name="avatar" value="{{imageReset($item['avatar'])}}" />
                            <input onclick="selectFileWithCKFinder('avatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="description" value="{{$item['description']}}" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.infoseo')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.order')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="orderby" value="{{$item['orderby']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_title')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_title" value="{{$item['SEO_title']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_keyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_keyword" value="{{$item['SEO_keyword']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_description" value="{{$item['SEO_description']}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="alias" value="{{$item['alias']}}" /></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.status')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="status" value="Yes" {{$item['status']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="Nu" {{$item['status']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.new')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="new" value="Yes" {{$item['new']=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="No" {{$item['new']=='No'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.feature')}}</label>
                                <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input name="feature" value="Yes" {{$item['feature']=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                                </label>
                                <label class="radio-inline">
                                    <input name="feature" value="No" {{$item['feature']=='No'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
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
                <label>{{trans('admin.detail')}}</label>
                <textarea name="detail" id="txtDetail"><?= $item['detail'] ?></textarea>
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