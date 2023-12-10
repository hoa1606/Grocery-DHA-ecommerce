<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">


    .title_deg{
        text-align: center;
        font-size: 25dp;
        font-weight: bold;
        padding-bottom: 40dp;
    }
    .table_deg{
        border: 2px solid white;
        width: 100%;
        margin: auto;
        text-align: center;
    }
    .th_deg{
        background-color: skyblue;
        padding: 10px;
    }
    .img_size{
        width: 100px;
        height: 100px;
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

                <h1 class="title_deg">All Order</h1>
                <div style="margin-left: 400px; padding-bottom: 30px;">
                  <form action="{{url('search')}}" method="get">
                  @csrf

                    <input style="color: black;" type="text" name="search" placeholder="Search for something...">
                    <input type="submit" value="search" class="btn btn-outline-primary" >

                  </form>
                </div>
                <table class="table_deg"> 
                    <tr class="th_deg">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>product title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th >Image</th>
                        <th >Delivered</th>
                        <th >Send Email</th>
                    </tr>

                     @forelse($order as $order)

                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->Address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$order->image}}">
                        </td>
                        <td>
                          @if($order->delivery_status == 'processing')
                            <a href="{{url('delivered', $order->id)}}" onclick="return confirm('Are you sure this product is delivered !!!')" class="btn btn-primary">Delivered</a>
                          @else
                            <p style="color: green;">Delivered</p>
                          @endif
                        </td>

                        <td>
                          <a href="{{url('send_email', $order->id)}}" class= "btn btn-info">Send Email</a>
                        </td>
                    </tr>

                    @empty

                   <tr>
                    <td colspan="16">
                      No data found
                    </td>
                   </tr>
                    @endforelse
                    
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