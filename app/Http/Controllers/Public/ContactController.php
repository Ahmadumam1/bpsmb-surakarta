<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Rules\ReCaptcha;
use App\Support\SiteSettings;
use App\Mail\ContactMessageMail;
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
            'g-recaptcha-response' => [
                config('services.recaptcha.secret') ? 'required' : 'nullable',
                new ReCaptcha,
            ],
        ], [
            'g-recaptcha-response.required' => 'Silakan centang verifikasi reCAPTCHA terlebih dahulu.',
        ]);

        try {
            $contactSettings = SiteSettings::all();

            $recipient = $contactSettings['contact.email'] ?? 'bpsmb_surakarta@disperindag.jatengprov.go.id';

            Mail::to($recipient)->send(new ContactMessageMail($validated));

            return back()->with('success', 'Pesan Anda telah berhasil dikirim ke email kami.');
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim email kontak: ' . $e->getMessage());
            return back()->with('error', 'Maaf, terjadi kesalahan saat mengirim pesan. Silakan hubungi kami via WhatsApp.');
        }
    }
}
