@extends('layouts.master')
@section('title', 'Create Role')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Role</h4>
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="role_name">Role Name</label>
                            <input type="text" name="role_name" id="role_name" class="form-control" value="">
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
