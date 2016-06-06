@extends('Admin.layout')
@section('header')
{{trans('admin.ProductList')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.ProductList')}}</h1>
    <div id="Pagination">
        <div id="CountPage" style="float: left">
            {!!GetPageCount()!!}
        </div>
        &nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tìm kiếm</a>
        <div id="ListPage" style="float: right;">{!!$listpage!!}</div>
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
                <td>{{$item->getProducts()->price_sale}}</td>
                <td>{{$item->getProducts()->price_promotion}}</td>
                <td>{{$item->getPage()->title}}</td>
                <td>{{$item->alias}}</td>
                <td><input type="checkbox" onclick="CheckStatus(0, {{$item->id}})" {{$item->new=='Yes'?'checked="checked"':''}}  /></td>
                <td><input type="checkbox" onclick="CheckStatus(1, {{$item->id}})" {{$item->getProducts()->seller=='Yes'?'checked="checked"':''}}  /></td>
                <td><input type="checkbox" onclick="CheckStatus(2, {{$item->id}})" {{$item->feature=='Yes'?'checked="checked"':''}} /></td>
                <td><input type="checkbox" onclick="CheckStatus(3, {{$item->id}})" {{$item->status=='Yes'?'checked="checked"':''}} /></td>
                <td>
                    <a class="label label-primary" href="{{route('admin.product.list.edit',$item->id)}}"><?= trans('admin.buttonEdit') ?></a>
                    <a class="label label-danger" href="/admin/product/list/delete/{{$item->id}}"><?= trans('admin.buttonDelete') ?></a>
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
                <h4 class="modal-title">Tìm kiếm sản phẩm</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Từ khóa</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="sName" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Danh mục</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sCate">
                                <option value="0">Tất cả danh mục</option>
                                @foreach($cate as $key=>$item)
                                <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Giá bán</label>
                        <div class="col-sm-9">
                            <div class="input-group" style="width:100%;">
                                <input style="width:50%;" type="number" name="pricestart" class="form-control" aria-label="...">
                                <input style="width:50%;" type="number" name="priceend" class="form-control" aria-label="...">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Ngày đăng</label>
                        <div class="col-sm-9">
                            <div class="input-group" style="width:100%;">
                                <input style="width:50%;" type="date" name="datestart" class="form-control" aria-label="...">
                                <input style="width:50%;" type="date" name="dateend" class="form-control" aria-label="...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tình trạng</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sAction">
                                <option value="-1">---</option>
                                <option value="0">Sản phẩm mới</option>
                                <option value="1">Sản phẩm khuyến mại</option>
                                <option value="2">Sản phẩm nổi bật</option>
                                <option value="3">Sản phẩm bán chạy</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Hoạt động</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sStatus">
                                <option value="">---</option>
                                <option value="Y">Hiện</option>
                                <option value="N">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="SearchProduct()" class="btn btn-default">Xác nhận</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    page = 1;
    function SearchProduct(){
    var pt = $('#SearchForm'), data = new Object();
    data.name = pt.find('[name="sName"]').val();
    data.category_id = pt.find('[name="sCate"]').val();
    data.price0 = pt.find('[name="pricestart"]').val();
    data.price1 = pt.find('[name="priceend"]').val();
    data.date0 = pt.find('[name="datestart"]').val();
    data.date1 = pt.find('[name="dateend"]').val();
    data.action = pt.find('[name="sAction"]').val();
    data.status = pt.find('[name="sStatus"]').val();
    data.count = $('#CountPage select').val();
    data.pageselect = page;
    AjaxData('/admin/product/search', data, 'UpdateSearch');
    }

    function UpdateSearch(data){
    $('#GridData tbody tr').remove();
    var template = document.querySelector('#TempGridData');
    $('#Pagination #ListPage').html(data.listpage);
    rs = data.list;
    for (var i = 0; i < rs.length; i++){
    var cat = rs[i];
    var clone = template.content.cloneNode(true);
    var cells = clone.querySelectorAll('td');
    cells[0].textContent = cat.name;
    cells[1].innerHTML = '<img src="' + cat.avatar + '" alt="' + cat.name + '" class="imageAvatar" />';
    cells[2].textContent = $('#SearchForm').find('[name="sCate"]').find('[value="' + cat.category_id + '"]').html();
    cells[3].textContent = cat.alias;
    cells[4].innerHTML = '<td><input type="checkbox" onclick="CheckStatus(0, ' + cat.id + ')" ' + (cat.new == 'Y'?'checked="checked"':'') + ' /></td>';
    cells[5].innerHTML = '<td><input type="checkbox" onclick="CheckStatus(1, ' + cat.id + ')" ' + (cat.hot == 'Y'?'checked="checked"':'') + ' /></td>';
    cells[6].innerHTML = '<td><input type="checkbox" onclick="CheckStatus(1, ' + cat.id + ')" ' + (cat.feature == 'Y'?'checked="checked"':'') + ' /></td>';
    cells[7].textContent = cat.created_at;
    cells[8].textContent = cat.updated_at;
    cells[9].textContent = cat.viewcount;
    cells[10].innerHTML = '<td><input type="checkbox" onclick="CheckStatus(1, ' + cat.id + ')" ' + (cat.status == 'Y'?'checked="checked"':'') + ' /></td>';
    cells[11].innerHTML = '<a class="label label-primary" href="/admin/product/list/' + cat.id + '/edit"><?= trans('admin.buttonEdit') ?></a> <a class="label label-danger" href="/admin/product/list/delete/' + cat.id + '"><?= trans('admin.buttonDelete') ?></a>';
    template.parentNode.appendChild(clone);
    }
    $("#myModal").modal("hide");
    }
    function SelectPageShow(pageid){ page = pageid; SearchProduct(); }
    function GetPageCount(){ SearchProduct(); }
    function CheckStatus(type, id){ AjaxData('/admin/product/list/status/' + type + '/' + id, {}, 'UpdateStatus'); }
    function UpdateStatus(rs){

    }
</script>

@endsection