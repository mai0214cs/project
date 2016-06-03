<?php
namespace App\Http\Libraries;
class LoadMenu {
    private $datanew = array();
    private $dem = 0; private $menu = '';
    
    public function ShowMenu($data,$parent_id){
        foreach ($data as $key => $item) {
            $name = 0;
            if($item['parent_id'] == $parent_id){
                $this->menu .= ($name==0&&$item['parent_id']>0)?'<ul>':'';
                $this->menu .= '<li>';
                $this->menu .= '<a '.($item['target']=='Y'?'target="_blink"':'').' href="'.$item['link'].'">'.$item['name'].'</a>';
                unset($data[$key]);
                if($data){$this->ListMenu($data, $item['id']);}
                $this->menu .= '</li>';
                $this->menu .= ($name==0&&$item['parent_id']>0)?'</ul>':'';
                $name++;
            }
        }
        return $this->menu;
    }

    



    public function ListMenu($data,$parent_id,$string = ''){
        foreach ($data as $key => $item) {
            if($item['parent_id'] == $parent_id){
                unset($data[$key]);
                $this->datanew[$this->dem] = $item;
                $this->datanew[$this->dem]['name'] = $string.$item['name'];
                $this->dem++;
                if($data){$this->ListMenu($data, $item['id'],$string.'-----');}
            }
        }
        return $this->datanew;
    }
    public function ListMenuEdit($data,$id_capchads,$current,$string = ''){        
        foreach ($data as $key => $item) {
            if($item['parent_id'] == $id_capchads){
                unset($data[$key]);
                if($item['id']!=$current){
                    $this->datanew[$this->dem] = $item;
                    $this->datanew[$this->dem]['name'] = $string.$item['name'];
                    $this->dem++;
                    if($data){$this->ListMenuEdit($data, $item['id'],$current,$string.'-----');}
                }
            }
        }
        return $this->datanew;
    }
    public function AddMenuList($data,$parent_id){
        foreach ($data as $key => $item) {
            if($item['parent_id'] == $parent_id){
                unset($data[$key]);
                $this->datanew[] = $item['id'];
                if($data){$this->AddMenuList($data, $item['id']);}
            }
        }
        return $this->datanew;
    }
    public function EditMenuList($data,$parent_id,$current){        
        foreach ($data as $key => $item) {
            if($item['parent_id'] == $parent_id){
                unset($data[$key]);
                if($item['id']!=$current){
                    $this->datanew[] = $item['id'];
                    if($data){$this->EditMenuList($data, $item['id'],$current);}
                }
            }
        }
        return $this->datanew;
    }
    /*
    public function LocId($current,$type, $typeadd){
        $x = DB::GetData('page', array('id, danhmuc, tieude'), 'id_Type=?', array($type),'thutu ASC, id DESC');
        $dsx = $this->DequiSelectEditMenu($x,0,$current);
        $dm = array();
        foreach ($dsx as $v) { $dm[] = $v['id']; }
        return 'NOT (danhmuc IN ('.  implode(',', $dm).')) AND id_Type='.$typeadd;
    }
    
    public function LocIdXoa($current,$type){
        $x = DB::GetData('page', array('id, id_page, tieude'), 'type=?', array($type),'id_page ASC, thutu ASC, id DESC');
        $dsx = $this->DequiSelectEditMenu($x,0,$current);
        $dm = array();
        foreach ($dsx as $v) { $dm[] = $v['id']; }
        return 'NOT(id IN ('.  implode(',', $dm).')) AND id_Type='.$type;
    }
    
    
    
    public function Locdanhmuc($id, $type, $field){
        $x = DB::GetData('page', array('id, id_page, tieude'), 'type=?', array($type),'id_page ASC, thutu ASC, id DESC');
        $dsx = $this->DequiSelectEditMenu($x,0,$id);
        $dm = array(); foreach ($dsx as $v) { $dm[] = $v['id']; }
        return 'NOT('.$field.' IN ('.implode(',', $dm).'))';
    }*/
}
