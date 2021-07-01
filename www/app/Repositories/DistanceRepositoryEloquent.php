<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DistanceRepository;
use App\Entities\Distance;
use App\Validators\DistanceValidator;

/**
 * Class DistanceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DistanceRepositoryEloquent extends BaseRepository implements DistanceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Distance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DistanceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
