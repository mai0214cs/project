@extends('Admin.layout')
@section('header')
{{trans('admin.ProductAttributeGroup')}}
@endsection
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">{{trans('admin.ProductAttributeGroup')}}</h1>
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
                <th>{{trans('admin.name')}}</th>
                <th>{{trans('admin.type')}}</th>
                <th>{{trans('admin.order')}}</th>
                <th>{{trans('admin.status')}}</th>
                <th>{{trans('admin.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->order}}</td>
                <td><input type="checkbox" onclick="CheckStatus({{$item->id}})" {{$item->status=='Show'?'checked="checked"':''}}  /></td>
                <td>
                    
                    <form style="float:left;" method="POST" onsubmit="return confirm('{{trans('admin.deleteAttrGroupProductConfirm')}}');" action="{{route('admin.product.attributegroup.destroy',$item->id)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="DELETE" />
                        <button style="border: 0px;" type="submit" class="label label-danger">{!!trans('admin.buttonDelete')!!}</button>
                    </form>&nbsp;
                    <a class="label label-primary" href="{{route('admin.product.attributegroup.edit',$item->id)}}"><?= trans('admin.buttonEdit') ?></a>
                    <!--<a class="label label-danger" href="/admin/product/attributegroup/delete/{{$item->id}}" onclick="return confirm('{{trans('admin.deleteListNewsConfirm')}}');"><?= trans('admin.buttonDelete') ?></a>-->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<a class="label label-primary" href="{{route('admin.product.attributegroup.create')}}"><?= trans('admin.buttonAdd') ?></a>
@endsection
@section('footer')
<script>
function CheckStatus(id){ AjaxData('/admin/product/attributegroup/' + id, {}, 'ResultUpdate'); }
</script>
@endsection