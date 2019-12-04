<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;

class AdminUser extends Administrator
{
    protected $fillable = ['username', 'password', 'name', 'avatar','site_id','level'];
    public function site()
    {
        return $this->belongsTo(Site::class,'site_id','id');
    }
}
