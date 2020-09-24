@extends('layouts.main-app')

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <span style="font-size: 18px;">Greenhouses</span>
                        <div class="card-action">
                            <a href="{{route("greenhouses.create")}}"
                               class="btn btn-sm btn-light waves-effect waves-light m-1">Add
                                Greenhouse
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @include("layouts.partials.alerts")

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Account Holder</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($greenhouses as $greenhouse)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$greenhouse->code}}</td>
                                        <td>{{$greenhouse->owner->name}}</td>
                                        <td>{{$greenhouse->name}}</td>
                                        <td>
                                            <a type="button" data-toggle="modal" data-target="#deleteGreenhouse"
                                               data-delete-url="{{route("greenhouses.destroy",["greenhouse"=>$greenhouse->id])}}"
                                               class="btn btn-sm btn-danger waves-effect waves-light m-1 setDelUrl"><i
                                                    class="fas fa-trash-alt"></i> <span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Greenhouse nodes provision</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade show" id="deleteGreenhouse" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Greenhouse?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="del-greenhouse-frm" method="post">
                    <div class="modal-body">
                        @csrf
                        @method("delete")
                        <p>You are about to delete a Greenhouse node, this action is not reversible. Are you sure this
                            is what you want to do?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-light px-5"><i
                                class="fa fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-light px-5"><i class="icon-check"></i> Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push("pageJavascript")
    <script>
        $(".setDelUrl").click(function () {
            $("#del-greenhouse-frm").prop("action", $(this).data("delete-url"));
        });
    </script>
@endpush


