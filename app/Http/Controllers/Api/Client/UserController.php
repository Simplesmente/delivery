<?php

namespace Delivery\Http\Controllers\Api\Client;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    private $userRepository;

	public function __construct(UserRepository $u)
	{
        $this->userRepository = $u;
    }
    
    public function index()
    {
        if(Authorizer::getResourceOwnerId()){
            $client = $this->userRepository->find(Authorizer::getResourceOwnerId());
            
            return $client;
            
        }
        dd('usuário não autenticado');
    }
    
    
}