<?php

namespace App\Http\Middleware;

use App\Models\Role;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ( ($role == 'super') && (auth()->user()->role_id != Role::IS_SUPER) ) {
            abort( 403 );
        }

        if ( ($role == 'admin') && (auth()->user()->role_id != Role::IS_ADMIN) ) {
            abort( 403 );
        }

        if ( ($role == 'site_editor') && (auth()->user()->role_id != Role::IS_SITE_EDITOR) ) {
            abort( 403 );
        }

        if ( ($role == 'map_editor') && (auth()->user()->role_id != Role::IS_MAP_EDITOR) ) {
            abort( 403 );
        }

        if ( ($role == 'user') && (auth()->user()->role_id != Role::IS_USER) ) {
            abort( 403 );
        }

        return $next($request);
    }
}
