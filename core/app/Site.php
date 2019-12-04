<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function adminUsers()
    {
        return $this->hasMany(AdminUser::class);
    }
}
