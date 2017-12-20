<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace Delivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{

    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        return [
            'id'            => (int) $model->id,
            'product_id'    => (int) $model->product_id,
            // 'order_id'    => (int) $model->order_id,
            'price'    => (int) $model->price,
            'qtd'    => (int) $model->qtd,

            /* place your other model properties here */

            // 'created_at' => $model->created_at,
            // 'updated_at' => $model->updated_at
        ];
    }
}
