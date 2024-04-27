@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
	<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Room No </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.room') }}" class="btn btn-primary px-5">Add Room </a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->



    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($rooms as $key=> $item )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> {{ $item->type->name }}  </td>
                            <td>{{ $item->room_no ?: 'No number' }}</td>
                            <td>{{ $item->displayPrice() }}</td>
                            <td>
                                <img src="{{ $item->imageUrl() }}" width="92" alt="">
                            </td>
                            <td>
                                <div class="btn btn-group">
                                <a href="{{ route('edit.room',$item->id) }}" class="btn btn-warning px-3 radius-30"> Edit</a>
                                <a href="{{ route('delete.room',$item->id) }}" class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <hr/>

</div>




@endsection