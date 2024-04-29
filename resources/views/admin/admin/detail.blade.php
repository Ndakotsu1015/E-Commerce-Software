@extends('admin.layout.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Admin Details</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body p-3 mx-3 my-3" style="margin-top:10px;">
                                <div class="mb-3">
                                    <strong><span class="text-primary p-2">Admin
                                            Details</span></strong>
                                </div>
                                @if (!$getRecord)
                                    No records found.
                                @endif
                                {{-- @foreach ($getRecord as $value) --}}
                                {{-- <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Name:</p> <span>{{ $value->name }}</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="mb-0">User Type:</p> <span>{{ $value->user_type }}</span>
                                            </div>
                                            <div class="col-sm-3">
                                                <p class="mb-0">Status:</p> <span>{{ $value->status }}</span>
                                            </div>
                                            <div class="col-sm-3 mb-5">
                                                <p class="mb-0">Created Date:</p>
                                                <span>{{ date('d-m-Y', strtotime($value->created_at)) }}</span>
                                            </div>
                                        </div> --}}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Name:</p> <span>{{ $getRecord->name }}</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="mb-0">User Type:</p> <span>Admin</span>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="mb-0">Status:</p> <span>Active</span>
                                    </div>
                                    <div class="col-sm-3 mb-5">
                                        <p class="mb-0">Created Date:</p>
                                        <span>12-11-2024</span>
                                    </div>
                                </div>
                                {{-- @endforeach
                                @endif --}}


                            </div>
                            <hr>
                            <div class="p-3">
                                <a href="{{ url('admin/admin/edit/' . $getRecord->id) }}" class=" btn btn-primary">Edit</a>
                            </div>
                        </div>

                    </div>




                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
@endsection
