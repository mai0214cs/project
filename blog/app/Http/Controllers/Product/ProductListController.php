<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Models\PageModel;
use App\Http\Libraries\LoadMenu;

class ProductListController extends Controller
{
    private $menu;
    function __construct() {
        $this->menu = new LoadMenu();
    }

    public function index()
    {
        $where = ['type'=>'product_list'];
        $data['list'] = PageModel::where($where)->orderBy('order','asc')->orderBy('id','desc')->paginate(15);
        $data['cate'] = $this->menu->ListMenu(PageModel::where('type','product_category')->get()->toArray(), 0);
        //$data['page'] = $data['list']->appends($search)->links();
        return view('Admin.Product.ListList')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
