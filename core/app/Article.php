<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function checkSite($id,$site_id=0)
    {
        $site_id = $site_id?:config('site.site_id',0);
        return self::where('id',$id)->where('site_id',$site_id)->count();
    }
}
