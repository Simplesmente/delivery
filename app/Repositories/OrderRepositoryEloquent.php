<?php

namespace Delivery\Repositories;

use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use Delivery\Repositories\OrderRepository;
use Delivery\Models\Order;

/**
 * Class OrderRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{   
    protected $skipPresenter = true;

    public function getByIdAndDeliveryman($id, $idDeliveryman)
    {
        $result = $this->with(['client','items','cupom'])->findWhere([
            'id' => $id,
            'user_deliveryman_id' => $idDeliveryman
        ]);

        if( $result instanceof Collection){
            $result = $result->first();
        }else{
            if( isset($result['data']) && count($result['data']) === 1){
                $result = [
                    'data' => $result['data'][0]
                ];
            }
        }
       
        return $result;
    }
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return \Delivery\Presenters\OrderPresenter::class;
    }
}
