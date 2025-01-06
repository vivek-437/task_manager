@extends('layouts.master')
@section('title', 'Project list')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- Left Side: Table Title -->
                        <div class="col-md-6 d-flex align-items-center">
                            <h4 class="card-title mb-0">Projects Table</h4>
                        </div>

                        <!-- Right Side: Search Bar, Add project Button, and Refresh Button -->
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <!-- Search Bar -->
                            <div class="mr-3">
                                <input type="text" id="search-bar" class="form-control" placeholder="Search projects..." />
                            </div>

                            <!-- Add project Button with icon -->
                            <div class="mr-3">
                                <a href="{{ route('project.create') }}" class="btn btn-primary" id="add-project-btn"
                                    title="Add project">
                                    <i class="mdi mdi-plus"></i> Add project
                                </a>
                            </div>


                            <!-- Refresh Button with icon -->
                            <div>
                                <button class="btn btn-secondary" id="refresh-btn">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table">
                        <table id="project-table" class=" display expandable-table dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Project Name</th>
                                    <th>Descirption</th>
                                    <th>Project Category</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic rows will be populated by DataTable -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Include jQuery and DataTable JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#project-table_length').hide();
            // Initialize DataTable with AJAX data
            $('#project-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('project') }}",
                    type: 'GET',
                    dataSrc: function(json) {
                        return json.data;
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'project_name'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'project_category'
                    },
                    {
                        data: 'start_date'
                    },
                    {
                        data: 'end_date'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action',

                    }
                ],
                lengthChange: false

            });


            $('#search-bar').off('keyup').on('keyup', function() {
                table.search($(this).val()).draw();
            });

            $(".dataTables_filter").hide();
           
        });
    </script>
@endsection
