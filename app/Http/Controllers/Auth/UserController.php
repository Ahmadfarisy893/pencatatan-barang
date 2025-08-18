<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Tambahkan ini di bagian atas

class UserController extends Controller
{
    public function index()
    {
    $users = User::all(); // Mengambil semua data user
    return view('users.index', compact('users')); 
    }

}