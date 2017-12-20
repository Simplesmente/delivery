<?php
namespace Delivery\Http\Controllers\Api\Deliveryman;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanController extends Controller
{
    private $orderRepository;

    private $userRepository;
	
    private $orderService;

    private $with = ['client','cupom','items'];


	public function __construct(OrderRepository $r,
    UserRepository $u,
    OrderService $os)
	{
        $this->orderRepository = $r;
        $this->userRepository = $u;
		$this->orderService = $os;
	}
    public function index()
    {
        
        if(Authorizer::getResourceOwnerId()){
            $clientId = Authorizer::getResourceOwnerId();
            $orders = $this->orderRepository->skipPresenter(false)->with($this->with)->scopeQuery(function($query)use ($clientId){
                return $query->where('user_deliveryman_id','=',$clientId);
            })->paginate();
            
            return $orders;
            
        }
        dd('usuário não autenticado');
    }
    
    public function updateStatus(Request $r, $id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        
        $order = $this->orderService->updateStatus($id, $idDeliveryman, $r->get('status') );
        
        if( $order ){
            return $this->orderService->find($order->id);
        }
        
        dd('Order not found!');
        
    }
	public function show($id)
    {
        $idDeliveryman = Authorizer::getResourceOwnerId();
        
        return $this->orderRepository->skipPresenter(false)->getByIdAndDeliveryman($id, $idDeliveryman);

    }
}