<?php

namespace App\Http\Middleware;

use App\Site;
use Closure;
use Encore\Admin\Facades\Admin;

class CheckSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $site_id = Admin::user()->site_id;
        if(!Site::where('status',1)->where('id',$site_id)->count()){
             return redirect('/admin');
        }
        config(['site.site_id'=>$site_id]);
        return $next($request);
    }
}
