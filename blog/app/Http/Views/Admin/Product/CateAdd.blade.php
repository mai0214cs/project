@extends('Admin.layout')
@section('header')
{{trans('admin.PageAddCategoryProduct')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageAddCategoryProduct')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.category.store')}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.infocommon')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.name')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="title" value="{{old('title')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_page">
                                <option value="0">{{trans('admin.noselect')}}</option>
                                @foreach($menu as $item)
                                <option {{old('id_category')==$item['id']?'selected="selected"':''}} value="{{$item['id']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>            
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.avatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imageavatar"><img style="width:100px;" src="{{imageReset('')}}" /></div>
                            <input type="hidden" class="form-control" name="avatar" value="{{imageReset(old('avatar'))}}" />
                            <button onclick="selectFileWithCKFinder('avatar')" type="button">{!!trans('admin.buttonImage')!!}</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.catestatus')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="status" value="Yes" {{old('status')=='Yes'||old('status')==NULL?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="status" value="No" {{old('status')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
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
                        <label class="control-label col-sm-3">{{trans('admin.SEO_title')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_title" value="{{old('SEO_title')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_keyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_keyword" value="{{old('SEO_keyword')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_description" value="{{old('SEO_description')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="alias" value="{{old('alias')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.order')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="orderby" value="{{old('orderby')==''?999:old('orderby')}}" /></div>
                    </div>   
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonAdd') ?></button>
        <a href="{{route('admin.product.category.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection