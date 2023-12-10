<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;

use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller{


    public function blog_list()
    {
        return view('home.blog_list');
    }
    
    public function index()
    {
        $product = Product::paginate(3);
        $category = Category::all();
        return view('home.userpage', compact('product', 'category'));
    }


    public function products()
    {
        $product= Product::all();
        return view('home.productpage',compact('product'));
    }

    public function products_cat($id)
    {
        $product= Product::where('category','=',$id)->get();
        return view('home.productpage',compact('product'));
    }
    public function showAllproducts()
    {
        $product= Product::all();
        return view('home.productpage',compact('product'));
    } 
    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            // dem so luong data in products
            $total_product = product::all()->count();

            $total_order = order::all()->count();

            $total_user = user::all()->count();

            $order = order::all();

            $total_revenue=0;

            foreach ($order as $order)
            {
                $total_revenue= $total_revenue + $order-> price;
            }

            $total_delivered = order::where('delivery_status','=','Delivered')->get()->count();

            $total_processing = order::where('delivery_status','=','processing')->get()->count();



            return view('admin.home',compact('total_product','total_order','total_user','order','total_revenue','total_delivered','total_processing'));
        } else {
            $product = Product::paginate(3);
            $category = Category::all();
            return view('home.userpage', compact('product', 'category'));
        }
    }

    public function product_details($id)
    {
        $product = product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        // Xử lý phần chưa đăng nhập
        
        $this->middleware('check.auth');

        // xử lý phần đã đăng nhập
        
        $user=Auth::user();
        
        $product=product::find($id);
        
        $cart=new cart;
        
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->phone=$user->phone;
        $cart->address=$user->address;
        $cart->user_id=$user->id;
        
        $cart->Product_title=$product->title;
        
        if($product->discount_price!=null)
        {
            $cart->price=$product->discount_price * $request->quantity;
        }
        else
        {
            $cart->price=$product->price * $request->quantity;
        }
        
        $cart->image=$product->image;
        $cart->Product_id=$product->id;

        $cart->quantity=$request->quantity;

        $cart->save();
        Alert::success('Product added successfully!','We have add product to the cart');

        return redirect()->back();
    }
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();

            return view('home.show_cart',compact('cart'));
        }
        else 
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();

        return redirect()->back();
    }

    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        
        $data=cart::where('user_id','=',$userid)->get();
        
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have Received your Order. We will connect with you soon');

    }
    public function stripe($totalprice)
    {
         return view('home.stripe',compact('totalprice'));
     }

    public function stripePost(Request $request, $totalprice)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment." 
        ]);
        
        $user=Auth::user();
        $userid=$user->id;
        
        $data=cart::where('user_id','=',$userid)->get();
        
        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;

            $order->payment_status='Paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }



            //Dùng lệnh Session bị báo lỗi 
            //Session::flash('success', 'Payment successful!');
            
            return redirect()->back()->with('success', 'Payment successful!');
              
        return back();
    }


    public function show_order()
    {
        if(Auth::id())
        {   
            $user=Auth::user();    

            $userid=$user->id;

            $order=order::where('user_id','=',$userid)->get();

            return view('home.order', compact('order')); 
        }
        else
        {
            return redirect('login');
        }

    }

    public function cancel_order($id)
    {
        $order=order::find($id);

        $order->delivery_status='You canceled the order';

        $order->save();

        return redirect()->back();
    }

    public function product_search(Request $request)
    {
        $search_text=$request->search;

        $product=product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(10);

        return view('home.userpage', compact('product'));
    }
    public function product_search2(Request $request)
    {
        $search_text=$request->search;

        $product=product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(10);

        return view('home.productpage', compact('product'));
    }

    public function testimonial()
    {
        return view('home.testimonial');
    }
    public function about()
    {
        return view('home.about');
    }
    public function contact()
    {
        return view('home.contact');
    }
}