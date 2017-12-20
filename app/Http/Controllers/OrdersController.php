<?php
namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;

class OrdersController extends Controller
{
    private $repository;

    public function __construct(OrderRepository $r)
    {
        $this->repository = $r;
    }

    public function index()
    {
        $orders = $this->repository->paginate();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id, UserRepository $u)
    {
        $order = $this->repository->find($id);
        
        $status = [0 => 'Pendente',1=>'Despachado',2=>'Entregue'];
        
        $deliveryman = $u->getDeliveryman();
        
        return view('admin.orders.edit', compact('order','status','deliveryman'));
    }

    public function update(Request $r, $id)
    {
        $data = $r->all();
        $this->repository->update($data,$id);
        return redirect()->route('admin.pedidos.index');
    }
   
}