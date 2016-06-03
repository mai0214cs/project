<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\PageModel;
use App\Http\Libraries\LoadMenu;


class ProductCategoryController extends Controller
{
    private $menu;
    
    function __construct() {
        $this->menu = new LoadMenu();
    }

    public function index()
    {
        return view('Admin/Product/CateList')->with(['menu' => $this->menu->ListMenu(PageModel::where('type','product_category')->get(), 0)]);
    }
    
    public function create()
    {
        $category = PageModel::where('type','product_category')->get()->toArray();
        return view('Admin/Product/CateAdd')->with(['menu' => $this->menu->ListMenu($category, 0)]);
    }
    
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
