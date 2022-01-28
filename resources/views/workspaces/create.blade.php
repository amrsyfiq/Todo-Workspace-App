<!-- Author : Muhammad Amir Syafiq -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Create your workspace here!') }}
                </div>
            </div>

            <div class="float-start">
                <h4 class="pb-3">{{ __('Create Workspaces') }}</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('workspace.index') }}" class="btn btn-info float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> All Workspace</a> 
            </div>
            <div class="clearfix"></div>

            <div class="card card-body bg-light p-4">
                <form action="{{ route('workspace.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control mb-2" id="title" name="title" placeholder="Enter title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description" rows="5" placeholder="Enter description"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
                    <a href="{{ route('workspace.index') }}" class="btn btn-default"> Back</a>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
