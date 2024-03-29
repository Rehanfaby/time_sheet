<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => [
                'email',
                'max:255',
                    Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'password' => 'required|string|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone_number'],
            'company_name' => $data['company_name'] ?? null,
            'role_id' => $data['role_id'],
            'biller_id' => $data['biller_id'] ?? null,
            'warehouse_id' => $data['warehouse_id'] ?? null,
            'weak_start' => isset($data['weak_start']) ? implode(',', $data['weak_start']) : null,
            'project_id' => isset($data['project_id']) ? implode(',', $data['project_id']) : null,
            'region_id' => $data['region_id'],
            'superviser_id' => $data['superviser_id'],
            'is_active' => true,
            'is_deleted' => false,
            'password' => bcrypt($data['password']),
        ]);

        if($data['role_id'] == 5) {
            $data['name'] = $data['customer_name'];
            $data['user_id'] = $user->id;
            Customer::create($data);
        }

        return $user;
    }
}
