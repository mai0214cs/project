<?php

namespace App\Http\Controllers\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Group_attributesModel;
use App\Http\Requests\Group_attributesRequest;

class ProductAttributeGroupController extends Controller
{
    private $data;
    function __construct() {
        $this->data['type'] = ['select','checkbox','radio','color','location','text'];
    }
    /* Display a listing of the resource. */
    public function index()
    {
        $this->data['group'] = Group_attributesModel::orderBy('order','asc')->orderBy('id','asc')->get();
        return view('Admin.Product.AttrGList')->with($this->data);
    }

    /* Show the form for creating a new resource. */
    public function create()
    {
        return view('Admin.Product.AttrGAdd')->with($this->data);
    }

    /* Store a newly created resource in storage. */
    public function store(Group_attributesRequest $request)
    {
        $input = $request->all(); unset($input['_token']);
        $group = new Group_attributesModel();
        foreach ($input as $key=>$value) {
            $group->{$key} = $value;
        }
        if($group->save()){
            return redirect()->route('admin.product.attributegroup.index')->with(information('success', 'admin.addAttrGroupProductSuccess'));
        }else{
            return redirect()->route('admin.product.attributegroup.create')->with(information('danger', 'admin.addAttrGroupProductError'));
        }
    }

    /* Display the specified resource. */
    public function show($id)
    {
        $group = Group_attributesModel::find($id);
        if(!$group){
            return redirect()->route('admin.product.attributegroup.index')->with(information('danger', 'admin.noexistsAttrGroupProduct'));
        }
        $group->status = $group->status == 'Show'?'Hide':'Show';
        if($group->save()){
            echo json_encode(information('success', 'admin.updateDataSuccess'));
        }else{
            echo json_encode(information('danger', 'admin.updateDataError'));
        }
    }

    /* Show the form for editing the specified resource. */
    public function edit($id)
    {
        $this->data['item'] = Group_attributesModel::find($id);
        if(!$this->data['item']){
            return redirect()->route('admin.product.attributegroup.index')->with(information('danger', 'admin.noexistsAttrGroupProduct'));
        }
        //$data['item'] = $get;
        return view('Admin.Product.AttrGEdit')->with($this->data);
    }

    /* Update the specified resource in storage. */
    public function update(Group_attributesRequest $request, $id)
    {
        $input = $request->all(); unset($input['_token']); unset($input['_method']);
        $group = Group_attributesModel::find($id);
        if(!$group){
            return redirect()->route('admin.product.attributegroup.index')->with(information('danger', 'admin.noexistsAttrGroupProduct'));
        }
        foreach ($input as $key=>$value) {
            $group->{$key} = $value;
        }
        if($group->save()){
            return redirect()->route('admin.product.attributegroup.index')->with(information('success', 'admin.editAttrGroupProductSuccess'));
        }else{
            return redirect()->route('admin.product.attributegroup.edit',$id)->with(information('danger', 'admin.editAttrGroupProductError'));
        }
    }

    /* Remove the specified resource from storage. */
    public function destroy($id)
    {
        $group = Group_attributesModel::find($id);
        if(!$group){
            return redirect()->route('admin.product.attributegroup.index')->with(information('danger', 'admin.noexistsAttrGroupProduct'));
        }
        $group->getListAttributes()->delete();
        if($group->delete()){
            return redirect()->route('admin.product.attributegroup.index')->with(information('success', 'admin.deleteAttrGroupProductSuccess'));
        }else{
            return redirect()->route('admin.product.attributegroup.index')->with(information('danger', 'admin.deleteAttrGroupProductError'));
        }
    }
}
