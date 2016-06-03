@extends('Admin.layout')
@section('header')
{{trans('admin.ProductCategory')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.ProductCategory')}}</h1>
</div>
<div class="clearfix"></div>
@if(count($errors->all())>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
<!-- /.col-lg-12 -->
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.alias')}}</th>
                <th>{{trans('admin.status')}}</th>
                <th>{{trans('admin.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menu as $item)
            <tr>
                <td>{{$item['name']}}</td>
                <td>{{$item['alias']}}</td>
                <td><input type="checkbox" onclick="CheckStatus({{$item['id']}})" {{$item['status']=='Y'?'checked="checked"':''}} /></td>
                <td>
                    <a class="label label-primary" href="{{route('admin.product.category.edit',$item['id'])}}"><?= trans('admin.buttonEdit') ?></a>
                    <a class="label label-danger" onclick="SelectCategoryDelete({{$item['id']}})" data-toggle="modal" data-target="#myModal"><?= trans('admin.buttonDelete') ?></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<a class="label label-primary" href="{{route('admin.product.category.create')}}"><?= trans('admin.buttonAdd') ?></a>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="SearchForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chuyển sản phẩm sang danh mục khác</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('product.cateparent')}}</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_category" value="" />
                            <select class="form-control" name="selectParent">
                                <option value="0">Không lựa chọn</option>
                                @foreach($menu as $m)
                                <option {{$item['parent_id']==$m['id']?'selected="selected"':''}} value="{{$m['id']}}">{{$m['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" onclick="DeleteCategoryPoroduct()" class="btn btn-danger"><?= trans('admin.buttonDelete') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<script>
    function SelectCategoryDelete(id){
        $('[name="selectParent"] option').show();
        $('[name="id_category"]').val(id);
        $('[name="selectParent"] option[value="'+id+'"]').hide();
    }
    function DeleteCategoryPoroduct(){
        var obj = new Object();
        obj.category_id = $('[name="id_category"]').val();
        obj.selectParent = $('[name="selectParent"]').val();
        AjaxData('/admin/product/category/delete/' + obj.category_id + '/' + obj.selectParent, {}, 'ResultDelete');
    }
    function ResultDelete(rs){
        location.reload();
    }
    function CheckStatus(id){ AjaxData('/admin/product/category/status/' + id, {}, 'UpdateStatus'); }
    function UpdateStatus(rs){
        
    }
</script>
@endsection