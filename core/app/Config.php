<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    protected $fillable = ['name','site_id','type', 'data', 'desc','logo','favicon','client_cert','client_key'];
    protected $appends = ['jsonData'];
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
    public function getJsonDataAttribute()
    {
        return json_decode($this->data,true);
    }
    public static function getConfig($site_id,$type = 'site',$add=false)
    {
        $config = self::where('site_id',$site_id)->where('type',$type)->first();
        if(!$config && $add){
            $config = self::create([
                'type'=>$type,
                'site_id'=>$site_id,
                'title'=>'',
                'per_page'=>'',
                'data'=>[]
            ]);
        }
        return $config;
    }
    public function site(){
        return $this->belongsTo(Site::class);
    }
}
