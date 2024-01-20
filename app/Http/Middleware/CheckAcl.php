<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class CheckAcl
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
        
        // $route_details = $request->route();
        // $methods = $route_details->methods;
        // $action = $methods[0];
        

        // echo '<pre>';
        // print_r($route_details);
        // echo '</pre>';exit;
        return $next($request);
         

        if($request->session()->has('acl'))
        {
            $acl = $request->session()->get('acl');
            $path = $request->path();

            //echo $path;exit;
            //$role_array = unserialize($role);
            
            if(array_key_exists($path , $acl))
            {
                $permission = $acl[$path];

                if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
                {    
                    //echo 'ajax call' . $request->path(); 
                    if($permission == 0)
                    {
                        abort(403, 'You are not authorized to access this.');
                    }
                }
                else
                {
                    if($permission == 0)
                    {
                        return Redirect::back()->withErrors(['You are not authorized to access this.']);
                    }
                }
            }
            
        }

        return $next($request);

        
    }
}
