@extends('Admin.layout')
@section('header')
{{trans('admin.PageAddListProduct')}}
@endsection
@section('content')


<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageAddListProduct')}}</h1>
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
                                @foreach($cate as $item)
                                <option {{old('id_page')==$item['id']?'selected="selected"':''}} value="{{$item['id']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.avatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imageavatar"><img style="width:100px;" src="{{imageReset(old('avatar'))}}" alt="{{$item['title']}}" /></div>
                            <input type="hidden" class="form-control" name="avatar" value="{{imageReset(old('avatar'))}}" />
                            <button onclick="selectFileWithCKFinder('avatar')" type="button">{!!trans('admin.buttonImage')!!}</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="description" value="{{old('description')}}" /></div>
                    </div> 
                </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('admin.detail')}}</label>
                <textarea name="detail" id="detail"><?= old('detail') ?></textarea>
                <script>CKEDITOR.replace('detail');</script>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.infoproduct')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.code_product')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="code" value="{{old('code')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.price_import')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_import" value="{{old('price_import')==''?0:old('price_import')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.price')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_sale" value="{{old('price_sale')==''?0:old('price_sale')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.pricepromotion')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_promotion" value="{{old('price_promotion')==''?0:old('price_promotion')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.included_VAT')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="included_VAT" value="Yes" {{in_array(old('included_VAT'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                            </label>
                            <label class="radio-inline">
                                <input name="included_VAT" value="No" {{old('included_VAT')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.quantity')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="quantity" min='0' value="{{old('quantity')==''?1000:old('quantity')}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.manager_inventory')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="manager_inventory" value="Yes" {{in_array(old('manager_inventory'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                            </label>
                            <label class="radio-inline">
                                <input name="manager_inventory" value="No" {{old('manager_inventory')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.infoseo')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.order')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="orderBy" value="{{old('orderBy')==''?999:old('orderBy')}}" /></div>
                    </div>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.status')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="status" value="Yes" {{in_array(old('status'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="No" {{old('status')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.new')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="new" value="Yes" {{in_array(old('new'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="new" value="No" {{old('new')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.sales')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="seller" value="Yes" {{in_array(old('seller'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="seller" value="No" {{old('seller')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.feature')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="feature" value="Yes" {{in_array(old('feature'),['Yes',''])?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="feature" value="No" {{old('feature')=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
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