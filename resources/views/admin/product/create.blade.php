@extends('admin.layouts.include')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add New Product</h3>

                </div>
                <form action="{{route('product.store')}}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" name="title" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select  name="category_id"  id="category" class="form-control category" required>
                                        <option value="">Choose Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sub Category</label>
                                    <select  name="subcategory_id"  class="form-control maincategory" required>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">SKU</label>
                                    <input type="number" name="sku" readonly value="{{rand(100000, 900000)}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image 1</label>
                                    <input type="file" name="img1" required  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image 2</label>
                                    <input type="file" name="img2" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Image 3</label>
                                    <input type="file" name="img3" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="">Selling Method</label>
                                    <select    name="selling_method" id="method"  class="form-control method" required>
                                        <option value="">Select  Selling Method</option>
                                        <option value="1">Fixed Price Offer</option>
                                        <option value="2">Discount Offer</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""> Price</label>
                                    <input type="number" min="0" name="price" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="number" min="0" name="quantity" required class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row" id="sub" style="display: none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Discount</label>
                                    <input type="number" min="0" name="discount"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" name="s_date"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="datetime-local" name="e_date"  class="form-control">
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" name="description" id="summernote" cols="30" rows="10" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
