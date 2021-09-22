<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Http\Request;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('jwt', function (Request $request) {
            try{
                $tokenPayload = JWT::decode($request->bearerToken(), config('jwt.secret'),  config('jwt.algorithms'));

                return User::findOrFail($tokenPayload->id);
            } catch(\Exception $e){
                return null;
            }
        });
    }
}
