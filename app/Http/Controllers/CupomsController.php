<?php
namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminCupomRequest;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\CupomRepository;

class CupomsController extends Controller
{
    private $repository;
    
	public function __construct(CupomRepository $r)
	{
		$this->repository = $r;
	}
    
    public function index()
    {	
        $cupoms = $this->repository->paginate(5);
        return view('admin.cupoms.index',compact('cupoms'));
    }
    
    public function create()
    {
        return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $r)
    {
        $data = $r->all();
        $this->repository->create($data);
        return redirect()->route('admin.cupoms.index');
    }
    
}