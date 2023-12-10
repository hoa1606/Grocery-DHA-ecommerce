<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')

    <!-- Style -->
    <style type="text/css">

        label {
            display: inline-block;
            width:300px;
            font-size:15px;
            font-weight:bold;
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

            <h1 style= " text-align: center; font-site:25px;">Send Email to {{$order->email}}</h1>
            <form action= "{{url('send_user_email',$order->id)}}" method="POST">
                @csrf 
            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Greeting: 
                </label>

                <input type="text" name="greeting">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Firstling: 
                </label>

                <input type="text" name="firstline">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Body: 
                </label>

                <input type="text" name="body">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Button: 
                </label>

                <input type="text" name="button">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Url: 
                </label>

                <input type="text" name="url">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
                <label  for="">
                    Email Last Line: 
                </label>

                <input type="text" name="lastline">
            </div>

            <div style="padding-left: 20%; padding-top : 30px">
               

                <input type="submit" value= " Send Email" class="btn btn-primary" name="body">
            </div>
    </form>
        </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('admin.footer')
          <!-- partial -->
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