<?php

// app/Http/Middleware/Authorize.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request)  $next
     * @param  array  $permissions
     * @param  array|string  $guards = []
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        if ($this->hasPermissions($request, $permissions)) {
            return $next($request);
        }

        return $this->respondToAuthorizationFailure($request);
    }

    /**
     * Determine if the user has the required permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $permissions
     * @return bool
     */
    protected function hasPermissions($request, array $permissions)
    {
        if (empty($permissions)) {
            return true;
        }

        $gate = app(Gate::class);

        foreach ($permissions as $permission) {
            if ($gate->check($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Respond to a failed authorization attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\AuthorizationException
     */
    protected function respondToAuthorizationFailure($request)
    {
        abort(403, 'You are not authorized to access this resource.');
    }
}
