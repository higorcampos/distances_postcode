<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DistanceCreateRequest;
use App\Http\Requests\DistanceUpdateRequest;
use App\Repositories\DistanceRepository;
use App\Validators\DistanceValidator;

/**
 * Class DistancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class DistancesController extends Controller
{
    /**
     * @var DistanceRepository
     */
    protected $repository;

    /**
     * @var DistanceValidator
     */
    protected $validator;

    /**
     * DistancesController constructor.
     *
     * @param DistanceRepository $repository
     * @param DistanceValidator $validator
     */
    public function __construct(DistanceRepository $repository, DistanceValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $distances = $this->repository->all();
        return view('distances.index', compact('distances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DistanceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DistanceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $distance = $this->repository->create($request->all());

            $response = [
                'message' => 'Distance created.',
                'data'    => $distance->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $distance = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $distance,
            ]);
        }

        return view('distances.show', compact('distance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distance = $this->repository->find($id);

        return view('distances.edit', compact('distance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DistanceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DistanceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $distance = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Distance updated.',
                'data'    => $distance->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Distance deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Distance deleted.');
    }
}
