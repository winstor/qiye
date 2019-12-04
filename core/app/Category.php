<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    use ModelTree, AdminBuilder;
    protected $fillable = ['title','alias','keywords','desc','site_id','parent_id','order','is_menu','logo','is_index'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setParentColumn('parent_id');
        $this->setOrderColumn('order');
        $this->setTitleColumn('title');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public static function categoryTree()
    {
        $site_id =config('site.site_id');
        $categories = self::select('id','title','parent_id')->where('site_id',$site_id)->get()->groupBy('parent_id');
        $data = [];
        $nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        foreach($categories[0] as $item){
            $data[$item['id']] = $item['title'];
            if(isset($categories[$item['id']])){
                foreach($categories[$item['id']] as $vv){
                    $data[$vv['id']] = $nbsp.$vv['title'];
                    if(isset($categories[$vv['id']])){
                        foreach($categories[$vv['id']] as $vo){
                            $data[$vo['id']] = $nbsp.$nbsp.$vo['title'];
                        }
                    }
                }
            }
        }
        return $data;
    }
    public static function selectTree()
    {
        $site_id =config('site.site_id');
        $categories = self::select('id','title','parent_id')->where('site_id',$site_id)->get()->groupBy('parent_id');
        $data = [];
        $nbsp = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        foreach($categories[0] as $item){
            $data[$item['id']] = '|-'.$item['title'];
            if(isset($categories[$item['id']])){
                foreach($categories[$item['id']] as $vv){
                    $data[$vv['id']] = $nbsp.'|-'.$vv['title'];
                    if(isset($categories[$vv['id']])){
                        foreach($categories[$vv['id']] as $vo){
                            $data[$vo['id']] = $nbsp.$nbsp.'|-'.$vo['title'];
                        }
                    }
                }
            }
        }
        return $data;
    }

    public  static function tree($categories,$parent_id=0,$level=0,$k=0)
    {
        $data = [];
        if($parent_id==0){
            if($categories instanceof Collection){
                $categories = $categories->groupBy('parent_id');
            }else{
                $categories = collect($categories)->groupBy('parent_id');
            }
        }
        $lists = isset($categories[$parent_id])?$categories[$parent_id]:[];
        foreach($lists as $list){
            if($level){
                $list['title'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$level+$k).$list['title'];
            }
            $data[] = $list;
            $data = array_merge($data,self::tree($categories,$list['id'],$level+1,$k));
        }
        return $data;
    }

    public static function deleteAndChild($id)
    {
        $lists = self::where('parent_id',$id)->get();
        foreach($lists as $list){
            self::deleteAndChild($list->id);
        }
        self::where('id',$id)->delete();
    }
    public static function checkSite($id,$site_id=0)
    {
        $site_id = $site_id?:config('site.site_id',0);
        return self::where('id',$id)->where('site_id',$site_id)->count();
    }

}
