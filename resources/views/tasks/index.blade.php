<!-- Author : Muhammad Amir Syafiq -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="float-start">
                <h4 class="pb-3">{{ __('My Tasks') }}</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('workspace.index') }}" class="btn btn-info float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Workspace</a> 
                <a href="{{ route('task.create', $workspace->id) }}" class="btn btn-info float-right"><i class="fa fa-plus" aria-hidden="true"></i> Create Task</a> 
            </div>
            <div class="clearfix"></div>

            @foreach ($tasks as $task)
                <div class="card mb-3">
                    <h5 class="card-header">
                        @if ($task->status === 'Incomplete')
                            {{ __($task->title) }}
                            <span class="badge rounded-pill bg-light text-dark">Due - {{ \Carbon\Carbon::create($task->due)->diffForHumans() }}</span>
                        @else
                            <del>{{ __($task->title) }}</del> 
                            <span class="badge rounded-pill bg-light text-dark">Completed - {{ __( $task->updated_at->diffForHumans() ) }}</span>
                        @endif
                    </h5>

                    <div class="card-body">
                        <div class="card-text">
                            <div class="float-start">
                                @if ($task->status === 'Incomplete')
                                    {{ __($task->description) }}
                                @else
                                    <del>{{ __($task->description) }}</del>
                                @endif
                                <br>
                                
                                @if ($task->status === 'Incomplete')
                                    <span class="badge rounded-pill bg-danger text-white">Incomplete</span>
                                @else
                                    <span class="badge rounded-pill bg-success text-white">Complete</span>
                                @endif

                                <small>Last Updated - {{ __( $task->updated_at->diffForHumans() ) }}</small>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form action="{{ route('task.destroy', $task->id) }}" style="display: inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" style="color: #000;"aria-hidden="true"></i></button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (count($tasks) === 0)
                <div class="alert alert-danger p-2">
                    {{ __('No Task Found. Please create a task') }}
                    <a href="{{ route('task.create', $workspace->id) }}"> here</a> !
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
