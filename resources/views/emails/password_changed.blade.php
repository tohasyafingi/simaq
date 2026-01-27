@extends('emails.layout')

@section('content')

<h2 style="
    margin-top:0;
    margin-bottom:16px;
    font-size:22px;
    color:#2c3e50;
    font-weight:600;
">
    Pemberitahuan Perubahan Kata Sandi
</h2>

<p style="margin:0 0 12px 0;">
    Yth. <strong>{{ $user->name }}</strong>,
</p>

<p style="margin:0 0 16px 0; line-height:1.6;">
    Kami ingin memberitahukan bahwa kata sandi akun Anda di
    <strong>{{ config('app.name') }}</strong>
    telah berhasil diperbarui.
</p>

<p style="margin:0 0 16px 0; line-height:1.6;">
    Jika Anda tidak merasa melakukan perubahan ini, segera lakukan pengamanan akun
    atau hubungi administrator untuk mendapatkan bantuan lebih lanjut.
</p>

<p style="
    margin-top:28px;
    font-size:13px;
    color:#6c757d;
    line-height:1.6;
">
    Email ini dikirim secara otomatis oleh sistem.<br>
    Mohon tidak membalas email ini.
</p>

<p style="margin-top:24px; font-size:13px; color:#6c757d;">
    Salam hormat,<br>
    <strong>Admin {{ config('app.name') }}</strong>
</p>

@endsection
