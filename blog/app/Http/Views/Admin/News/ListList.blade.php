@extends('Admin.layout') 
@section('header')
{{trans('admin.NewsList')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.NewsList')}}</h1>
    <div id="Pagination">
        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">{!!trans('admin.buttonSearch')!!}</a>&nbsp;&nbsp;&nbsp;
        <a type="button" class="btn btn-danger" onclick="XoaCheckAll('/admin/news/list/deleteall', '{{trans('admin.deleteNewsAll')}}')">{!!trans('admin.buttonDeleteAll')!!}</a>

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
                <th><input type="checkbox" onclick="togglecheckboxes(this)"></th>
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.avatar')}}</th>
                <th>{{trans('admin.parent')}}</th>
                <th>{{trans('admin.alias')}}</th>
                <th>{{trans('admin.new')}}</th>
                <th>{{trans('admin.feature')}}</th>
                <th>{{trans('admin.status')}}</th>
                <th>{{trans('admin.action')}}</th>
            </tr>
        </thead>
        <tbody>

            @foreach($list as $item)
            <tr>
                <td><input type="checkbox" class="CheckAll" rel="{{$item->id}}"></td>
                <td>{{$item->title}}</td>
                <td><img src="{{imageReset($item->avatar)}}" alt="{{$item->name}}" class="imageAvatar" /></td>
                <td>{{isset($listcate[$item->id_page])?$listcate[$item->id_page]:''}}</td>
                <td>{{$item['alias']}}</td>
                <td><input type="checkbox" onclick="CheckStatus(0, {{$item->id}})" {{$item->new=='Yes'?'checked="checked"':''}}  /></td>
                <td><input type="checkbox" onclick="CheckStatus(1, {{$item->id}})" {{$item->feature=='Yes'?'checked="checked"':''}} /></td>
                <td><input type="checkbox" onclick="CheckStatus(2, {{$item->id}})" {{$item->status=='Yes'?'checked="checked"':''}} /></td>
                <td>
                    <a class="label label-primary" href="{{route('admin.news.list.edit',$item->id)}}"><?= trans('admin.buttonEdit') ?></a>&nbsp;
                    <a class="label label-danger" href="/admin/news/list/delete/{{$item->id}}" onclick="return confirm('{{trans('admin.deleteListNewsConfirm')}}');"><?= trans('admin.buttonDelete') ?></a>
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
                <h4 class="modal-title">{{trans('admin.searchnews')}}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.key')}}</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="sKey" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">{{trans('admin.parent')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sCate">
                                <option value="0">{{trans('admin.parent')}}</option>
                                @foreach($cate as $key=>$item)
                                <option value="{{$item['id']}}">{{$item['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

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
                        <label class="control-label col-sm-3">{{trans('admin.status')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sStatus">
                                <option value="">---</option>
                                <option value="Yes">{{trans('admin.show')}}</option>
                                <option value="No">{{trans('admin.hide')}}</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="SearchNews()" class="btn btn-default">{!!trans('admin.buttonSearch')!!}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{!!trans('admin.buttonClose')!!}</button>
            </div>
        </div>

    </div>
</div>




<a class="label label-primary" href="{{route('admin.news.list.create')}}"><?= trans('admin.buttonAdd') ?></a>
@endsection
@section('footer')
<style>
    .imageAvatar{width:100px;}
    div#Pagination {text-align: right;}
</style>
<script>
    function CheckStatus(type, id){ AjaxData('/admin/news/list/status/' + type + '/' + id, {}, 'ResultUpdate'); }
</script>
@endsection