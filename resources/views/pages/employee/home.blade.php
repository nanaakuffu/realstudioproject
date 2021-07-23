@extends('layout')
@section('content')
<style>
    .content-row:hover {
        background-color: #ebebeb;
    }

    .content-row:hover {
        background-color: #ebebeb;
    }

    tr button.edit {
        display: none;
    }

    tr:hover button.edit {
        display: block;
        position: absolute;
        margin: auto;
        z-index: 555555555 !important;
    }

    /* tr:hover span.badge {
        opacity: 0;
        position: relative;
        z-index: 555;
    } */
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Employees') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ol>
                </div>
            </div><!-- /.container-fluid -->
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card card-widget">
                <div class="card-header">
                    <div class="user-block">
                        <div class="float-right">
                            <button class="btn btn-info" data-toggle="modal" data-target="#employee-modal"><i class="fa fa-plus"></i> Add Employee</button>
                        </div>
                    </div>
                </div>

                <!-- card body -->
                <div class="card-body">
                    @csrf
                    <div class="table responsive">
                        <table id="employeeTable" class="table table-hover">
                            <thead>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Date Added</th>
                                <th>Date Modified</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if (count($employees) > 0 )
                                @foreach($employees ?? '' as $employee)
                                <tr>
                                    <td>{{ $employee->fullName ?? ''}}</td>
                                    <td>{{ $employee->email ?? ''}}</td>
                                    <td>{{ $employee->companyName ?? '' }}</td>
                                    <td>{{ $employee->phone ?? ''}}</td>
                                    <td>{{ $employee->created_at->format('j M, Y') }}</td>
                                    <td>{{ $employee->updated_at->format('j M, Y') }}</td>
                                    <td>
                                        <button onclick="showEmployee('{{ $employee->id }}')" class="btn btn-sm btn-primary rounded-circle edit mx-1 mt-n1"><i class="far fa-edit"></i></button>
                                        <button onclick="deleteEmployee('{{ $employee->id }}')" class="btn btn-sm btn-danger rounded-circle edit mx-5 mt-n1"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end row of content-->
            </div>
        </div>

    </section>

</div>

<div class="modal fade" id="employee-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #4ba1e2;">
            <div class="modal-header">
                <h4 class="modal-title">Employee Details</h4>
            </div>
            <div class="modal-body">
                <form id="addEmployee">
                    @csrf

                    <input type="hidden" name="id" id="employee_id" value="">
                    <div class="row">
                        <div class="col-md-8 col-lg-8">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input class="form-control" name="first_name" id="first_name" placeholder="eg: John" type="text" :value="old('first_name')" required autofocus autocomplete="name">
                            </div>

                            <div class="form-group">
                                <label for="type">Last Name</label>
                                <input class="form-control" name="last_name" id="last_name" placeholder="eg: Doe" type="text" required autocomplete="last_name">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="user-image mt-1">
                                <img width="128px" class="brand-image img-circle elevation-2 mt-4" id="show-picture" src="storage/avatar_default.jpg" alt="{{-- $user->first_name --}}">
                                <input type="file" class="d-none" accept="image/*" name="picture-file" id="picture-file" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type">Email</label>
                        <input class="form-control" name="email" id="email" placeholder="eg: johndoe@example.com" type="email" required autocomplete="email">
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input class="form-control" name="phone" id="phone" placeholder="eg: 020000000" type="text" :value="old('phone')" autofocus autocomplete="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="type">Company</label>
                                <select name="company" id="company" class="form-control" required>
                                    <option>-- Select Class --</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button class="btn btn-outline-light float-left" id="load_photo" type="button">Load Photo</button>
                <button type="submit" class="btn btn-outline-light" form="addEmployee"> <i class="fa fa-plus-circle"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@push('js')
<script src="{{ asset('js/employee.js') }}"></script>
@endpush

@endsection