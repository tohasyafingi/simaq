<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Notifikasi' }}</title>
</head>

<body style="margin:0; padding:0; background-color:#f8f9fa; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8f9fa; padding:24px 0;">
        <tr>
            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0"
                    style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden; border:1px solid #dee2e6;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding:10px 24px; background:#1abc9c;">
                            <img
                                src="{{ url('assets/icon-512.png') }}"
                                alt="{{ config('app.name') }}"
                                height="56"
                                style="height:56px; width:auto; max-width:100%; display:block;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:32px; color:#2c3e50; font-size:15px; line-height:1.7;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding:20px; font-size:12px; color:#6c757d; background:#f8f9fa; border-top:1px solid #dee2e6;">
                            © {{ date('Y') }} {{ config('app.name') }}. Semua hak dilindungi.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>