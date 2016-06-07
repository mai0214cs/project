@extends('Admin.layout')
@section('header')
{{trans('admin.PageEditListProduct')}}
@endsection
@section('content')


<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.PageEditListProduct')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div style="padding-bottom:120px">
    <form action="{{route('admin.product.list.update',$item->id)}}" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="PUT">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('admin.infocommon')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.name')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="title" value="{{$item->title}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_page">
                                @foreach($cate as $items)
                                <option {{$item->id_page==$items['id']?'selected="selected"':''}} value="{{$items['id']}}">{{$items['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.avatar')}}</label>
                        <div class="col-sm-9">
                            <div class="imageavatar"><img style="width:100px;" src="{{imageReset($item->avatar)}}" alt="{{$item->title}}" /></div>
                            <input type="hidden" class="form-control" name="avatar" value="{{imageReset($item->avatar)}}" />
                            <button onclick="selectFileWithCKFinder('avatar')" type="button">{!!trans('admin.buttonImage')!!}</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="description" value="{{$item->description}}" /></div>
                    </div> 
                </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <label>{{trans('admin.detail')}}</label>
                <textarea name="detail" id="detail"><?= $item->detail ?></textarea>
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
                        <div class="col-sm-9"><input class="form-control" name="code" value="{{$item->products->code}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.price_import')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_import" value="{{$item->products->price_import}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.price')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_sale" value="{{$item->products->price_sale}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.pricepromotion')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="price_promotion" value="{{$item->products->price_promotion}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.included_VAT')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="included_VAT" value="Yes" {{$item->products->included_VAT=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                            </label>
                            <label class="radio-inline">
                                <input name="included_VAT" value="No" {{$item->products->included_VAT=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.quantity')}}</label>
                        <div class="col-sm-9"><input class="form-control" type="number" name="quantity" min='0' value="{{$item->products->quantity}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.manager_inventory')}}</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                <input name="manager_inventory" value="Yes" {{$item->products->manager_inventory=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                            </label>
                            <label class="radio-inline">
                                <input name="manager_inventory" value="No" {{$item->products->manager_inventory=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
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
                        <div class="col-sm-9"><input class="form-control" name="orderBy" value="{{$item->orderby}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_title')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_title" value="{{$item->SEO_title}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_keyword')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_keyword" value="{{$item->SEO_keyword}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.SEO_description')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="SEO_description" value="{{$item->SEO_description}}" /></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.alias')}}</label>
                        <div class="col-sm-9"><input class="form-control" name="alias" value="{{$item->alias}}" /></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.status')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="status" value="Yes" {{$item->status=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status" value="No" {{$item->status=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.new')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="new" value="Yes" {{$item->new=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="new" value="No" {{$item->new=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.sales')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="seller" value="Yes" {{$item->products->seller=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="seller" value="No" {{$item->products->seller=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-6">{{trans('admin.feature')}}</label>
                                <div class="col-sm-6">
                                    <label class="radio-inline">
                                        <input name="feature" value="Yes" {{$item->feature=='Yes'?'checked="checked"':''}} type="radio">{{trans('admin.yes')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input name="feature" value="No" {{$item->feature=='No'?'checked="checked"':''}} type="radio">{{trans('admin.no')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>

<div class="clearfix"></div>
        <button type="submit" class="btn btn-default"><?= trans('admin.buttonEdit') ?></button>
        <a href="{{route('admin.product.list.index')}}" class="btn btn-default"><?= trans('admin.buttonReset') ?></a>
        <form>
            </div>
            @endsection
            @section('footer')

            @endsection