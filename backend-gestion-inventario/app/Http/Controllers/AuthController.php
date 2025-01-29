<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        if (!Gate::any(['register-user'])) {
            return response()->json([
                'message'=>'No autorizado'
            ],401);
        }

        $rules = [
            'name'=>'required|string|max:100',
            'email'=>'required|string|email|max:100|unique:users',
            'password'=>'required|string|min:8',
        ];
        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()->all()
            ],400);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return response()->json([
            'status'=>true,
            'message'=>'User Created succefully',
            'token'=>$user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function login(Request $request)
    {
        $rules = [
            'email'=>'required|string|email|max:100',
            'password'=>'required|string|min:8',
        ];
        $messages = [
            'email.required'=>'El campo email es requerido',
            'email.email'=>'El campo email es debe tener un formato valido',
            'password.required'=>'El campo password es requerido',
            'password.min'=>'El campo password debe contener al menos 8 caracteres',
        ];
        $validator = \Validator::make($request->input(),$rules,$messages);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()->all()
            ],400);
        }

        if(!Auth::attempt($request->only(['email','password'])))
        {
            return response()->json([
                'status'=>false,
                'error'=>['Email o contraseña incorrectos']
            ],401);
        }

        $user = User::where('email',$request->email)->first();
        return response()->json([
            'status'=>true,
            'message'=>'Usuario logueado correctamente',
            "data"=>$user,
            'token'=>$user->createToken('API TOKEN')->plainTextToken
        ],200);
    }

    public function logout(Request $request)
    {
        try{
            $request->user()->tokens()->delete();
            return response()->json([
                'status'=>true,
                'message'=>'User Logged out succefully',
            ],200);
        }
        catch(\Excpetion $ex)
        {
            return response()->json([
                'status'=>false,
                'message'=>$ex->getMessage(),
            ],200);
        }
    }

    
    public function changePassword(Request $request)
    {
        try{

            $user = $request->user();
            if(!$user){
                throw new \Exception('usuario no valido');
            }

            if($request->password != $request->confirmPassword)
            {
                throw new \Exception('El password no coincide con su confirmacion');
            }

            if(!Hash::check($request->password,$user->password))
            {
                throw new \Exception('El password no es correcto');
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();
            
            return response()->json([
                'status'=>1,
                'message'=>'El password se modifico con exito!'
            ]);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'status'=>0,
                'message'=>$ex->getMessage()
            ]);
        }

    }

    public function resetPassword(Request $request)
    {
        try{
            $user = User::where('email','=',$request->email)->first();
            if(!$user){
                throw new \Exception('No se encontro el email');
            }
            $new_pass = $this->generateRandomString(8);
            $user->password = Hash::make($new_pass);
            $user->save();
            Mail::to($user->email)
                ->send(new \App\Mail\ResetPasswordMailable($new_pass));
            
            return response()->json([
                'status'=>1,
                'message'=>'El correo se envio con exito!'
            ]);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'status'=>0,
                'message'=>$ex->getMessage()
            ]);
        }

    }

    private function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}
