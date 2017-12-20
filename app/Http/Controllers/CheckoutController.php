<?php
namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Services\OrderService;

class CheckoutController extends Controller
{

    private $orderRepository;

    private $userRepository;
    
    private $product;
    
    private $orderService;

	public function __construct(OrderRepository $order,UserRepository $user,ProductRepository $product, OrderService $orderService )
	{
        $this->orderRepository = $order;
        $this->userRepository = $user;
        $this->product = $product;
        $this->orderService = $orderService;
        
	}
    
    public function index()
    {	

        if(\Auth::user()){
            
            $clientId = $this->userRepository->find(\Auth::user()->id)->client->id;

            $orders = $this->orderRepository->scopeQuery(function($query)use ($clientId){
              
                return $query->where('client_id','=',$clientId);

            })->paginate();

         return view('customer.order.index', compact('orders'));
            
         }
         dd('usuário não autenticado');
    }

    public function create()
    {
        $products = $this->product->getProductsBy();
      
        return view('customer.order.create',compact('products'));
    }

    public function store(Request $r)
    {
       $data = $r->all();
       $clientId = $this->userRepository->find(\Auth::user()->id )->client->id;
       $data['client_id'] = $clientId;
       $this->orderService->create($data);
       return redirect()->route('customer.order.index');
    }

    public function edit($id)
    {
        
    }

    public function update(AdminCategoryRequest $r, $id)
    {
        
    }
    
    public function delete($id)
    {
       
    }
}