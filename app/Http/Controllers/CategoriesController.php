<?php
namespace Delivery\Http\Controllers;

use Delivery\Http\Requests\AdminCategoryRequest;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\CategoryRepository;

class CategoriesController extends Controller
{

    private $repository;
    
	public function __construct(CategoryRepository $r)
	{
		$this->repository = $r;
	}
    
    public function index()
    {	
        $categories = $this->repository->paginate(5);
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(AdminCategoryRequest $r)
    {
        $data = $r->all();
        $this->repository->create($data);

        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $r, $id)
    {
        $category = $this->repository->find($id);
        $category->name = $r->name;
        $category->save();
        return redirect()->route('admin.categories.index');
    }
    
    public function delete($id)
    {
        $category = $this->repository->find($id);
        if($category){
            $category->delete();
            return redirect()->route('admin.categories.index');
        }
    }
}