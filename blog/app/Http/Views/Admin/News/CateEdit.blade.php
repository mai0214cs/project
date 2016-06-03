@extends('Admin.layout')
@section('header')
{{trans('admin.PageEditCategoryNews')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageEditCategoryNews')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.news.category.update',$item['id'])}}" method="POST" class="form-horizontal" role="form">
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
                        <div class="col-sm-9">
                            <input class="form-control" name="title" value="{{$item['title']}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_page">
                                <option value="0">{{trans('admin.noselect')}}</option>
                                @foreach($menu as $m)
                                <option {{$item['id_page']==$m['id']?'selected="selected"':''}} value="{{$m['id']}}">{{$m['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.avatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imageavatar"><img style="width:100px;" src="{{imageReset($item['avatar'])}}" alt="Hình ảnh" /></div>
                            <input type="hidden" class="form-control" name="avatar" value="{{imageReset($item['avatar'])}}" />
                            <input onclick="selectFileWithCKFinder('avatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.status')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="status" value="Yes" {{$item['status']=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="status" value="No" {{$item['status']=='No'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>
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
                    
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.news.category.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection