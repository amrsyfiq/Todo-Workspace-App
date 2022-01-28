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
                <h4 class="pb-3">{{ __('My Workspaces') }}</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('workspace.create') }}" class="btn btn-info float-right"><i class="fa fa-plus" aria-hidden="true"></i> Create Workspace</a> 
            </div>
            <div class="clearfix"></div>

            @foreach ($workspaces as $workspace)
                <div class="card mb-3">
                    <h5 class="card-header">
                        {{ __($workspace->title) }}
                        <span class="badge rounded-pill bg-light text-dark">Created - {{ __( $workspace->created_at->diffForHumans() ) }}</span>
                    </h5>

                    <div class="card-body">
                        <div class="card-text">
                            <div class="float-start">
                                    {{ __($workspace->description) }}
                                <br>
                                    <span class="badge rounded-pill bg-success text-white">New</span>

                                <small>Last Updated - {{ __( $workspace->updated_at->diffForHumans() ) }}</small>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('task.index', $workspace->id) }}" class="btn btn-info"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                <a href="{{ route('workspace.edit', $workspace->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <form action="{{ route('workspace.destroy', $workspace->id) }}" style="display: inline" method="POST">
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

            @if (count($workspaces) === 0)
                <div class="alert alert-danger p-2">
                    {{ __('No Workspace Found. Please create a workspace') }}
                    <a href="{{ route('workspace.create') }}"> here</a> !
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
