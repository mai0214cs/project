@extends('Admin.layout')
@section('header')
{{trans('product.listadd')}}
@endsection
@section('content')


<div class="col-lg-12">
    <h1 class="page-header">{{trans('product.listadd')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.list.store')}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin chung</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listname')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtName" value="{{old('txtName')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listparent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="selectParent">
                                @foreach($category as $item)
                                <option {{old('selectParent')==$item['id']?'selected="selected"':''}} value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listavatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imagetxtAvatar"><img style="width:100px;" src="/image.png" alt="Hình ảnh" /></div>
                            <input type="hidden" class="form-control" name="txtAvatar" value="{{old('txtAvatar')}}" />
                            <input onclick="selectFileWithCKFinder('txtAvatar')" type="button" value="Chọn hình ảnh">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listdescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtDescription" value="{{old('txtDescription')}}" /></div>
                    </div> 
                </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('product.listdetail')}}</label>
                <textarea name="txtDetail" id="txtDetail"><?= old('txtDetail') ?></textarea>
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
                        <label class="control-label col-sm-3">{{trans('product.listcode')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtCode" value="{{old('txtCode')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listprice')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="txtPrice" value="{{old('txtPrice')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listpromotionprice')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="txtPromotionPrice" value="{{old('txtPromotionPrice')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listvat')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="rdovat" value="Y" {{old('rdovat')=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                            </label>
                            <label class="radio-inline">
                                <input name="rdovat" value="N" {{old('rdovat')=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listquantity')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="txtQuantity" min='0' value="{{old('txtQuantity')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listwarranty')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="txtWarranty" min='0' max='100' value="{{old('txtWarranty')}}" /></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Thông tin SEO</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listorder')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtOrder" value="{{old('txtOrder')==''?999:old('txtOrder')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listseotitle')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOTitle" value="{{old('txtSEOTitle')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listseokeyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEOKeyword" value="{{old('txtSEOKeyword')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.listseodescription')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtSEODescription" value="{{old('txtSEODescription')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="txtAlias" value="{{old('txtAlias')}}" /></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('product.liststatus')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="rdoStatus" value="Y" {{old('rdoStatus')=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="rdoStatus" value="N" {{old('rdoStatus')=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('product.listnew')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="rdonew" value="Y" {{old('rdonew')=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="rdonew" value="N" {{old('rdonew')=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('product.listhot')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="rdohot" value="Y" {{old('rdohot')=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="rdohot" value="N" {{old('rdohot')=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('product.listfeature')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="rdofeature" value="Y" {{old('rdofeature')=='Y'?'':'checked="checked"'}} type="radio">{{trans('admin.show')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="rdofeature" value="N" {{old('rdofeature')=='N'?'checked="checked"':''}} type="radio">{{trans('admin.hide')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>

<div class="clearfix"></div>










        <button type="submit" class="btn btn-default"><?= trans('admin.buttonAdd') ?></button>
        <a href="{{route('admin.product.list.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection