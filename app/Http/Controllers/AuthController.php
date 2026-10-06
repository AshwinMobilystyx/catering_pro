<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
 public function loginForm(){return view('auth.login');}
 public function login(Request $r){$data=$r->validate(['email'=>'required|email','password'=>'required']);$u=User::where('email',$data['email'])->where('role','customer')->first();if(!$u||!Hash::check($data['password'],$u->password))return back()->withInput()->with('error','Invalid email or password.');session(['customer_id'=>$u->id]);return redirect()->intended('/customer/dashboard');}
 public function registerForm(){return view('auth.register');}
 public function register(Request $r){$d=$r->validate(['name'=>'required|string|max:120','email'=>'required|email|unique:users,email','phone'=>'required|string|max:30','password'=>'required|min:8|confirmed']);$u=User::create($d+['role'=>'customer']);session(['customer_id'=>$u->id]);return redirect('/customer/dashboard');}
 public function logout(){session()->forget('customer_id');return redirect('/')->with('success','Logged out.');}
 public function adminLoginForm(){return view('admin.login');}
 public function adminLogin(Request $r){$d=$r->validate(['email'=>'required|email','password'=>'required']);$u=User::where('email',$d['email'])->where('role','admin')->first();if(!$u||!Hash::check($d['password'],$u->password))return back()->with('error','Invalid admin credentials.');session(['admin_id'=>$u->id]);return redirect('/admin/dashboard');}
 public function adminLogout(){session()->forget('admin_id');return redirect('/admin/login')->with('success','Logged out.');}
}