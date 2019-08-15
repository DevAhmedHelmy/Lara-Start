<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRequest;
use Validator;
use App\User;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('fdfdf');
       return User::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
         ]);
        $fileName = null;
        if (request()->hasFile('photo'))
            {
            $file = request()->file('photo');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./img/upload/users/', $fileName);
            }

            $user = new User();
            $user->name=request('name');
            $user->email=request('email');
            $user->type=request('type');
            $user->bio=request('bio');
            $user->password=bcrypt(request('password'));
            $user->photo=$fileName;
            $user->save();

    //     return User::create([
    //         'name' => request('name'),
    //         'email' => request('email'),
    //         'type' => request('type'),
    //         'bio' => request('bio'),
    //         'photo' => $fileName,
    //         'password' =>bcrypt(request('password'))
    //     ]);
        }


    public function profile()
    {
        dd('fdfdf');
        //return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->name=request('name');
        $user->email=request('email');
        $user->type=request('type');
        $user->bio=request('bio');
        if ((request('new_password') && request('password_confirmation')) && (request('new_password') === request('password_confirmation')))

        {
            $user->password=bcrypt(request('new_password'));
        }
        $user->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return['message'=>'user is deleted'];
    }
}
