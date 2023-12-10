<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {

        $data = category::all();

        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new category;

        $category->category_name = $request->category;

        $image = $request->file('image'); // Sử dụng file() thay vì image
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move('product', $imagename);

        $category->category_img = $imagename; // Đảm bảo tên cột trong cơ sở dữ liệu là "image"

        $category->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function view_product()
    {
        $category = category::all();

        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description ?: null;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        $image = $request->file('image'); // Sử dụng file() thay vì image
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move('product', $imagename);

        $product->image = $imagename; // Đảm bảo tên cột trong cơ sở dữ liệu là "image"


        $product->save();

        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $products = Product::all();
        return view('admin.show_product',compact('products'));
    }

    public function delete_product($id)
    {
        $product = product::find($id);
        
        $product->delete();
        return redirect()->back()->with('message','Product delete successfully!');
    }
    public function update_product($id)
    {
        $product = product::find($id);
        $category = Category::all();
        
        return view('admin.update_product',compact('product','category'));
    }
    
    public function update_product_confirm(Request $request,$id)
    {
        $product = product::find($id);

        $product->title = $request->title;
        $product->description = $request->description ;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;
        
        $image= $request->image;
        if($image)
        {
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename; // Đảm bảo tên cột trong cơ sở dữ liệu là "image"
        }
        
        $product->save();

        return redirect()->back()->with('message', 'Product Update Successfully');
        
    }

    public function order()
    {
        $order=order::all();

        return view('admin.order', compact('order'));

    }

    public function delivered($id){

        $order=order::find($id);

        $order->delivery_status ="delivered";

        $order->payment_status = 'Paid';

        $order->save();

        return  redirect()->back();
    }

    public function send_email($id) 
    {

        $order= order::find($id);
        return view('admin.email_info',compact('order'));

    }

    public function send_user_email( Request $request,$id)
    {
        $order= order::find($id);

        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=> $request->lastline,
        ];

        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back();
    }

    public function searchdata(Request $request)
    {
        $searchText=$request->search;

        $order=order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();

        return view('admin.order',compact('order'));
    }

}