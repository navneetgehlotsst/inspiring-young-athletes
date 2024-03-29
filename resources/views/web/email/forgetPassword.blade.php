<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width">
      <title></title>
      <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
   </head>
   <body style="background-color:#faf5ff">
      <div id="email" style="width:600px;margin: auto;background:white;">
        <!-- Header -->
        <table role="presentation" border="0" width="100%" cellspacing="0">
            <tr>
               <td bgcolor="#fff" align="center" style="color: white;">
                  <img alt="Flower"
                     src="{{asset('web/assets/images/new-img/insp.png')}}"
                     width="300px">
            </tr>
            </td>
         </table>        
        <!-- Header -->
         <table role="presentation" border="0" width="100%" cellspacing="0" style="margin-top: 20px;">
            <tr>
               <td bgcolor="#1e532e" align="center" style="background-image: url('{{asset('web/assets/images/new-img/hero-banner.jpg')}}'); color: white; height: 100px; padding: 20px 0px;">
                  <h2 style="font-family: poppins; margin-top: 20px;">Welcome to <br> Inspiring Young Athletes Reset Password!</h2>
            </tr>
            </td>
         </table>
         <!-- Body 1 -->
         <table role="presentation" border="0" width="100%" cellspacing="0">
            <tr>
               <td style="padding: 30px 30px 30px 30px;">
                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:poppins">Hey <b>{{$name}},</b></p>
                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:poppins">Click here for Reset Password</p>
                    <a href="{{ route('web.reset.password.get', $token) }}" style="display:inline-block;background:#1BADC4;color:#fff;font-family:poppins;font-size:16px;font-weight:400;line-height:1;letter-spacing:1px;margin:0;text-decoration:none;text-transform:none;padding:12px 24px 12px 24px;border-radius:4px">
                        Reset Password</a></p>
                    <p>OR</p>
                    <p>Copy url and pest to the web browser :- {{ route('web.reset.password.get', $token) }}</p>
               </td>
            </tr>
         </table>
         <!-- Body 3-->
         <table role="presentation" border="0" width="100%" cellspacing="0" style="margin-top: 20px;">
            <tr>
               <td bgcolor="#1BADC4" align="center" style="color: white; height: 1px;">
            </tr>
            </td>
         </table>
         <!-- Body 2-->
         <!-- Body 3 -->
         <table role="presentation" border="0" width="100%">
            <tr>
               <td align="center" style="padding: 30px 30px;">
                <p style="text-align:center; font-family: poppins; font-size: 14px; font-weight: 400;">Copyright © 2024 <a href="http://inspiringyoungathletes.com/" target="_blank" style="color: #1BADC4; font-weight: 600;">Inspiring Young Athletes</a> All rights reserved.</p>
               </td>
            </tr>
         </table>
         <!-- Footer -->
      </div>
   </body>