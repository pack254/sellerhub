<?php

namespace storeHub\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use storeHub\Customer;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all()->toArray();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
          $rules = array (
                  'fname' => 'required|alpha',
                  'lname' => 'required|alpha',
                  'address' => 'required',
                  'email' => 'required|email',
                  'phone' => 'numeric|min:2'
          );

          $validator = Validator::make(Input::all(),$rules);

          if ($validator->fails()){
              return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
          } else {
              $customer = Customer::create(array(
                'customer_firstname' => $request->input('fname'),
                'customer_lastname' => $request->input('lname'),
                'customer_address' => $request->input('address'),
                'customer_phone' => $request->input('phone'),
                'customer_email' => $request->input('email'),
                'user_id' => Auth::user()->id,
              ));

              return response()->json($customer);
          }
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
        $customers = Customer::select([
                                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                                    'customer_id',
                                    'customer_firstname',
                                    'customer_lastname',
                                    'customer_address',
                                    'customer_email',
                                    'customer_phone']);


        if($keyword = $request->get('search')['value']){
              $datatables = Datatables::of($customers);
              $datatables->filterColumn('rownum', function($query, $keyword){
                                      $sql = "@rownum  + 1 like ?";
                                      $query->whereRaw($sql, ["%{$keyword}%"]);
                              });

              return $datatables->addColumn('action', function ($customers) {
                      return '<a data-info="'.$customers->customer_id.','.$customers->customer_firstname.','.$customers->customer_lastname.','.$customers->customer_address.','.$customers->customer_email.','.$customers->customer_phone.'" class="edit-modal btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไขข้อมูล</button>
                              <a data-info="'.$customers->customer_id.','.$customers->customer_firstname.','.$customers->customer_lastname.','.$customers->customer_address.','.$customers->customer_email.','.$customers->customer_phone.'" class="delete-modal btn btn-xs btn-danger"><i class="fa fa-trash"></i> ลบข้อมูล</button>';
                      })
                      ->rawColumns(['action'])->make(true);
        }

        return DataTables::of($customers)
                ->addColumn('action', function ($customers) {
                    return '<button  data-info="'.$customers->customer_id.','.$customers->customer_firstname.','.$customers->customer_lastname.','.$customers->customer_address.','.$customers->customer_email.','.$customers->customer_phone.'" class="edit-modal btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไขข้อมูล</button>
                            <button  data-info="'.$customers->customer_id.','.$customers->customer_firstname.','.$customers->customer_lastname.','.$customers->customer_address.','.$customers->customer_email.','.$customers->customer_phone.'" class="delete-modal btn btn-xs btn-danger"><i class="fa fa-trash"></i> ลบข้อมูล</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
      }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  object $request
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request )
    {
          $rules = array (
                  'fname' => 'required|alpha',
                  'lname' => 'required|alpha',
                  'address' => 'required',
                  'email' => 'required|email',
                  'phone' => 'numeric|min:2'
          );

          $validator = Validator::make(Input::all(),$rules);
          if ($validator->fails()){
              return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
          } else {

              $customer = Customer::find($request->id);
              $customer->customer_firstname = ($request->fname);
              $customer->customer_lastname = ($request->lname);
              $customer->customer_address = ($request->address);
              $customer->customer_email = ($request->email);
              $customer->customer_phone = ($request->phone);
              $customer->save();
              return response()->json($customer);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object $request
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request )
    {
         Customer::find( $request->id )->delete();

         $customers = Customer::all()->toArray();
         return response()->json($customers);
    }
}
