@extends('emails.layout')

@section('content')

<h2 style="
  margin:0 0 18px 0;
  font-size:22px;
  color:#2c3e50;
  font-weight:600;
">
    Verifikasi Alamat Email
</h2>

<p style="margin:0 0 14px 0;">
    Yth. <strong>{{ $user->name }}</strong>,
</p>

<p style="margin:0 0 16px 0; line-height:1.6;">
    Terima kasih telah mendaftar di <strong>{{ config('app.name') }}</strong>.
    Untuk mengaktifkan akun Anda, silakan lakukan verifikasi alamat email
    dengan mengklik tombol di bawah ini.
</p>

<p style="margin:0 0 16px 0; line-height:1.6;">
    Demi keamanan akun Anda, tautan verifikasi ini hanya berlaku selama
    <strong>{{ config('auth.verification.expire', 60) }} menit</strong>
    sejak email ini dikirimkan.
</p>

<p style="text-align:center; margin:36px 0;">
    <a href="{{ $url }}"
        style="
       display:inline-block;
       padding:14px 32px;
       background-color:#1abc9c;
       color:#ffffff;
       text-decoration:none;
       border-radius:6px;
       font-weight:600;
       font-size:14px;
     ">
        Verifikasi Email
    </a>
</p>

<hr style="
  border:none;
  border-top:1px solid #dee2e6;
  margin:36px 0;
">


<p style="font-size:13px; color:#6c757d; line-height:1.6; margin-bottom:8px;">
    Jika tombol di atas tidak dapat diklik, salin dan tempel tautan berikut:
</p>

<p style="
  font-size:13px;
  word-break:break-all;
  background:#f8f9fa;
  padding:12px;
  border-radius:6px;
  border:1px solid #dee2e6;
  margin-bottom:24px;
">
    <a href="{{ $url }}" style="color:#1abc9c; text-decoration:none;">
        {{ $url }}
    </a>
</p>


<p style="
    font-size:13px;
    color:#6c757d;
    line-height:1.6;
">
    Apabila Anda tidak merasa melakukan pendaftaran di
    {{ config('app.name') }}, abaikan email ini.
    Tidak ada tindakan lebih lanjut yang diperlukan.
</p>

<p style="font-size:13px; color:#6c757d; line-height:1.6;">
    Demi keamanan, mohon <strong>jangan membagikan tautan ini</strong>
    kepada siapa pun, termasuk pihak yang mengatasnamakan
    {{ config('app.name') }}.
</p>


<p style="margin-top:28px; font-size:13px; color:#6c757d;">
    Salam hormat,<br>
    <strong>Admin {{ config('app.name') }}</strong>
</p>


@endsection