@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>User List</h5>
                    <div class="ibox-tools">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="wrapper wrapper-content animated fadeIn">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-responsive dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <!-- <th>Role</th> -->
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td width="30%">{{$user->name}}</td>
                                            <td width="30%">{{$user->position}}</td>
                                            <!-- <td width="22%">{{$user->role ? $user->role : 'N/A'}}</td> -->
                                            <td width="30%">{{$user->email}}</td>
                                            <td width="10%" align="center">
                                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=""><i class="fa fa fa-pencil"></i><a href=""></a></button> -->
                                                <a href="{{ route('users.delete', ['id' => $user->id]) }}">
                                                <button type="button" class="btn btn-danger btn-outline" title="Delete User"><i class="fa fa fa-ban"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="POST" action="{{url('new_user')}}" autocomplete="off">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add User</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-10">
                            <label>Name</label>
                            <input name="name" class="form-control" type="text" placeholder="Enter Name" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Position</label>
                            <select name="position" id="position" class="form-control selectpicker" title="Select Position" required>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Asst. Manager">Asst. Manager</option>
                                <option value="Manager">Manager</option>
                                <option value="Plant Manager">Plant Manager</option>
                                <option value="President">President</option>
                            </select>
                        </div>
                        <!-- <div class="col-12 mb-10">
                            <label>Role</label>
                            <select name="role" id="role" class="form-control selectpicker" title="Select Role">
                                <option value="Approver">Approver</option>
                                <option value="Approver 1">Approver 1</option>
                                <option value="Approver 2">Approver 2</option>
                            </select>
                        </div> -->
                        <div class="col-12 mb-10">
                            <label>Email Address</label>
                            <input name="email" class="form-control" type="text" placeholder="Enter Email Address" required>
                        </div>
                        <div class="col-12 mb-10">
                            <label>Password</label>
                            <input name="password" class="form-control" type="password" placeholder="Enter Password" required>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<style>
    div.dataTables_wrapper div.dataTables_length label {
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 75px;
        display: inline-block;
    }
    div.dataTables_wrapper div.dataTables_filter {
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_filter label {
        font-weight: normal;
        white-space: nowrap;
        text-align: left;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }
    div.dataTables_wrapper div.dataTables_paginate {
        margin: 0;
        white-space: nowrap;
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        margin: 2px 0;
        white-space: nowrap;
    }
    table.dataTable {
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        border-collapse: separate !important;
    }
    .dataTables_empty {
        text-align: center;
    }
    .dataTables_wrapper {
        padding-bottom: 0px;
    }
    .mb-10 {
        margin-bottom: 10px;
    }
</style>
<script>
    $(document).ready(function(){

        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'csv', title: 'Supplier List'},
                {extend: 'excel', title: 'Supplier List'},
                {extend: 'pdf', title: 'Supplier List'},
            ]

        });

    });
</script>
@endsection