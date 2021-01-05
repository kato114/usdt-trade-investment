<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="telephone=no" name="format-detection"/>
    <title></title>
    <style type="text/css" data-premailer="ignore">
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700);
    </style>
    <style data-premailer="ignore">
        @media screen and (max-width: 600px) {
            u + .body {
                width: 100vw !important;
            }
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
    </style>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .box {
            border-color: #eee !important;
        }
    </style>
    <![endif]-->
    <link rel="stylesheet" href="{{url('assets/css/theme.css')}}"/>
</head>

<body class="bg-body">
<center>
    <table class="main bg-body" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="top">
                <!--[if (gte mso 9)|(IE)]>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" valign="top" width="640">
                <![endif]-->
                <span
                    class="preheader">@yield('preheader','')</span>
                <table class="wrap" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="p-sm">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td class="py-lg">
                                        <table cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/home') }}"><img
                                                            src="{{ url('/assets/images/logo-email.png')}}"
                                                            height="34" alt=""/></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            @yield('content')
                            <table cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="py-xl">
                                        <table class="font-sm text-center text-muted" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="px-lg">
                                                    If you have any questions, feel free to message us at <a
                                                        href="mailto:{{ 'support@' . str_replace("accounts.","",  basename(env('APP_URL'))) }}"
                                                        class="text-muted">{{ 'support@' . str_replace("accounts.","",  basename(env('APP_URL'))) }}</a>.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pt-md">
                                                    This email is a service from {{ config('app.name') }} Support
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
</center>
</body>

</html>
