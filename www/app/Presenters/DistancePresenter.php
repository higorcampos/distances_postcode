<?php

namespace App\Presenters;

use App\Transformers\DistanceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DistancePresenter.
 *
 * @package namespace App\Presenters;
 */
class DistancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DistanceTransformer();
    }
}
