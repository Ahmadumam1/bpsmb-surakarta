<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Support\SiteSettings;
use App\Mail\ContactMessageMail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __invoke()
    {
        return view('public.contact.index', [
            'contactSettings' => SiteSettings::all(),
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            $contactSettings = SiteSettings::all();

            // Get recipient email dynamically from site settings
            $recipient = $contactSettings['contact.email'] ?? 'bpsmb_surakarta@disperindag.jatengprov.go.id';

            // Send the email
            Mail::to($recipient)->send(new ContactMessageMail($validated));

            return back()->with('success', 'Pesan Anda telah berhasil dikirim ke email kami.');
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim email kontak: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan hubungi kami via WhatsApp.');
        }
    }
}
