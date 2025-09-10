<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\mail;
use App\Models\Email;



class EmailController extends Controller
{
    
    public function index(){
        $userEmail = auth()->user()->email;
        
        $emails = Email::where('from', $userEmail)
        ->orWhere('to', $userEmail)
        ->latest()
        ->get();
        return view('mail.index', compact('emails'));
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'to'    => 'required|email',
            'body'  => 'required|string',
        ]);
        
        try {
            Mail::raw($request->body, function ($message) use ($request) {
                $message->to($request->to)
                ->subject('Pesan Baru dari Sistem');
            });

            // simpan ke database
            Email::create([
                'from'   => auth()->user()->email ?? 'admin@example.com',
                'to'     => $request->to,
            'subject'=> 'Pesan Baru dari Aplikasi',
            'body'   => $request->body,
            'avatar' => auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : 'https://bootdey.com/img/Content/avatar/avatar1.png'
        ]);

        return back()->with('success', 'Email berhasil dikirim!');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
    }
    }
    
    public function show($id)
    {
        $email = Email::with('replies')->findOrFail($id);
        $userEmail = auth()->user()->email;
        
        if ($email->from !== $userEmail && $email->to !== $userEmail) {
            abort(403, 'Akses ditolak');
        }
        
        return view('mail.show', compact('email'));
    }
}
