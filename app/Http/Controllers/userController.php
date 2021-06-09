<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
// use App\Traits\ApiResponser;

class userController extends Controller
{
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        return [
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ];
    }

    public function register(Request $request)
    {
        $attr = $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required'
        );

        $cek = Validator::make($request->all(),$attr);

        if ($cek->fails()) {
            return $cek->errors();
        }

        $data = new User;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->status = $request->status;
        $result = $data->save();
        
        // return ['token' => $data->createToken('API Token')->plainTextToken];
        return ["result"=>"Berhasil Registrasi Akun"];
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function loginError()
    {
        return abort(404);
    }
}
