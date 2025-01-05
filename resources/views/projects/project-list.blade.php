@extends('layouts.master')
@section('title', 'Project list')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Roles Table</h4>
                    <p class="card-description">
                        Add class <code>.table</code> for styling the table.
                    </p>

                    <!-- Search Bar -->
                    <div class="mb-3">
                        <input type="text" id="search-bar" class="form-control" placeholder="Search roles..." />
                    </div>

                    <!-- Add Role Button -->
                    <div class="mb-3">
                        <button class="btn btn-primary" id="add-role-btn">Add Role</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Profile</th>
                                    <th>VatNo.</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="role-table-body">
                                <tr>
                                    <td>Jacob</td>
                                    <td>53275531</td>
                                    <td>12 May 2017</td>
                                    <td><label class="badge badge-danger">Pending</label></td>
                                </tr>
                                <tr>
                                    <td>Messsy</td>
                                    <td>53275532</td>
                                    <td>15 May 2017</td>
                                    <td><label class="badge badge-warning">In progress</label></td>
                                </tr>
                                <tr>
                                    <td>John</td>
                                    <td>53275533</td>
                                    <td>14 May 2017</td>
                                    <td><label class="badge badge-info">Fixed</label></td>
                                </tr>
                                <tr>
                                    <td>Peter</td>
                                    <td>53275534</td>
                                    <td>16 May 2017</td>
                                    <td><label class="badge badge-success">Completed</label></td>
                                </tr>
                                <tr>
                                    <td>Dave</td>
                                    <td>53275535</td>
                                    <td>20 May 2017</td>
                                    <td><label class="badge badge-warning">In progress</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('script')
    <script>
        // Search functionality for the table
        document.getElementById('search-bar').addEventListener('input', function(e) {
            let filter = e.target.value.toLowerCase();
            let rows = document.querySelectorAll('#role-table-body tr');

            rows.forEach(function(row) {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Add Role button functionality (placeholder)
        document.getElementById('add-role-btn').addEventListener('click', function() {
            alert('Add Role button clicked!'); // Replace with your logic to open a modal or redirect
        });
    </script>
@endsection
