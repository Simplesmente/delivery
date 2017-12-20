<?php
namespace Delivery\Http\Middleware;

use Closure;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Delivery\Repositories\UserRepository;

class OAuthDeliveryRole
{
    protected $userRepository;

    public function __construct(UserRepository $u)
    {
      $this->userRepository = $u;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
       $id = Authorizer::getResourceOwnerId();
       
       $user = $this->userRepository->find($id);

       if($user->role != $role){
        
            abort(403,'Access Forbidden');
       }
       return $next($request);
    }
}