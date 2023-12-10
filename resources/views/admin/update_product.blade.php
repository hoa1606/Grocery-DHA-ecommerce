<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black;
            padding-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;
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

                <div class="div_center">

                    <h1 class="font_size">Update Product</h1>

                    <form action="{{ url('/update_product_confirm', $product->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="div_design">
                            <label for="">Product Title : </label>
                            <input class="text_color" type="text" name="title" placeholder="Write a title"
                                required="" value="{{ $product->title }}">
                        </div>
                        <div class="div_design">
                            <label for="">Product Description : </label>
                            <input class="text_color" type="text" name="description"
                                placeholder="Write a description" required="" value="{{ $product->description }}">
                        </div>
                        <div class="div_design">
                            <label for="">Product Price : </label>
                            <input class="text_color" type="number" name="price" placeholder="Write a price" value="{{ $product->price }}">
                        </div>
                        <div class="div_design">
                            <label for="">Discount Price : </label>
                            <input class="text_color" type="number" name="discount_price"
                                placeholder="Write a discount price" value="{{ $product->discount_price }}">
                        </div>
                        <div class="div_design">
                            <label for="">Product Quantity : </label>
                            <input class="text_color" type="number" min="0" name="quantity"
                                placeholder="Write a quantity" required="" value="{{ $product->quantity }}">
                        </div>
                        <div class="div_design">
                            <label for="">Product Category : </label>
                            <select class="text_color" name="category" required="">
                                <option value="{{ $product->category }}" selected="">{{ $product->category }}
                                </option>

                                @foreach ($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class=" div_design mb-2">
                            <label for="">Image Here : </label>
                            <img style="margin:auto" width="150" height="150"
                                src="/product/{{ $product->image }}" />
                        </div>
                        <div class="div_design">
                            <label for="">Change Image Here : </label>
                            <input type="file" name="image">
                        </div>
                        <div class="div_design">
                            <input type="submit" value="Update Product" class="btn btn-primary">
                        </div>
                    </form>

                </div>

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
