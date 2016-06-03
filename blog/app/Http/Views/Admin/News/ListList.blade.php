@extends('Admin.layout')
@section('header')
{{trans('layoutadmin.newslist')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('layoutadmin.newslist')}}</h1>
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
                <th>{{trans('news.listname')}}</th>
                <th>{{trans('news.listavatar')}}</th>
                <th>{{trans('news.listparent')}}</th>
                <th>{{trans('admin.alias')}}</th>
                <th>{{trans('news.new')}}</th>
                <th>{{trans('news.hot')}}</th>
                <th>{{trans('news.feature')}}</th>
                <th>{{trans('news.DateAdd')}}</th>
                <th>{{trans('news.DateEdit')}}</th>
                <th>{{trans('news.View')}}</th>
                <th>{{trans('news.liststatus')}}</th>
                <th>{{trans('admin.action')}}</th>
            </tr>
        </thead>
        <tbody>
        <template id="TempGridData"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></template>
        @foreach($list as $item)
        <tr>
            <td>{{$item['name']}}</td>
            <td><img src="{{imageReset($item['avatar'])}}" alt="{{$item['name']}}" class="imageAvatar" /></td>
            <td>{{isset($cate[$item['category_id']])?$cate[$item['category_id']]:''}}</td>
            <td>{{$item['alias']}}</td>
            <td><input type="checkbox" onclick="CheckStatus(0, {{$item['id']}})" {{$item['new']=='Y'?'checked="checked"':''}}  /></td>
            <td><input type="checkbox" onclick="CheckStatus(1, {{$item['id']}})" {{$item['hot']=='Y'?'checked="checked"':''}}  /></td>
            <td><input type="checkbox" onclick="CheckStatus(2, {{$item['id']}})" {{$item['feature']=='Y'?'checked="checked"':''}} /></td>
            <td>{{$item['created_at']}}</td>
            <td>{{$item['updated_at']}}</td>
            <td>{{$item['viewcount']}}</td>
            <td><input type="checkbox" onclick="CheckStatus(3, {{$item['id']}})" {{$item['status']=='Y'?'checked="checked"':''}} /></td>
            <td>
                <a class="label label-primary" href="{{route('admin.news.list.edit',$item['id'])}}"><?= trans('admin.buttonEdit') ?></a>&nbsp;
                <a class="label label-danger" href="/admin/news/list/delete/{{$item['id']}}"><?= trans('admin.buttonDelete') ?></a>
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
                <h4 class="modal-title">Tìm kiếm tin tức</h4>
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
                <button type="button" onclick="SearchNews()" class="btn btn-default">Xác nhận</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<a class="label label-primary" href="{{route('admin.news.list.create')}}"><?= trans('admin.buttonAdd') ?></a>
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
    function SearchNews(){
    var pt = $('#SearchForm'), data = new Object();
    data.name = pt.find('[name="sName"]').val();
    data.category_id = pt.find('[name="sCate"]').val();
    data.date0 = pt.find('[name="datestart"]').val();
    data.date1 = pt.find('[name="dateend"]').val();
    data.status = pt.find('[name="sStatus"]').val();
    data.count = $('#CountPage select').val();
    data.pageselect = page;
    AjaxData('/admin/news/search', data, 'UpdateSearch');
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
    cells[11].innerHTML = '<a class="label label-primary" href="/admin/news/list/' + cat.id + '/edit"><?= trans('admin.buttonEdit') ?></a> <a class="label label-danger" href="/admin/product/list/delete/' + cat.id + '"><?= trans('admin.buttonDelete') ?></a>';
    template.parentNode.appendChild(clone);
    }
    $("#myModal").modal("hide");
    }
    function SelectPageShow(pageid){ page = pageid; SearchNews(); }
    function GetPageCount(){ SearchNews(); }
    function CheckStatus(type, id){ AjaxData('/admin/news/list/status/' + type + '/' + id, {}, 'UpdateStatus'); }
    function UpdateStatus(rs){

    }
</script>
@endsection