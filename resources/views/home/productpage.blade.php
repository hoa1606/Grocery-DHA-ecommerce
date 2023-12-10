<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    @include('sweetalert::alert')
    <div>
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <!-- inner page section -->
    <section class="inner_page_head">
        <div class="container_fuild">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <h3>Product Grid</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end inner page section -->
    <!-- product section -->
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                
                <div>
                    <form action="{{url('product_search2')}}" method="GET">
                        @csrf
                        <input style="width: 500px; " type="text" name="search" placeholder="Search for Something">
                        <input type="submit" value="search">
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{url('product_details',$products->id)}}" class="option1">
                                    ProductDetails
                                </a>
                                <form action="{{url('add_cart',$products->id)}}" method="Post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="number" name="quantity" value="1" min="1" style="width: 100px">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Add To Cart">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img width="150px" height="150px" src="/product/{{$products->image}}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{$products->title}}
                            </h5>
                            <h6>
                                {{$products->price}}
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--<div class="btn-box">
               <a href="">
               View All products
               </a>
            </div>-->
        </div>
    </section>
    <!-- end product section -->
    <!-- footer section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <!-- footer section -->
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>