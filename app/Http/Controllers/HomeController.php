<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $data = $request->user()->authorizeRoles(["admin", "user"]);
    print_r($data);
    //die();


    return view("home");
  }
  public function someAdminStuff(Request $request)
  {
    $request->user()->authorizeRoles("admin");
    return view("some.view");
  }
}
