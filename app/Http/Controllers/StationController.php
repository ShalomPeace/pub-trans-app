<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StationRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests\StationFormRequest;
use App\Http\Controllers\Controller;

class StationController extends Controller
{
    public function __construct(StationRepositoryInterface $repository)
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
        $stations = $this->repository->getAll(['departureschedules', 'arrivalschedules']);

        return view('stations.index', ['stations' => $stations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StationFormRequest $request)
    {
        if ($station = $this->repository->create($request->only('name'))) {
            return ! $request->ajax() ? redirect()->route('stations.show', $station)
                                                ->with('success', "Station succesfully added.")
                                    : response()->json([
                                        'status'    => 1,
                                        'message'   => 'Station successfully added.',
                                        'data'      => $station->toJson(),
                                        'redirect'  => route('stations.show', $station),
                                    ]);
        }

        return ! $request->ajax() ? redirect()->route('stations.create')
                                            ->with('error', 'Unable to add station. Please try again.')
                                            ->withInput($request->only('name'))
                                : response()->json([
                                    'status'    => 0,
                                    'message'   => 'Unable to add station. Please try again.'
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
        $station = $this->repository->find($id);

        $station->load('departureschedules', 'departureschedules.arrivalstation', 'departureschedules.train');
        $station->load('arrivalschedules', 'arrivalschedules.arrivalstation', 'arrivalschedules.train');

        return view('stations.show', ['station' => $station]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $station = $this->repository->find($id);

        return view('stations.edit', ['station' => $station]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StationFormRequest $request, $id)
    {
        if ( ! $this->repository->update($id, $request->only('name'))) {
            return ! $request->ajax() ? redirect()->route('stations.edit', $id)
                                                  ->with('error', 'Unable to update station. Please try again.')
                                      : response()->json([
                                            'status'    => 0,
                                            'message'   => 'Unable to update station. Please try again.',
                                      ]);
        }

        return ! $request->ajax() ? redirect()->route('stations.show', $id)
                                              ->with('success', 'Station successfully updated.')
                                  : response()->json([
                                        'status'    => 1,
                                        'message'   => 'Station successfully updated.',
                                        'redirect'  => route('stations.show', $id),
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
