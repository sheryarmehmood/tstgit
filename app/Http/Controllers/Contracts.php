<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class Contracts extends Controller 
{
    function index(Request $req)
    {
    //   print_r($req->file());
    $wn = $req->file('agreement')->store('public');
    return view("createagreement",compact('wn'));
    }
}