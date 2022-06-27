<body>   
    <div style="width:100%; background:#dadada; padding-top: 80px; padding-bottom: 80px;">
        <table cellpadding="0" cellspacing="0" itemprop="action" itemscope="" 
        style="width:700px; background:#ffffff; color:#000; max-width:90%; margin:auto;font-family :Roboto,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 5px; border: 1px solid rgb(109, 107, 107);">
            <thead>
                <tr>
                    <td style="background:#000; border-top-left-radius: 4px; border-top-right-radius: 4px;">
                        <img src="https://mgr2.cinebaz.com/assets/frontend/images/logo.png" alt="Cinebaz" style="margin: auto; height: 60px; width: auto;
                        display: flex; padding: 5px;">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td style="padding-left: 15px;">
                        <br>Hello <b>{{ $name }}</b>,<br>
                        Greetings from <b>Cinebaz!</b>
                        <p style="margin-bottom:20px;">
                            To reset your password please follow the link below:
                        </p>
                    </td>
                </tr>
                <tr style="text-align:center;">
                    <td style="padding-left: 15px;">
                        <p>
                            <br>
                            <a
                            href="{{ $content }}"
                            style="text-decoration: auto; font-size: 17px; background-color: #02af2d; font-weight: bold; 
                            color: #ffffff; padding: 12px; border-radius: 5px;"
                            > Reset Password </a>
                        </p>
                        <br><br>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 15px;">
                        Best Regards<br>
                        -------------------------<br>
                        <b>Cinebaz Support Team</b>  
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; padding:15px;">
                        Copyright &copy; {{ date('Y') }} Cinebaz Limited
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>