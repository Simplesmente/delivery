<?php

namespace Delivery\Transformers;

use League\Fractal\TransformerAbstract;
use Delivery\Models\Client;

/**
 * Class ClientTransformer
 * @package namespace Delivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,
            'phone'         => (int) $model->phone,
            'address'         => (int) $model->address,

            /* place your other model properties here */

            // 'created_at' => $model->created_at,
            // 'updated_at' => $model->updated_at
        ];
    }
}
