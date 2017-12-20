<?php
namespace Delivery\Http\Controllers;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\ClientRepository;
use Delivery\Http\Requests\AdminClientsRequest;
use Delivery\Services\ClientService;

class ClientsController extends Controller
{
	private $repository;
    
    private $clientService;
    
	public function __construct(ClientRepository $r, ClientService $s)
	{
		$this->repository = $r;
        $this->clientService = $s;
	}
    
    public function index()
    {	
        $clients = $this->repository->paginate(5);
        
        return view('admin.clients.index',compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(AdminClientsRequest $r)
    {
        $data = $r->all();
        $this->clientService->store($data);
        return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
        $client = $this->repository->find($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(AdminClientsRequest $r, $id)
    {  
        $data = $r->all();
        $this->clientService->update($data,$id);
        
        return redirect()->route('admin.clients.index');
    }

    public function delete($id)
    {
        $client = $this->repository->find($id);

        if($client){
            $client->delete();
            return redirect()->route('admin.clients.index');
        }
    }
}