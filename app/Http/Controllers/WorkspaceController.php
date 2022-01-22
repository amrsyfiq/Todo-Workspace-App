<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workspaces = Workspace::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('workspaces.index', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workspaces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $workspace = new Workspace();

        $workspace->title = $request->title;
        $workspace->description = $request->description;
        $workspace->user_id = Auth::user()->id;
        $workspace->save();

        return redirect()->route('workspace.index');
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
        $workspace = Workspace::findOrFail($id);
        $this->authorize('update', $workspace);

        return view('workspaces.edit', compact('workspace'));
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
        $workspace = Workspace::findOrFail($id);
        $this->authorize('update', $workspace);

        $request->validate([
            'title' => 'required|max:255'
        ]);
        $workspace->title = $request->title;
        $workspace->description = $request->description;
        $workspace->save();

        return redirect()->route('workspace.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workspace = Workspace::findOrFail($id);
        $this->authorize('delete', $workspace);

        $workspace->delete();
        return redirect()->route('workspace.index');
    }
}
