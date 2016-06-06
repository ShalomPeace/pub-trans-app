<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorFormRequest;
use App\Repositories\Contracts\OperatorRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    public function __construct(OperatorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operators = $this->repository->getAll();

        return view('operators.index', ['operators' => $operators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('operators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operator = $this->repository->find($id);

        return view('operators.show', ['operator' => $operator]);
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                                        'message'   => 'Operator successfully updated.'
                                  ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
