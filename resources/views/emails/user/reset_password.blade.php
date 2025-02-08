<div width="100%" style="margin:0px; background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                    <a href="{{ config("env.app.client_web") }}" target="_blank">
                        <img src="http://notification.nextbyte.co.tz/public/images/np_logo.jpg" alt="{{ env("APP_NAME") }}  Logo" style="border:none">
                        <br>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding: 40px; background: #fff;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td><b>{{ $name }},</b>
                        <p>@lang("strings.email.confirm_account.line_1")</p>
                        <p>@lang('label.password'):{{ $token }}</p>

                        <a href="{{ route("password.reset", ['token' => $token]) }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #32CD32; border-radius: 60px; text-decoration:none;"> @lang("label.login") </a>

                        <p>@lang("strings.email.confirm_account.line_2")&nbsp;&nbsp;<a href="{{ route("password.reset", $token) }}">{{ route("password.reset", $token) }}</a></p>

                        <b>@lang("label.thanks") ( {{ config("env.app.name") }} )</b>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
