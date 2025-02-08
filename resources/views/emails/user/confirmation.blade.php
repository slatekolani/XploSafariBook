<div width="100%" style="margin:0px; background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                    <a href="{{ url('/') }}">
                        <img src="https://i.pinimg.com/originals/4e/75/14/4e751490b6803f4667ae746918d5741c.jpg" alt="{{ config('app.name') }}" class="companyLogo"/>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                    <tr>
                       
                        <td>
                            <p>Hello {{ $firstname }},</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                    <tr>
                       
                        <td>
                            <p>@lang("strings.sms.registered")</p><br>
                            <p style="text-align: center;color:dodgerblue;font-size:30px"><b>{{ $confirmation_code }}</b></p>
    
                            <b>@lang("label.thanks")<br> ( {{ config("env.app.name") }} )</b>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    