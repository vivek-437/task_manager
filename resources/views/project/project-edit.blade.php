@extends('layouts.master')
@section('title', 'Project Edit')

@section('content')
<div class="container">
    <h2>Edit Project</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" name="project_name" id="project_name" class="form-control" value="{{ $project->project_name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $project->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="project_category" class="form-label">Project Category</label>
            <input type="text" name="project_category" id="project_category" class="form-control" value="{{ $project->project_category }}" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date }}">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection
