<?php

namespace App\Http\Controllers\News;

use App\Http\Models\PageModel;
use App\Http\Controllers\Controller;
use App\Http\Libraries\LoadMenu;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PageRequest;

class NewsListController extends Controller {

    private $menu;

    function __construct() {
        $this->menu = new LoadMenu();
    }

    /* Display a listing of the resource. */

    public function index() {
        $input = Input::all();
        // Build where
        $where[] = ['type', 'news_list'];
        $data['where'] = [];
        if (isset($input['sKey'])) {
            $data['where']['key'] = $input['sKey'];
            $where[] = ['title', 'LIKE', '%' . $data['where']['key'] . '%'];
        }
        if (isset($input['sCate'])) {
            $data['where']['cate'] = $input['sCate'];
            if ($data['where']['cate'] > 0) {
                $where[] = ['id_page', $data['where']['cate']];
            }
        }
        if (isset($input['datestart'])) {
            $data['where']['start'] = $input['datestart'];
            if ($data['where']['start'] != '') {
                $where[] = ['updated_at', '>', $data['where']['start']];
            }
        }
        if (isset($input['dateend'])) {
            $data['where']['end'] = $input['dateend'];
            if ($data['where']['end'] != '') {
                $where[] = ['updated_at', '<', $data['where']['end']];
            }
        }
        if (isset($input['sStatus'])) {
            $data['where']['status'] = $input['sStatus'];
            if (in_array($data['where']['status'], ['Yes', 'No'])) {
                $where[] = ['status', $data['where']['status']];
            }
        }


        $cate = PageModel::where(['type' => 'news_category'])->get()->toArray();
        $data['listcate'] = [];
        foreach ($cate as $item) {
            $data['listcate'][$item['id']] = $item['title'];
        }
        $data['cate'] = $this->menu->ListMenu($cate, 0);
        $data['list'] = PageModel::where($where)->paginate(config('app.item'));
        $data['listpage'] = $data['list']->appends($input)->links();
        return view('Admin.News.ListList')->with($data);
    }

    /* Show the form for creating a new resource. */

    public function create() {
        $data['cate'] = $this->menu->ListMenu(PageModel::where(['type' => 'news_category'])->get()->toArray(), 0);
        return view('Admin.News.ListAdd')->with($data);
    }

    /* Store a newly created resource in storage. */

    public function store(PageRequest $request) {
        $input = Input::all();
        unset($input['_token']);
        $category = new PageModel();
        $input['type'] = 'news_list';
        if (PageModel::where(['type' => 'news_category', 'id' => $input['id_page']])->get()->count() > 0) {
            $input['alias'] = stripUnicode($input['alias'] == '' ? $input['title'] : $input['alias']);
            for (;;) {
                if (PageModel::where('alias', $input['alias'])->count() == 0) {
                    break;
                } else {
                    $input['alias'] .= rand(1, 1000000);
                }
            }
            foreach ($input as $key => $value) {
                $category->{$key} = $value;
            }
            if ($category->save()) {
                return redirect()->route('admin.news.list.index')->with(information('success', 'admin.addListNewsSuccess'));
            }
            return redirect()->route('admin.news.list.create')->with(information('danger', 'admin.addListNewsError'));
        } else {
            return redirect()->route('admin.news.list.create')->with(information('danger', 'admin.noexistsCategoryNews'));
        }
    }

    /* Display the specified resource.  */

    public function show($id) {
        //
    }

    /* Show the form for editing the specified resource. */

    public function edit($id) {
        $get = PageModel::where(['type'=>'news_list','id'=>$id])->get()->toArray();
        if(count($get)==0){
            return redirect()->route('admin.news.list.index')->with(information('danger', 'admin.noexistsListNews'));
        }
        $data['id'] = $id;
        $data['item'] = $get[0];
        $data['cate'] = $this->menu->ListMenuEdit(PageModel::where('type','news_category')->get()->toArray(), 0, $id);
        return view('Admin.News.ListEdit')->with($data);
    }

    /* Update the specified resource in storage.  */
    public function update(PageRequest $request, $id) {
        $input = $request->all();
        unset($input['_token']); unset($input['_method']);
        $list = PageModel::where(['type'=>'news_list'],['id'=>$id]);
        if($list->get()->count()==0){
            return redirect()->route('admin.news.list.index')->with(information('danger', 'admin.noexistsListNews'));
        }
        $input['type'] = 'news_list';
        $input['alias'] = stripUnicode($input['alias'] == '' ? $input['title'] : $input['alias']);
        for (;;) {
            if (PageModel::where([['alias', $input['alias']],['id','<>',$id]])->count() == 0) {
                break;
            } else {
                $input['alias'] .= rand(1, 1000000);
            }
        }
        
        if (PageModel::where(['type'=>'news_category'],['id'=>$input['id_page']])->get()->count() > 0) {
            if ($list->update($input)) {
                return redirect()->route('admin.news.list.index')->with(information('success', 'admin.editCategoryNewsSuccess'));
            }
            return redirect()->route('admin.news.list.edit', $id)->with(information('danger', 'admin.editCategoryNewsError'));
        } else {
            return redirect()->route('admin.news.list.edit', $id)->with(information('danger', 'admin.editCategoryNewsError'));
        }
    }

    /* Remove the specified resource from storage. */
    public function destroy($id) {
        
    }
    
    public function status($type, $id){
        $item = [0=>'new', 1=>'feature', 2=>'status'];
        if(!isset($item[$type])){
            echo json_encode(information('danger', 'admin.errorRequest')); return;
        }
        $data_old = PageModel::where(['type'=>'news_list', 'id'=>$id])->select($item[$type])->get()->toArray();
        if(count($data_old)==0){
            echo json_encode(information('danger', 'admin.noexistsListNews')); return;
        }
        $update = PageModel::find($id);
        $update->{$item[$type]} = $data_old[0][$item[$type]]=='Yes'?'No':'Yes';
        
        if($update->save()){
            echo json_encode(information('success', 'admin.updateDataSuccess'));
        }else{
            echo json_encode(information('danger', 'admin.updateDataError'));
        }
    }
    public function delete($id){
        if(PageModel::where(['type'=>'news_list', 'id'=>$id])->get()->count()==0){
            return redirect()->route('admin.news.list.index')->with(information('danger', 'admin.noexistsListNews'));
        }
        
        if(PageModel::find($id)->delete()){
            return redirect()->route('admin.news.list.index')->with(information('success', 'admin.deleteListNewsSuccess'));
        }else{
            return redirect()->route('admin.news.list.index')->with(information('danger', 'admin.deleteListNewsError'));
        }
    }
    public function deleteAll(){
        $input = Input::all(); $count = 0;
        foreach ($input['deleteAll'] as $item) {
            if(PageModel::where(['type'=>'news_list','id'=>$item])->get()->count()==0){continue;}
            if(PageModel::find($item)->delete()){$count++;}
        }
        echo $count;
    }

}
