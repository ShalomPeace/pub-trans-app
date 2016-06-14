<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorFormRequest;
use App\Repositories\Contracts\OperatorRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    /**
     * Constructor
     * 
     * @param \App\Repositories\Contracts\OperatorRepositoryInterface $repository
     */
    public function __construct(OperatorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of operators.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = $this->repository->getOperatorList();

        return view('operators.index', ['operators' => $operators]);
    }

    /**
     * Show the form for creating a new operator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operators.create');
    }

    /**
     * Store a newly created operator in storage.
     * 
     * @param  \App\Http\Requests\OperatorFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperatorFormRequest $request)
    {
        if ($operator = $this->repository->create($request->input())) {
            return ! $request->ajax() ? redirect()->route('operators.show', $operator)
                                                  ->with('success', 'Operator successfully added.')
                                      : response()->json([
                                            'status'    => 1,
                                            'message'   => 'Operator successfully added.',
                                            'data'      => ['operator' => $operator],
                                            'redirect'  => route('operators.show', $operator),
                                      ]);
        }

        return ! $request->ajax() ? redirect()->route('operators.create')
                                              ->with('error', 'Unable to add operator. Please try again.')
                                              ->withInput($request->input())
                                  : response()->json([
                                        'status'    => 0,
                                        'message'   => 'Unable to add operator. Please try again.',
                                  ]);
    }

    /**
     * Display the specified operator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operator = $this->repository->getOperatorWithSchedules($id);

        return view('operators.show', ['operator' => $operator]);
    }

    /**
     * Show the form for editing the specified operator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operator = $this->repository->find($id);

        return view('operators.edit', ['operator' => $operator]);
    }

    /**
     * Update the specified operator in storage.
     *
     * @param  \App\Http\Requests\OperatorFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OperatorFormRequest $request, $id)
    {
        if ( ! $this->repository->update($id, $request->input())) {
            return ! $request->ajax() ? redirect()->route('operators.edit', $id)
                                                  ->with('error', 'Unable to update operator. Please try again.')
                                      : response()->json([
                                            'status'    => 0,
                                            'message'   => 'Unable to update operator. Please try again.',
                                      ]);
        }

        return ! $request->ajax() ? redirect()->route('operators.show', $id)
                                              ->with('success', 'Operator successfully updated.')
                                  : response()->json([
                                        'status'    => 1,
                                        'message'   => 'Operator successfully updated.', 
                                        'redirect'  => route('operators.show', $id),
                                  ]);
    }

    /**
     * Remove the specified operator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
