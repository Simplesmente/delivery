<?php
namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\CategoryRepository;
use Delivery\Http\Requests\AdminProductRequest;

class ProductsController extends Controller
{
    private $repository;

    private $repositoryCategory;

    public function __construct(ProductRepository $r, CategoryRepository $c)
    {
        $this->repository = $r;
        
        $this->repositoryCategory = $c;
    }

    public function index()
    {
        $products = $this->repository->paginate();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->repositoryCategory->lists();
        return view('admin.products.create',compact('categories'));
    }

    public function store(AdminProductRequest $r)
    {
        $data = $r->all();
        $this->repository->create($data);
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {           
        $product = $this->repository->find($id);
        $categories = $this->repositoryCategory->lists();
      
        return view('admin.products.edit',compact('product','categories'));
    }

    public function update(AdminProductRequest $r,$id)
    {
        $data = $r->all();
        $this->repository->update($data,$id);
        return redirect()->route('admin.products.index');
    }
    
    public function destroy($id)
    {
        $product = $this->repository->find($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}