<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
    .center {
        margin: auto;
        width: 50%;
    }

    .image_size {
        width: 200px !important;
        height: 200px !important;
        border-radius: 0 !important;
    }
    .font{
        font-size: 35px;
        margin-top: -50px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                <div class="alert alert-success">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                    {{ session()->get('message') }}

                </div>
                @endif
                <p class="text-center p-5 fs-1 fw-bold font">All Product</p>
                <table class="table table-bordered border-5 center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Product title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount Price</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Delete & Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->title}}</th>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td>

                                <img class="image_size" src="/product/{{$product->image}}" />
                            </td>
                            <td>
                                <a class="btn btn-danger float-end" href="{{url('delete_product',$product->id)}}"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">Delete</a>
                                <a class="btn btn-success float-start"
                                    href="{{url('update_product',$product->id)}}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>