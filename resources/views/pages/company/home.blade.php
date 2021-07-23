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
                    <h1>{{ __('Companies') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Companies</li>
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#company-modal"><i class="fa fa-plus"></i> Add Company</button>
                        </div>
                    </div>
                </div>

                <!-- card body -->
                <div class="card-body">
                    @csrf
                    <div class="table responsive">
                        <table id="companyTable" class="table table-hover">
                            <thead>
                                <th>Company Name</th>
                                <th>Company Email</th>
                                <th>Website</th>
                                <th>Date Added</th>
                                <th>Date Modified</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if (count($companies) > 0 )
                                @foreach($companies ?? '' as $company)
                                <tr>
                                    <td>{{ $company->name ?? ''}}</td>
                                    <td>{{ $company->email ?? ''}}</td>
                                    <td>{{ $company->website ?? '' }}</td>
                                    <td>{{ $company->created_at->format('j M, Y') }}</td>
                                    <td>{{ $company->updated_at->format('j M, Y') }}</td>
                                    <td>
                                        <button onclick="showCompany('{{ $company->id }}')" class="btn btn-sm btn-primary rounded-circle edit mx-1 mt-n1"><i class="far fa-edit"></i></button>
                                        <button onclick="deleteCompany('{{ $company->id }}')" class="btn btn-sm btn-danger rounded-circle edit mx-5 mt-n1"><i class="far fa-trash-alt"></i></button>
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

<div class="modal fade" id="company-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #4ba1e2;">
            <div class="modal-header">
                <h4 class="modal-title">Company Details</h4>
            </div>
            <div class="modal-body">
                <form id="addCompany">
                    @csrf

                    <input type="hidden" name="id" id="company_id" value="">
                    <div class="row">
                        <div class="col-md-8 col-lg-8">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input class="form-control" name="name" id="name" placeholder="eg: RealStudios" type="text" :value="old('name')" required autofocus autocomplete="name">
                            </div>

                            <div class="form-group">
                                <label for="type">Company Email</label>
                                <input class="form-control" name="email" id="email" placeholder="eg: me@example.com" type="email" required autocomplete="email">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="user-image mt-1">
                                <img width="128px" class="brand-image img-circle elevation-2 mt-4" id="show-logo" src="storage/avatar_default.jpg" alt="{{-- $user->first_name --}}">
                                <input type="file" class="d-none" accept="image/*" name="logo-file" id="logo-file" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="type">Website</label>
                        <input class="form-control" name="website" id="website" placeholder="eg: www.example.com" type="text" required autocomplete="website">
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                <button class="btn btn-outline-light float-left" id="load_photo" type="button">Load Photo</button>
                <button type="submit" class="btn btn-outline-light" form="addCompany"> <i class="fa fa-plus-circle"></i> Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@push('js')
<script src="{{ asset('js/company.js') }}"></script>
@endpush

@endsection