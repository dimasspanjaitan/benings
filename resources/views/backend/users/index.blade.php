@extends('backend.layouts.master')

@section('title',"Bening's || User Page")
@section('main-content')

 <!-- DataTales User -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Users List</h6>
      <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add User</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if (count($users)>0)
          <table class="table table-bordered" id="user-dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Level</th>
                <th>Region</th>
                <th>Photo</th>
                <th>Join Date</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th>ID</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Level</th>
                  <th>Region</th>
                  <th>Photo</th>
                  <th>Join Date</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
              @foreach($users as $user)   
                  <tr>
                      <td>{{ $user->id }}</td>
                      <td>
                          @if($user->status==1)
                              <span class="badge badge-success">Active</span>
                          @else
                              <span class="badge badge-warning">Inactive</span>
                          @endif
                      </td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}</td>
                      <td>{{ (!empty($user->levels->name)) ? $user->levels->name : '' }}</td>
                      <td>{{ (!empty($user->regions->name)) ? $user->regions->name : '' }}</td>
                      <td>
                          @if($user->photo)
                              <img src="{{ $user->photo }}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{ $user->photo }}">
                          @else
                              <img src="{{ asset('backend/img/avatar.png') }}" class="img-fluid rounded-circle" style="max-width:50px" alt="avatar.png">
                          @endif
                      </td>
                      <td>{{ (($user->created_at)? $user->created_at->diffForHumans() : '') }}</td>
                      <td>{{  ($user->role==1) ? 'Admin' : 'User'  }}</td>
                      <td>
                          <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{ route('users.destroy',[$user->id]) }}">
                        @csrf 
                        @method('delete')
                            <button class="btn btn-danger btn-sm dltBtn" data-id={{ $user->id }} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                          </form>
                      </td>
                  </tr>  
              @endforeach
            </tbody>
          </table>

          @include('backend.layouts.pagination');
        @else
          <h6 class="text-center">No sales found!!! Please create sale</h6>
        @endif
        
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#user-dataTable').DataTable( {
        "paging": false,
        "info" : false
      } );

      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush