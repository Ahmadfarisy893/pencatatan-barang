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
        ->whereNull('parent_id') // hanya pesan utama, exclude balasan
        ->latest()
        ->get();
        return view('mail.index', compact('emails'));
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'to'    => 'required|email',
            'subject' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);
        
        try {
            Mail::raw($request->body, function ($message) use ($request) {
            $message->to($request->to)
                    ->subject($request->subject); // ambil dari input form
        });

            // simpan ke database
            Email::create([
                'from'   => auth()->user()->email ?? 'admin@example.com',
                'to'     => $request->to,
                'subject'=> $request->subject,
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

    public function reply(Request $request, $id)
    {
    $request->validate([
        'body' => 'required|string',
    ]);

    $parent = Email::findOrFail($id);
    $email = Email::with(['replies.sender'])->findOrFail($id);

    $reply = Email::create([
        'from'      => auth()->id(), // atau auth()->user()->email
        'to'        => $parent->from == auth()->id() ? $parent->to : $parent->from,
        'subject'   => 'Re: ' . $parent->subject,
        'body'      => $request->body,
        'avatar'    => auth()->user()->avatar ?? null,
        'parent_id' => $parent->id,
    ]);

    return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function sendMail()
    {
        $userEmail = auth()->user()->email;

        $emails = Email::where('from', $userEmail)->latest()->get();

        return view('mail.sendMail', compact('emails'));
    }

    public function destroy(Request $request, $id)
    {
        $email = Email::findOrFail($id);
        $userEmail = auth()->user()->email;

        if ($email->from !== $userEmail && $email->to !== $userEmail) {
            abort(403, 'Akses ditolak');
        }
        
        $email->delete();

        if ($email->parent_id) {
            // kalau balasan, kembali ke halaman detail email induk
            return redirect()->route('mail.show', $email->parent_id)
                ->with('success', 'Balasan berhasil dihapus.');
        }

        return redirect()->route('mail.index')->with('success', 'Email berhasil dihapus.');

    }
    
}
