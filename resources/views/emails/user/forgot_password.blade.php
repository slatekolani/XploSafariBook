<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                    <a href="{{ env("COMPANY_WEB") }}" target="_blank">
                        <img src="http://notification.nextbyte.co.tz/public/images/wcf_big_logo_no_background.png" alt="{{ env("APP_NAME") }}  Logo" style="border:none">
                        <br>
                        {{--<img src="./basic_files/eliteadmin-text-dark.png" alt="Eliteadmin Responsive web app kit" style="border:none">--}}
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding: 40px; background: #fff;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td style="border-bottom:1px solid #f6f6f6;"><h1 style="font-size:14px; font-family:arial; margin:0px; font-weight:bold;">{{ $name }},</h1>
                        <p style="margin-top:0px; color:#bbbbbb;">@lang("strings.email.passwords.line_1")</p></td>
                </tr>
                <tr>
                    <td style="padding:10px 0 30px 0;"><p>@lang("strings.email.passwords.line_2")</p>
                        <center>
                            <a href="{{ route("frontend.auth.password.reset.form", $token) }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #4c66a4; border-radius: 60px; text-decoration:none;">@lang("strings.email.passwords.button")</a>
                        </center>
                        <b>- @lang("labels.general.thanks") ( @lang("labels.general.wcf") )</b> </td>
                </tr>
                <tr>
                    <td style="border-top:1px solid #f6f6f6; padding-top:20px; color:#777">
                        @lang("strings.email.passwords.line_3") <br/>
                        <a href="{{ route("frontend.auth.password.reset.form", $token) }}">{{ route("frontend.auth.password.reset.form", $token) }}</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
{{--        <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
            <p> Powered by Themedesigner.in <br>
                <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a> </p>
        </div>--}}
    </div>
</div>