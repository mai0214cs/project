<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Models\PageModel;
use App\Http\Libraries\LoadMenu;
use App\Http\Requests\PageRequest;


class ProductCategoryController extends Controller
{
    private $menu;
    
    function __construct() {
        $this->menu = new LoadMenu();
    }
    // Danh sách Danh mục sản phẩm
    public function index()
    {
        return view('Admin/Product/CateList')->with(['menu' => $this->menu->ListMenu(PageModel::where('type','product_category')->get(), 0)]);
    }
    
    // Giao diện thêm Danh mục sản phẩm
    public function create()
    {
        $category = PageModel::where('type','product_category')->get()->toArray();
        return view('Admin/Product/CateAdd')->with(['menu' => $this->menu->ListMenu($category, 0)]);
    }
    
    // Thêm mới danh mục sản phẩm
    public function store(PageRequest $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $category = new PageModel();
        foreach ($input as $key => $value) {
            $category->$key = $value;
        }
        $category->type = 'product_category';
        $category->alias = stripUnicode($category->alias == '' ? $category->title : $category->alias);
        for (;;) {
            if (PageModel::where('alias', $category->alias)->count() == 0) {
                break;
            } else {
                $category->alias .= rand(1, 1000000);
            }
        }
        if (in_array($category->id_page, $this->menu->AddMenuList(PageModel::all(), 0)) || $category->id_page == 0) {
            if ($category->save()) {
                return redirect()->route('admin.product.category.index')->with(information('success', 'admin.addCategoryProductSuccess'));
            }
            return redirect()->route('admin.product.category.create')->with(information('danger', 'admin.addCategoryProductError'));
        } else {
            return redirect()->route('admin.product.category.create')->with(information('danger', 'admin.addCategoryProductError'));
        }
    }

    // Giao diện sửa danh mục sản phẩm
    public function edit($id)
    {
        $get = PageModel::where(['type'=>'product_category','id'=>$id])->get()->toArray();
        if(count($get)==0){
            return redirect()->route('admin.product.category.index')->with(information('danger', 'admin.noexistsCategoryProduct'));
        }
        $data['item'] = $get[0];
        $data['menu'] = $this->menu->ListMenuEdit(PageModel::where('type','product_category')->get()->toArray(), 0, $id);
        return view('Admin.Product.CateEdit')->with($data);
    }

    // Cập nhật danh mục sản phẩm
    public function update(PageRequest $request, $id)
    {
        $input = $request->all();
        unset($input['_token']); unset($input['_method']);
        $category = PageModel::where(['type'=>'product_category'],['id'=>$id]);
        if($category->get()->count()==0){
            return redirect()->route('admin.product.category.index')->with(information('danger', 'admin.noexistsCategoryProduct'));
        }
        $input['type'] = 'product_category';
        $input['alias'] = stripUnicode($input['alias'] == '' ? $input['title'] : $input['alias']);
        for (;;) {
            if (PageModel::where([['alias', $input['alias']],['id','<>',$id]])->count() == 0) {
                break;
            } else {
                $input['alias'] .= rand(1, 1000000);
            }
        }
        if (in_array($input['id_page'], $this->menu->EditMenuList(PageModel::all(), 0, $id)) || $input['id_page'] == 0) {
            if ($category->update($input)) {
                return redirect()->route('admin.product.category.index')->with(information('success', 'admin.editCategoryProductSuccess'));
            }
            return redirect()->route('admin.product.category.edit',$id)->with(information('danger', 'admin.editCategoryProductError'));
        } else {
            return redirect()->route('admin.product.category.edit',$id)->with(information('danger', 'admin.editCategoryProductError'));
        }
    }
    
    // Xóa danh mục sản phẩm
    public function delete($id, $idnew) {
        $count = PageModel::where(['type'=>'product_category'])->whereIn('id',[$id, $idnew])->get()->count();
        switch ($count){
            case 0:
                //return redirect()->route('admin.product.category.index')->with(information('danger','admin.noexistsCategoryProduct'));
                break;
            case 1:
                PageModel::where(['type'=>'product_list','id_page'=>$id])->delete();
                $count = PageModel::where(['type'=>'product_category','id'=>$id])->delete();
                break;
            case 2:
                PageModel::where(['type'=>'product_list','id_page'=>$id])->update(['id_page'=>$idnew]);
                $count = PageModel::where(['type'=>'product_category','id'=>$id])->delete();
                break;
        }
        return response(information($count?'success':'danger', $count?'admin.deleteCategoryProductSuccess':'admin.deleteCategoryProductError'), 200, ['Content-type:application/json']);
    }

    public function status($id) {
        $get = PageModel::where(['type'=>'product_category'])->find($id);
        if(!$get){return;}
        $data = $get->select('status')->get()->toArray();
        $get->status = $data[0]['status']=='Yes'?'No':'Yo';
        if($get->save()){
            return response(information('success', 'admin.statusCategoryProductSuccess'), 200, ['Content-type:application/json']);
        }else{
            return response(information('danger', 'admin.statusCategoryProductError'), 200, ['Content-type:application/json']);
        }
    }
    
    
}
