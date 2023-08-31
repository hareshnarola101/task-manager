<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetaskRequest;
use App\Http\Requests\UpdatetaskRequest;
use App\Repositories\taskRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Project;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Task;

class taskController extends AppBaseController
{
    /** @var taskRepository $taskRepository*/
    private $taskRepository;

    public function __construct(taskRepository $taskRepo)
    {
        $this->taskRepository = $taskRepo;
    }

    /**
     * Display a listing of the task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id  = $request->project_id;
        $tasks = Task::where('project_id',$project_id)->orderBy('priority', 'ASC')->get();
        // dd($tasks);
        $projects = Project::get()->pluck('name', 'id')->toArray();

        return view('tasks.index')
            ->with(['tasks' =>  $tasks, 'projects' => $projects ]);
    }

    /**
     * Show the form for creating a new task.
     *
     * @return Response
     */
    public function create()
    {
        $projects = Project::get()->pluck('name', 'id')->toArray();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param CreatetaskRequest $request
     *
     * @return Response
     */
    public function store(CreatetaskRequest $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->create($input);
        $project_id = $request->project_id;
        Flash::success('Task saved successfully.');

        return redirect(route('tasks.index',['project_id' => $project_id ]));
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $task = Task::with('project')->find($id);
        $project_id = $task->project_id;
        // dd($project_id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index',['project_id' => $project_id ]));
        }

        return view('tasks.show')->with(['task' => $task , 'project_id' => $project_id ]);
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $task = $this->taskRepository->find($id);
        $project_id = $task->project_id;
        $projects = Project::get()->pluck('name', 'id')->toArray();

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index',['project_id' => $project_id ]));
        }

        return view('tasks.edit')->with(['task' => $task, 'projects' => $projects , 'project_id' => $project_id ]);
    }

    /**
     * Update the specified task in storage.
     *
     * @param int $id
     * @param UpdatetaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetaskRequest $request)
    {
        $task = $this->taskRepository->find($id);
        $project_id = $task->project_id;

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index',['project_id' => $project_id ]));
        }

        $task = $this->taskRepository->update($request->all(), $id);

        Flash::success('Task updated successfully.');

        return redirect(route('tasks.index',['project_id' => $project_id ]));
    }

    /**
     * Remove the specified task from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->find($id);
        $project_id = $task->project_id;

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index',['project_id' => $project_id ]));
        }

        $this->taskRepository->delete($id);

        Flash::success('Task deleted successfully.');

        return redirect(route('tasks.index',['project_id' => $project_id ]));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            // dd($arr);
            foreach($arr as $sortOrder => $id){
                $task = Task::find($id);
                $task->priority = $sortOrder + 1;
                $task->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }

    
}



