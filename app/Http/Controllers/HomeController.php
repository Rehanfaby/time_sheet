<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Employee;
use App\Gallery;
use App\Judge;
use App\User;
use App\vote;
use Illuminate\Http\Request;
use App\Sale;
use App\Returns;
use App\ReturnPurchase;
use App\ProductPurchase;
use App\Purchase;
use App\Expense;
use App\Payroll;
use App\Quotation;
use App\Payment;
use App\Account;
use App\Product_Sale;
use App\Customer;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Printing;
use Rawilk\Printing\Contracts\Printer;
use Spatie\Permission\Models\Role;
use Stripe\EphemeralKey;
use Twilio\Rest\Client;

/*use vendor\autoload;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;*/

class HomeController extends Controller
{
    public function dashboard()
    {
        dd('dashboard');
    }

    public function about()
    {
        dd('about');
    }

    public function contact()
    {
        dd('contact');
    }


    public function admin() {

//        if(Auth::user()) {
//            $role = Auth::user()->role_id;
//            if($role == 3) {
//                return $this->index();
//            }
//        }

        return view('index');
    }

    public function index()
    {
        return view('index');
    }


}
