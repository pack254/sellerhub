<?php

namespace storeHub\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use storeHub\Product;
use Illuminate\Support\ Facades\Log;
use File;
use Image;
use finfo;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return view('products.index', compact('products'));
    }
    /**
     * Display the specified resource.
     *
     * @param object $request
     * @return Yajra\DataTables\Facades\DataTables
     */
    public function serverside(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $products = Product::select([
                                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                    'product_id',
                                    'product_code',
                                    'product_name',
                                    'product_detail',
                                    'product_cost_price',
                                    'product_sale_price',
                                    'product_quantity']);


        if($keyword = $request->get('search')['value']){
              $datatables = Datatables::of($products);
              $datatables->filterColumn('rownum', function($query, $keyword){
                                      $sql = "@rownum  + 1 like ?";
                                      $query->whereRaw($sql, ["%{$keyword}%"]);
                              });

              return $datatables
                      ->addColumn('product_image', function ($products) {
                          return '<img src="pic/'.$products->product_id.'">';
                      })
                      ->addColumn('action', function ($products) {
                      return '<button  data-info="'.$products->product_id.','.$products->product_code.','.$products->product_name.','.$products->product_detail.','.$products->product_cost_price.','.$products->product_sale_price.','.$products->product_quantity.'" class="edit-modal btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไขข้อมูล</button>
                              <button  data-info="'.$products->product_id.','.$products->product_code.','.$products->product_name.','.$products->product_detail.','.$products->product_cost_price.','.$products->product_sale_price.','.$products->product_quantity.'" class="delete-modal btn btn-xs btn-danger"><i class="fa fa-trash"></i> ลบข้อมูล</button>';
                      })
                      ->rawColumns(['action','product_image'])
                      ->make(true);
        }

        return DataTables::of($products)
                ->addColumn('product_image', function ($products) {
                    return '<img src="pic/'.$products->product_id.'">';
                })
                ->addColumn('action', function ($products) {
                    return '<button  data-info="'.$products->product_id.','.$products->product_name.','.$products->product_detail.','.$products->product_cost_price.','.$products->product_sale_price.','.$products->product_quantity.'" class="edit-modal btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไขข้อมูล</button>
                            <button  data-info="'.$products->product_id.','.$products->product_name.','.$products->product_detail.','.$products->product_cost_price.','.$products->product_sale_price.','.$products->product_quantity.'" class="delete-modal btn btn-xs btn-danger"><i class="fa fa-trash"></i> ลบข้อมูล</button>';
                })
                ->rawColumns(['action','product_image'])
                ->make(true);
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedProductData = $request->validate([
          'productCode' => 'required|max:200',
          'productName' => 'required|max:200',
          'productDetail' => 'required|max:500',
          'productImage' => 'mimes:jpeg,jpg,png,gif|required|file|image',
          'productCostPrice' => 'required|numeric',
          'productSalePrice' => 'required|numeric',
          'productQuantity' => 'required|numeric',
          'userID' => 'required',
        ]);

        $imageFile = $request->file('productImage');
        $filename = $imageFile->getClientOriginalName() . '.' . $imageFile->getClientOriginalExtension();
        Image::make($imageFile)->resize(90, 90)->save( public_path('/upload/temp/' . $filename ) );
        $imagePath = public_path('/upload/temp/'.$filename );
        if(File::exists($imagePath)) {
            $imageResize = File::get($imagePath);
            unlink($imagePath);
        }

        Product::create(array(
          'product_code' => $request->input('productCode'),
          'product_name' => $request->input('productName'),
          'product_detail' => $request->input('productDetail'),
          'product_image' => $imageResize,
          'product_cost_price' => $request->input('productCostPrice'),
          'product_sale_price' => $request->input('productSalePrice'),
          'product_quantity' => $request->input('productQuantity'),
          'user_id' => $request->input('userID'),
        ));

        return back()->with('success','สิ้นค้าถูกแอดขึ้นฐานข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPicture($id)
    {
        $product = Product::findOrFail($id);
        return response()->make($product->product_image, 200, array('Content-Type' => (new finfo(FILEINFO_MIME))->buffer($product->product_image)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        $validator = Validator::make(Input::all(),[
          'pname' => 'required|max:200',
          'pphoto' => 'mimes:jpeg,jpg,png,gif|file|image',
          'pdetail' => 'required|max:500',
          'pcost' => 'required|numeric',
          'psale' => 'required|numeric',
          'pquantity' => 'required|numeric',]);

        if ($validator->fails()){
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
    }

    // } else {
    //     if($request->hasFile('productImage')){
    //         $imageFile = $request->file('productImage');
    //         $filename = $imageFile->getClientOriginalName() . '.' . $imageFile->getClientOriginalExtension();
    //         Image::make($imageFile)->resize(150, 150)->save( public_path('/upload/temp/' . $filename ) );
    //         $imagePath = public_path('/upload/temp/'.$filename );
    //         if(File::exists($imagePath)) {
    //             $imageResize = File::get($imagePath);
    //             unlink($imagePath);
    //         }
    //
    //         $product->update(array(
    //             'product_code' => $request->input('productCode'),
    //             'product_name' => $request->input('productName'),
    //             'product_detail' => $request->input('productDetail'),
    //             'product_image' => $imageResize,
    //             'product_cost_price' => $request->input('productCostPrice'),
    //             'product_sale_price' => $request->input('productSalePrice'),
    //             'product_quantity' => $request->input('productQuantity'),
    //             'user_id' => $request->input('userID'),
    //         ));
    //     } else {
    //         $product->update(array(
    //             'product_code' => $request->input('productCode'),
    //             'product_name' => $request->input('productName'),
    //             'product_detail' => $request->input('productDetail'),
    //             'product_cost_price' => $request->input('productCostPrice'),
    //             'product_sale_price' => $request->input('productSalePrice'),
    //             'product_quantity' => $request->input('productQuantity'),
    //             'user_id' => $request->input('userID'),
    //         ));
    //     }
    //}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $product = Product::find($id);
         $product->delete();
         return redirect('products')->with('success','สินค้าไอดี'.$id.' สินค้าชื่อ'.$product->product_name.'ถูกลบเรียบร้อยแล้ว');
    }
}
