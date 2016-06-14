<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OperatorRepositoryInterface;
use App\Repositories\Contracts\ScheduleRepositoryInterface;
use App\Repositories\Contracts\StationRepositoryInterface;
use App\Repositories\Contracts\TrainRepositoryInterface;
use App\Http\Requests\ScheduleFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Constructor
     * 
     * @param \App\Repositories\Contracts\ScheduleRepositoryInterface $repository
     */
    public function __construct(ScheduleRepositoryInterface $repository)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);

        $this->repository = $repository;
    }

    /**
     * Display a listing of schedules.
     * 
     * @param \App\Repositories\Contracts\StationRepositoryInterface $stationRepository
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
     * Show the form for creating a new schedule.
     * 
     * @param  \App\Repositories\Contracts\StationRepositoryInterface  $stationRepository
     * @param  \App\Repositories\Contracts\TrainRepositoryInterface    $trainRepository
     * @param  \App\Repositories\Contracts\OperatorRepositoryInterface $operatorRepository
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
     * Store a newly created schedule in storage.
     *
     * @param  \App\Http\Requests\ScheduleFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleFormRequest $request)
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
     * Display the specified schedule.
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
     * Show the form for editing the specified schedule.
     *
     * @param  \App\Repositories\Contracts\StationRepositoryInterface  $stationRepository
     * @param  \App\Repositories\Contracts\TrainRepositoryInterface    $trainRepository
     * @param  \App\Repositories\Contracts\OperatorRepositoryInterface $operatorRepository
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
     * Update the specified schedule in storage.
     *
     * @param  \App\Http\Requests\ScheduleFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleFormRequest $request, $id)
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
     * Remove the specified schedule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search schedules by station
     * 
     * @param  Illuminate\Http\Request                                  $request
     * @param  \App\Repositories\Contracts\StationRepositoryInterface   $stationRepository
     * @return \Illuminate\Http\Response | \Illuminate\Support\Collection
     */
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
