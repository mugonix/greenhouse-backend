@extends('layouts.main-app')

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        User Management
                        <a href="{{route("user-management.create")}}"
                           class="float-right btn btn-sm btn-light">Add User</a>
                    </div>

                    <div class="card-body">
                        @include("layouts.partials.alerts")

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-responsive-md table-striped" id="tbl">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tblBody">
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->role->display_name}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>
                                                @if(!$user->is_approved)
                                                    <a data-user-id="{{$user->id}}" data-name="{{$user->name}}"
                                                       href="#approveAccount"
                                                       data-toggle="modal" class="btn btn-sm btn-success approveClick">Approve</a>
                                                @endif
                                                <a href="{{route("user-management.edit",["user"=>$user->id])}}"
                                                   class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-bold">
                                                <strong>You are the only user on the system.</strong>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal fade" id="approveAccount" tabindex="-1" role="dialog"
                             aria-labelledby="approveAccount" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Approve Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="approveAccountFrm" method="post"
                                          action="{{route("user-management.approve-account")}}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" id="txtUserIdFrm">
                                            <p>Are you sure you would like to approve <strong
                                                    id="txtFullnameFrm"></strong>'s account?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No,
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Yes, Approve Account</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".approveClick").click(function () {
                $("#txtUserIdFrm").val($(this).data("user-id"));
                $("#txtFullnameFrm").html($(this).data("name"));
            });
        })
    </script>
@endsection
