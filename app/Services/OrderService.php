<?php 
namespace Delivery\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\CupomRepository;
use Delivery\Models\Order;

class OrderService
{
	private $orderRepository;
	private $cupomRepository;
	private $productRepository;
	
	public function __construct(OrderRepository $or, CupomRepository $c,ProductRepository $p)
	{
		$this->orderRepository = $or;
		$this->CupomRepository = $c;
		$this->productRepository = $p;
	}
	public function create(array $data)
	{
		DB::beginTransaction();
		
		try {
			
			$data['status'] = 0;
			if(isset($data['cupom_id'])){
				unset($data['cupom_id']);
			}
			if(isset($data['cupom_code']) ){
				$cupom = $this->cupomRepository->findByField('code',$data['cupom_code'])->first();
				$data['cupom_id'] = $cupom->id;
				$cupom->used = 1;
				$cupom->save();
				unset($data['cupom_code']);
			}
			$items = $data['items'];
			unset($data['items']);
			$order = $this->orderRepository->create($data);
			$total = 0;
			foreach ($items as $item) {
				$item['price'] = $this->productRepository->find($item['product_id'])->price;
				$order->items()->create($item);
				$total += $item['price'] * $item['qtd'];
			}
			$order->total = $total;
			if(isset($cupom)){
				$order->total = $total - $cupom->valeu;
			}
			
			$order->save();
			
			DB::commit();
			return $order;
			
		} catch (\Exception $e) {
			DB::rollback();
			throw $e;
			
		}	
		
	}
	public function store($data)
	{
		$data['user']['password'] = bcrypt('123');
		$user = $this->userRepository->create($data['user']);
		$data['user_id'] = $user->id;
		$this->clientRepository->create($data);
	}

	public function updateStatus($id, $idDeliveryman, $status)
	{
		$order = $this->orderRepository->getByIdAndDeliveryman($id, $idDeliveryman);
		
		if( $order instanceof Order){

			$order->status = $status;
			$order->save();
			return $order;	
		}
		
		abort(400,'Order not Found!');
	}
}