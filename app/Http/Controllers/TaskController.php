<?php

namespace App\Http\Controllers;

// Author : Muhammad Amir Syafiq

use App\Models\Task;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Workspace $workspace)
    {
        $this->authorize('view', $workspace);

        $tasks = $workspace->tasks()->get();

        return view('tasks.index', compact('tasks', 'workspace'));
    }

    public function create(Workspace $workspace)
    {
        $this->authorize('create', $workspace);

        $statuses = [
            [
                'label' => 'Incomplete',
                'value' => 'Incomplete',
            ],
            [
                'label' => 'Complete',
                'value' => 'Complete',
            ]
        ];
        return view('tasks.create', compact('statuses', 'workspace'));
    }

    public function store(Request $request, Workspace $workspace)
    {
        $this->authorize('create', $workspace);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'date' => 'required',
            'time' => 'required',
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due = new Carbon($validated['date'] . ' ' . $validated['time']);
        $task->status = $request->status;
        $task->user_id = Auth::user()->id;
        $task->workspace_id = $workspace->id;

        $workspace->tasks()->save($task);

        return redirect()->route('task.index', $workspace);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('update', $task);
        $workspace = $task->workspace;

        $statuses = [
            [
                'label' => 'Incomplete',
                'value' => 'Incomplete',
            ],
            [
                'label' => 'Complete',
                'value' => 'Complete',
            ]
        ];
        return view('tasks.edit', compact('statuses', 'task', 'workspace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('update', $task);
        $workspace = $task->workspace;

        $request->validate([
            'title' => 'required|max:255'
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('task.index', $workspace->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $this->authorize('delete', $task);
        $workspace = $task->workspace;

        $task->delete();

        return redirect()->route('task.index', $workspace->id);
    }
}
