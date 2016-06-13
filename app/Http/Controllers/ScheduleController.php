<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OperatorRepositoryInterface;
use App\Repositories\Contracts\ScheduleRepositoryInterface;
use App\Repositories\Contracts\StationRepositoryInterface;
use App\Repositories\Contracts\TrainRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function __construct(ScheduleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StationRepositoryInterface $stationRepository)
    {
        $schedules = $this->repository->getLatestSchedules();
        $stations  = $stationRepository->getForField();

        return view('schedules.index', [
            'schedules' => $schedules,
            'stations'  => $stations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StationRepositoryInterface $stationRepository,
                           TrainRepositoryInterface $trainRepository,
                           OperatorRepositoryInterface $operatorRepository)
    {
        $stations  = $stationRepository->getForField();
        $trains    = $trainRepository->getForField();
        $operators = $operatorRepository->getForField();

        return view('schedules.create', [
            'stations'  => $stations,
            'trains'    => $trains,
            'operators' => $operators,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ScheduleFormRequest $request)
    {
        if ($schedule = $this->repository->create($request->input())) {
            return ! $request->ajax() ? redirect()->route('schedules.show', $schedule)
                                                  ->with('success', 'Schedule successfully added.')
                                      : response()->json([
                                            'status'    => 1,
                                            'message'   => 'Schedule successfully added.',
                                            'data'      => ['schedule' => $schedule],
                                            'redirect'  => route('schedules.show', $schedule),
                                      ]);
        }

        return ! $request->ajax() ? redirect()->route('schedules.create')
                                              ->with('error', 'Unable to add schedule. Please try again.')
                                              ->withInput($request->input())
                                  : response()->json([
                                        'status'    => 0,
                                        'message'   => 'Unable to add schedule. Please try again.',
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
        $schedule = $this->repository->getSchedule($id);

        return view('schedules.show', ['schedule' => $schedule]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StationRepositoryInterface $stationRepository,
                         TrainRepositoryInterface $trainRepository,
                         OperatorRepositoryInterface $operatorRepository,
                         $id)
    {
        $stations  = $stationRepository->getForField();
        $trains    = $trainRepository->getForField();
        $operators = $operatorRepository->getForField();
        $schedule  = $this->repository->getSchedule($id);

        $data = [
            'stations'  => $stations,
            'trains'    => $trains,
            'operators' => $operators,
            'schedule'  => $schedule,
        ];

        return view('schedules.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ScheduleFormRequest $request, $id)
    {
        if ( ! $this->repository->update($id, $request->input())) {
            return ! $request->ajax() ? redirect()->route('schedules.edit', $id)
                                                  ->with('error', 'Unable to update schedule. Please try again.')
                                      : response()->json([
                                            'status'    => 0,
                                            'message'   => 'Unable to update schedule. Please try again.',
                                      ]);
        }

        return ! $request->ajax() ? redirect()->route('schedules.show', $id)
                                              ->with('success', 'Schedule successfully updated.')
                                  : response()->json([
                                        'status'    => 1,
                                        'message'   => 'Schedule successfully updated.',
                                        'data'      => ['schedule_id' => $id],
                                        'redirect'  => route('schedules.show', $id),
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

    public function search(Request $request, StationRepositoryInterface $stationRepository)
    {
        $departure = $request->input('departure');
        $arrival   = $request->input('arrival');

        $schedules = $this->repository->search($departure, $arrival);
        $stations  = $stationRepository->getForField();

        $data = [
            'schedules'      => $schedules,
            'stations'       => $stations,
            'departure'      => $departure,
            'arrival'        => $arrival,
        ];

        return ! $request->ajax() ? view('schedules.index', $data) : collect(array_only($data, 'schedules'))->toJson();
    }
}
