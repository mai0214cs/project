<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Models\PageModel;
use App\Http\Models\ProductsModel;
use App\Http\Libraries\LoadMenu;
use App\Http\Requests\PageRequest;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Input;

class ProductListController extends Controller {

    private $fields_page = ['title', 'description', 'detail', 'id_page', 'avatar', 'SEO_title', 'SEO_description', 'SEO_keyword', 'status', 'orderby', 'type', 'alias', 'new', 'feature'];
    private $fields_product = ['price_import', 'price_sale', 'price_promotion', 'included_VAT', 'quantity', 'manager_inventory', 'id_page', 'new', 'seller'];
    private $menu;

    function __construct() {
        $this->menu = new LoadMenu();
    }

    public function index() {
        $where = ['type' => 'product_list'];
        $data['list'] = PageModel::where($where)->orderBy('orderby', 'asc')->orderBy('id', 'desc')->paginate(15);
        $data['cate'] = $this->menu->ListMenu(PageModel::where('type', 'product_category')->get()->toArray(), 0);
        //$data['page'] = $data['list']->appends($search)->links();
        
        
        //print_r($data['list'][0]->getProducts());exit();
        return view('Admin.Product.ListList')->with($data);
    }

    public function create() {
        $data['cate'] = $this->menu->ListMenu(PageModel::where('type', 'product_category')->get()->toArray(), 0);
        return view('Admin.Product.ListAdd')->with($data);
    }

    public function store(PageRequest $requestpage, ProductsRequest $requestproduct) {
        $input = Input::all();
        
        
        $page = new PageModel();
        $product = new ProductsModel();
        $input['type'] = 'product_list';
        // Test URL
        $input['alias'] = stripUnicode($input['alias'] == '' ? $input['title'] : $input['alias']);
        for (;;) {
            if (PageModel::where('alias', $input['alias'])->count() == 0) {
                break;
            } else {
                $input['alias'] .= rand(1, 1000000);
            }
        }
        // Test Category
        if (PageModel::where(['type' => 'product_category', 'id' => $input['id_page']])->get()->count() == 0) {
            return redirect()->route('admin.product.list.create')->with(information('danger', 'admin.noexistsCategoryProduct'));
        }
        foreach ($input as $key => $value) {
            if (in_array($key, $this->fields_page)) {
                $page->$key = $value;
            } else {
                if (in_array($key, $this->fields_product)) {
                    $product->$key = $value;
                }
            }
        }
        
        
        $update= $page->save();
        $product->id_page = $page->id;
        if($update>0){
            $product->save();
            return redirect()->route('admin.product.list.index')->with(information('success', 'admin.addListProductSuccess'));
        }
        return redirect()->route('admin.product.list.index')->with(information('danger', 'admin.addListProductError'));
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $get = PageModel::where(['type'=>'product_list'])->find($id);
        if(!$get){
            return redirect()->route('admin.product.list.index')->with(information('danger', 'admin.noexistsListProduct'));
        }
        $data['id'] = $id;
        $data['item'] = $get;
        $data['cate'] = $this->menu->ListMenuEdit(PageModel::where('type','product_category')->get()->toArray(), 0, $id);
        return view('Admin.Product.ListEdit')->with($data);
    }

    public function update(PageRequest $requestpage, ProductsRequest $requestproduct, $id) {
        $input = Input::all();
        
        $page = PageModel::where(['type'=>'product_list'])->find($id);
        $products = ProductsModel::where(['id_page'=>$id])->first();
        if(!$page){
            return redirect()->route('admin.product.list.index')->with(information('danger', 'admin.noexistsListProduct'));
        }
        $input['alias'] = stripUnicode($input['alias'] == '' ? $input['title'] : $input['alias']);
        for (;;) {
            if (PageModel::where([['alias', $input['alias']],['id','<>',$id]])->count() == 0) {
                break;
            } else {
                $input['alias'] .= rand(1, 1000000);
            }
        }
        // Test Category
        if (PageModel::where(['type' => 'product_category', 'id' => $input['id_page']])->get()->count() == 0) {
            return redirect()->route('admin.product.list.create')->with(information('danger', 'admin.noexistsCategoryProduct'));
        }
        $data_page = []; $data_product = [];
        foreach ($input as $key => $value) {
            if (in_array($key, $this->fields_page)) {
                $page->$key = $value;
            } else {
                if (in_array($key, $this->fields_product)) {
                    $products->$key = $value;
                }
            }
        } 
        
        $page->type = 'product_list';
        $products->id_page = $id;
        if($page->save()&&$products->save()){
            return redirect()->route('admin.product.list.index')->with(information('success', 'admin.editListProductSuccess'));
        }else{
            return redirect()->route('admin.product.list.edit',$id)->with(information('danger', 'admin.editListProductError'));
        }
    }

    public function destroy($id) {
        $page = PageModel::where(['type'=>'product_list'])->find($id);
        if(!$page){
            return redirect()->route('admin.product.list.index')->with(information('danger', 'admin.noexistsListProduct'));
        }
        if(PageModel::find($id)->delete()){
            return redirect()->route('admin.product.list.index')->with(information('success', 'admin.deleteListProductSuccess'));
        }else{
            return redirect()->route('admin.product.list.index')->with(information('danger', 'admin.deleteListProductError'));
        }
    }
    
    public function status($type, $id){
        $test = PageModel::where(['type'=>'product_list'])->find($id);
        if(!$test){ echo json_encode(information('danger', 'admin.noexistsListProduct')); return;}
        $page = PageModel::find($id);
        $products = ProductsModel::where(['id_page'=>$id])->first();
        switch ($type){
            case 0: $page->new = $test->new=='Yes'?'No':'Yes'; $rs = $page->save();break;
            case 1: $products->seller = $test->products->seller=='Yes'?'No':'Yes'; $rs = $products->save(); break;
            case 2: $page->feature = $test->feature=='Yes'?'No':'Yes'; $rs = $page->save();break;
            case 3: $page->status = $test->status=='Yes'?'No':'Yes'; $rs = $page->save(); break;
            case 4: $products->manager_inventory = $test->products->manager_inventory=='Yes'?'No':'Yes'; $rs = $products->save(); break;
            default: return;
        }
        if($rs){echo json_encode(information('success', 'admin.updateDataSuccess')); return;}
        echo json_encode(information('danger', 'admin.updateDataError')); 
    }

}
