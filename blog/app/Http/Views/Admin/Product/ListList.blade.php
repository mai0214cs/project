@extends('Admin.layout')
@section('header')
{{trans('admin.ProductList')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.ProductList')}}</h1>
    <div id="Pagination" style="text-align: right;">
        &nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{!!trans('admin.buttonSearch')!!}</a>
        <div id="ListPage" style="float: right;"></div>
    </div>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div class="table-responsive">
    <table class="table table-hover table-striped" id="GridData">
        <thead>
            <tr>
                <th></th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.avatar')}}</th>
                <th>{{trans('admin.price')}}</th>
                <th>{{trans('admin.pricepromotion')}}</th>
                <th>{{trans('admin.parent')}}</th>
                <th>{{trans('admin.alias')}}</th>
                <th>{{trans('admin.new')}}</th>
                <th>{{trans('admin.sales')}}</th>
                <th>{{trans('admin.feature')}}</th>
                <th>{{trans('admin.status')}}</th>
                <th>{{trans('admin.status_inventory')}}</th>
                <th>{{trans('admin.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $item)
            <tr>
                <td></td>
                <td>{{$item->title}}</td>
                <td><img src="{{imageReset($item->avatar)}}" alt="{{$item->name}}" class="imageAvatar" /></td>
                
                <td>{{$item->products->price_sale}}</td>
                <td>{{$item->products->price_promotion}}</td>
                <td>{{$item->page->title}}</td>
                <td>{{$item->alias}}</td>
                <td><input type="checkbox" onclick="CheckStatus(0, {{$item->id}})" {{$item->new=='Yes'?'checked="checked"':''}}  /></td>
                <td><input type="checkbox" onclick="CheckStatus(1, {{$item->id}})" {{$item->products->seller=='Yes'?'checked="checked"':''}}  /></td>
                <td><input type="checkbox" onclick="CheckStatus(2, {{$item->id}})" {{$item->feature=='Yes'?'checked="checked"':''}} /></td>
                <td><input type="checkbox" onclick="CheckStatus(3, {{$item->id}})" {{$item->status=='Yes'?'checked="checked"':''}} /></td>
                <td><input type="checkbox" onclick="CheckStatus(4, {{$item->id}})" {{$item->products->manager_inventory=='Yes'?'checked="checked"':''}} /></td>
                <td>
                    <form style="float:left;" method="POST" onsubmit="return confirm('{{trans('admin.deleteListProductConfirm')}}');" action="{{route('admin.product.list.destroy',$item->id)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="DELETE" />
                        <button style="border: 0px;" type="submit" class="label label-danger">{!!trans('admin.buttonDelete')!!}</button>
                    </form>&nbsp;
                    <a class="label label-primary" href="{{route('admin.product.list.edit',$item->id)}}"><?= trans('admin.buttonEdit') ?></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="SearchForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('admin.searchproduct')}}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.key')}}</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="sName" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sCate">
                                <option value="0">{{trans('admin.noselect')}}</option>
                                @foreach($cate as $item)
                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.price')}}</label>
                        <div class="col-sm-9">
                            <div class="input-group" style="width:100%;">
                                <input style="width:50%;" type="number" name="pricestart" class="form-control" aria-label="...">
                                <input style="width:50%;" type="number" name="priceend" class="form-control" aria-label="...">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.date_update')}}</label>
                        <div class="col-sm-9">
                            <div class="input-group" style="width:100%;">
                                <input style="width:50%;" type="date" name="datestart" class="form-control" aria-label="...">
                                <input style="width:50%;" type="date" name="dateend" class="form-control" aria-label="...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.type')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sAction">
                                <option value="100">{{trans('admin.noselect')}}</option>
                                <option value="0">{{trans('admin.new')}}</option>
                                <option value="1">{{trans('admin.promotion')}}</option>
                                <option value="2">{{trans('admin.feature')}}</option>
                                <option value="3">{{trans('admin.sales')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.status')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sStatus">
                                <option value="">{{trans('admin.noselect')}}</option>
                                <option value="Show">{{trans('admin.show')}}</option>
                                <option value="Hide">{{trans('admin.hide')}}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="SearchProduct()" class="btn btn-default">{!!trans('admin.buttonSearch')!!}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{!!trans('admin.buttonClose')!!}</button>
            </div>
        </div>

    </div>
</div>





<a class="label label-primary" href="{{route('admin.product.list.create')}}"><?= trans('admin.buttonAdd') ?></a>
@endsection
@section('footer')
<style>
    ul.pagination {
        margin: 0px;
    }
    .imageAvatar{width:100px;}

</style>
<script>
    function CheckStatus(type, id){ AjaxData('/admin/product/list/status/' + type + '/' + id, {}, 'ResultUpdate'); }
</script>

@endsection