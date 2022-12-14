@extends('admin.layouts.include')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php $user = Auth::user(); ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
                            <a  href="{{route('product.create')}}" style="margin-left: 30px;" class="btn btn-primary btn-sm float-right">Add New Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->description}}</td>
                                        <td><img style="width:60px; height: 50px; border-radius:20px; "
                                                 src="{{asset($row->img1)}}" alt="">
                                        </td>
                                        <td>
                                            @if($row->status == 0)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-warning">De-Active</span>
                                            @endif
                                        </td>
                                        <td>{{$row->user->name}}</td>
                                        <td>
                                            @if($row->status == 1 || $user->role != 2)
                                                <a href="{{route('category.edit' ,$row->id)}}" data-toggle="modal"
                                                   data-target="#categoryedit{{$row->id}}" class="btn btn-sm btn-primary"
                                                   title="edit">
                                                    <i class="fa fa-pen"></i> Edit
                                                </a>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="categoryedit{{$row->id}}" tabindex="-1"
                                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('category.update',$row->id)}}"
                                                                      method="post" enctype="multipart/form-data"
                                                                      data-parsley-validate>
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="title"><b>Category</b><span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" value="{{$row->name}}"
                                                                                   name="name" required
                                                                                   placeholder="Category Name"
                                                                                   class="form-control">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="title"><b>Image</b><span class="text-danger">*</span></label>
                                                                            <input type="file" name="image" class="form-control">
                                                                        </div>
                                                                        <span style="font-weight: bold;"> Old Image</span><br>
                                                                        <img src="{{asset($row->img)}}" alt="" width="80px" height="80px"><br>
                                                                    </div>

                                                                    <div class="col-md-12 pull-right">
                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary btn-block">Update
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                            <!-- End of Edit Modal -->

                                            <!-- Delete section -->
                                            <a href="{{route('product.destroy' ,$row->id)}}" id="delete"
                                               class="btn btn-sm btn-danger" data-toggle="tooltip" title="edit">
                                                <i class="fa fa-times"></i> Delete
                                            </a>
                                            @if($row->status == 1 && $user->role == 1)
                                                <a href="{{route('product.approve' , $row->id)}}" id="approve"
                                                   class="btn btn-sm btn-warning" data-toggle="tooltip" title="edit">
                                                    <i class="fa fa-user"></i> Approve
                                                </a>
                                            @endif
                                            <!-- End of delete -->
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
