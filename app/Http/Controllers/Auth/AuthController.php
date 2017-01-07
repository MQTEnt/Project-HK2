<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\ConfirmFormRequest;
use Hash;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|numeric|unique:users',
            'organization' => 'required',
            'address' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'organization' => $data['organization'],
            'address' => $data['address'],
            'stat' => 0,
            'key' => str_random(6),
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        /*
        * Kiểm tra tài khoản đã xác nhận hay chưa
        */
        $user = User::select(['email', 'password', 'stat'])->where('email', $request->get('email'))->first();
        if(!is_null($user) && Hash::check($request->get('password'), $user->password) && $user->stat == 0)
            return $this->getConfirm($request->get('email'), null);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function getConfirm($email, $message)
    {
        return view('auth.confirm', compact(['email', 'message']));
    }
    public function postConfirm(ConfirmFormRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if($user->key == $request->get('key'))
        {
            $user->stat = 1;
            $user->save();
            Auth::login($user, true);
            return redirect('/home');
        }
        else
            return $this->getConfirm($request->get('email'), 'Bạn đã nhập sai mã xác nhận, mời nhập lại');
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());
        return $this->getConfirm($request->get('email'),null);
        //Auth::guard($this->getGuard())->login($this->create($request->all()));
        //return redirect($this->redirectPath());
    }
}
