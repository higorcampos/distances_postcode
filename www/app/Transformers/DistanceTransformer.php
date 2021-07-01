<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Distance;

/**
 * Class DistanceTransformer.
 *
 * @package namespace App\Transformers;
 */
class DistanceTransformer extends TransformerAbstract
{
    /**
     * Transform the Distance entity.
     *
     * @param \App\Entities\Distance $model
     *
     * @return array
     */
    public function transform(Distance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
