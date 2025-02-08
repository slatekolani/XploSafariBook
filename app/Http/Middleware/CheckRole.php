<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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

            $roles = $request->user()->roles;
            foreach ($roles as $role) {
                if ($role->name == "Front-desk" || $role->name == "Officer" || $role->name == "Inspector")
                    return redirect('workflow/pending');
                if ($role->name == "Admin")
                    return redirect('admin/dashboard');
                if ($role->name == "Company")
                    return redirect('company/dashboard');
            }

        return $next($request);
    }
}
