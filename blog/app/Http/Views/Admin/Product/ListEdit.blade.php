@extends('Admin.layout')
@section('header')
{{trans('product.listedit')}}
@endsection
@section('content')
<link href="/src/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<script src="/src/fancybox/jquery.fancybox.js" type="text/javascript"></script>
<script src="/src/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
<script src="/src/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/src/ckfinder/ckfinder.js" type="text/javascript"></script>


@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<form action="{{route('admin.product.list.update',$item['id'])}}" method="POST" class="form-horizontal" role="form">
    <div class="col-lg-12">
        <h1 class="page-header">{{trans('product.listedit')}}</h1>
    </div>
    <div class="clearfix"></div>
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
                    <label class="control-label col-sm-3">{{trans('product.listname')}}</label><div class="col-sm-9">
                        <input class="form-control" name="txtName" value="{{$item['name']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listparent')}}</label><div class="col-sm-9">
                        <select class="form-control" name="selectParent">
                            @foreach($category as $cate)
                            <option {{$item['category_id']==$cate['id']?'selected="selected"':''}} value="{{$cate['id']}}">{{$cate['name']}}</option>
                            @endforeach
                        </select></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listavatar')}}</label><div class="col-sm-9">
                        <div class="imagetxtAvatar"><img style="width:100px;" src="{{imageReset($item['avatar'])}}" alt="Hình ảnh" /></div>
                        <input type="hidden" class="form-control" name="txtAvatar" value="{{imageReset($item['avatar'])}}" />
                        <input onclick="selectFileWithCKFinder('txtAvatar')" type="button" value="Chọn hình ảnh"></div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listdescription')}}</label><div class="col-sm-9">
                        <textarea class="form-control" name="txtDescription">{{$item['description']}}</textarea></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('product.listdetail')}}</label>
                <textarea name="txtDetail" id="txtDetail"><?= $item['detail'] ?></textarea>
                <script>CKEDITOR.replace('txtDetail');</script>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin chung</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listcode')}}</label><div class="col-sm-9">
                        <input class="form-control" name="txtCode" value="{{$item['code']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listprice')}}</label><div class="col-sm-9">
                        <input class="form-control" type="number" name="txtPrice" value="{{$item['price']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listpromotionprice')}}</label><div class="col-sm-9">
                        <input class="form-control" type="number" name="txtPromotionPrice" value="{{$item['promotionprice']}}" />
                    </div></div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listvat')}}</label><div class="col-sm-9">
                        <label class="radio-inline">
                            <input name="rdovat" value="Y" {{$item['includedvat']=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                        </label>
                        <label class="radio-inline">
                            <input name="rdovat" value="N" {{$item['includedvat']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                        </label></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listquantity')}}</label><div class="col-sm-9">
                        <input class="form-control" type="number" name="txtQuantity" min='0' value="{{$item['quantity']}}" />
                    </div></div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listwarranty')}}</label><div class="col-sm-9">
                        <input class="form-control" type="number" name="txtWarranty" min='0' max='100' value="{{$item['warranty']}}" />
                    </div></div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin SEO</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listorder')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="txtOrder" value="{{$item['orderby']}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listseotitle')}}</label>
                    <div class="col-sm-9">
                        <input class="form-control" name="txtSEOTitle" value="{{$item['seotitle']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listseokeyword')}}</label><div class="col-sm-9">
                        <input class="form-control" name="txtSEOKeyword" value="{{$item['seokeywords']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('product.listseodescription')}}</label><div class="col-sm-9">
                        <input class="form-control" name="txtSEODescription" value="{{$item['seodescription']}}" /></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">{{trans('admin.alias')}}</label><div class="col-sm-9">
                        <input class="form-control" name="txtAlias" value="{{$item['alias']}}" /></div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6">{{trans('product.liststatus')}}</label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="Y" {{$item['status']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="rdoStatus" value="N" {{$item['status']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-6">{{trans('product.listnew')}}</label>
                            <label class="radio-inline">
                                <input name="rdonew" value="Y" {{$item['new']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="rdonew" value="N" {{$item['new']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>
                    </div><div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6">{{trans('product.listhot')}}</label>
                            <label class="radio-inline">
                                <input name="rdohot" value="Y" {{$item['hot']=='Y'?'checked="checked"':''}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="rdohot" value="N" {{$item['hot']=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6">{{trans('product.listfeature')}}</label>
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
    <!-- /.col-lg-12 -->
    <div class="col-lg-7" style="padding-bottom:120px">











        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.product.list.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>

    </div>
    <form>
        @endsection
        @section('footer')

        <script>
            function selectFileWithCKFinder(elementname) {
                var element = $('[name="' + elementname + '"]');
                var image = $('.image' + elementname);
                CKFinder.popup({
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function (finder) {
                        finder.on('files:choose', function (evt) {
                            var file = evt.data.files.first();
                            element.val(file.getUrl());
                            image.html('<img src="' + file.getUrl() + '" alt="Avatar" style="width:100px;" />');
                        });

                        finder.on('file:choose:resizedImage', function (evt) {
                            element.val(evt.data.resizedUrl);
                            image.html('<img src="' + evt.data.resizedUrl + '" alt="Avatar" style="width:100px;" />');
                        });
                    }
                });
            }
        </script>
        @endsection