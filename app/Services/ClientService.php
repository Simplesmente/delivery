<?php 
namespace Delivery\Services;

use Delivery\Repositories\UserRepository;
use Delivery\Repositories\ClientRepository;

class ClientService
{
    private $userRepository;
    
	private $clientRepository;
	
	public function __construct(ClientRepository $cr, UserRepository $ur)
	{
		$this->userRepository = $ur;
		$this->clientRepository = $cr;
	}
	public function update(array $data, $id)
	{
        $this->clientRepository->update($data, $id);
        
        $userId = $this->clientRepository->find($id,['user_id'])->user_id;
        
		$this->userRepository->update($data['user'],$userId);
	}
	public function store($data)
	{
		$data['user']['password'] = bcrypt('123');
        $user = $this->userRepository->create($data['user']);
        
		$data['user_id'] = $user->id;
		$this->clientRepository->create($data);
	}
}