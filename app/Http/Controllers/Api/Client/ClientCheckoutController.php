<?php
namespace Delivery\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Delivery\Http\Controllers\Controller;
use Delivery\Http\Requests\CheckoutRequest;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
  private $orderRepository;
  private $userRepository;
	
  private $productRepository;
  private $orderService;

  private $with = ['client','cupom','items'];

  
	public function __construct(OrderRepository $r,
  UserRepository $u,
  ProductRepository $p,
  OrderService $os)
	{
    $this->orderRepository = $r;
    $this->userRepository = $u;
    $this->productRepository = $p;
		$this->orderService = $os;
	}
  public function index()
  {
    if(Authorizer::getResourceOwnerId()){
      $clientId = $this->userRepository->find(Authorizer::getResourceOwnerId())->client->id;
      $orders = $this->orderRepository->skipPresenter(false)->with($this->with)->scopeQuery(function($query)use ($clientId){
        return $query->where('client_id','=',$clientId);
      })->paginate();
      
      return $orders;
      
    }
    dd('usuário não autenticado');
  }
  
  public function store(CheckoutRequest $r)
  {
    $data = $r->all();
    $clientId = $this->userRepository->find(Authorizer::getResourceOwnerId() )->client->id;
    $data['client_id'] = $clientId;
    $order = $this->orderService->create($data);
   // $order = $this->orderRepository->with('items')->find($order->id);
    return $this->orderRepository->skipPresenter(false)->with($this->with)->find($order->id);
  }
	public function show($id)
  {
    return $this->orderRepository->skipPresenter(false)->with($this->with)->find($id);
   
  }
}
