@extends('emails.layout')

@section('content')

<h2 style="margin-top:0;margin-bottom:18px;font-size:22px;color:#2c3e50;">Selamat Datang di {{ config('app.name') }}</h2>

<p style="margin:0 0 14px 0;">Yth. <strong>{{ $user->name }}</strong>,</p>

<p style="margin:0 0 16px 0; line-height:1.6;">Kami dengan senang hati menginformasikan bahwa akun Anda di <strong>{{ config('app.name') }}</strong> telah berhasil dibuat. Anda kini dapat masuk ke sistem menggunakan alamat email dan kata sandi yang telah disediakan di bawah ini.</p>

<p style="margin:0 0 16px 0; line-height:1.6;"><strong>Detail Login:</strong></p>
<ul style="margin:0 0 16px 20px; padding:0; line-height:1.6;">
    <li>Email: <strong>{{ $user->email }}</strong></li>
    @if(!empty($password))
    <li>Kata sandi awal: <strong>{{ $password }}</strong></li>
    @endif
</ul>

<p style="margin:0 0 16px 0; line-height:1.6;">Untuk keamanan, harap segera ubah kata sandi setelah masuk pertama kali dan jangan bagikan informasi ini kepada pihak lain.</p>

@if(!empty($verificationUrl))
<p style="margin:18px 0;">
    <a href="{{ $verificationUrl }}" style="
       display:inline-block;
       padding:14px 32px;
       background-color:#1abc9c;
       color:#ffffff;
       text-decoration:none;
       border-radius:6px;
       font-weight:600;
       font-size:14px;
     ">Verifikasi Email</a>
</p>
@endif

<hr style="border:none;border-top:1px solid #dee2e6;margin:32px 0;">

<p style="font-size:13px;color:#6c757d;line-height:1.6;margin-bottom:12px;">Apabila Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut, silakan menghubungi tim kami melalui kontak resmi <strong>{{ config('app.name') }}</strong>.</p>

<p style="font-size:13px;color:#6c757d;line-height:1.6;">Jika Anda merasa tidak pernah melakukan pendaftaran akun, silakan abaikan email ini.</p>

<p style="margin-top:28px;font-size:13px;color:#6c757d;">Salam hormat,<br><strong>Admin {{ config('app.name') }}</strong></p>

@endsection