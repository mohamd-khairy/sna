<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
            * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }
    </style>
</head>

<body>

    <div style="background: #edf2f7;">
        <div class="" style="max-width: 570px;margin: auto;">
            <div style="width: 120px;height: 95px;padding: 25px 0;text-align: center;margin: auto;">
                <a href="https://iduni.net" target="_blank">
                	<img src="https://iduni.net/frontend/img/IDU-LOGO2.png" alt="logo" style="height: 100%;">
                </a>
            </div>
            <div style="background: #fff;padding: 32px;">
                <h1 style="color: #3d4852;font-size: 18px; font-weight: bold;margin-top: 0;text-align: left;margin-bottom: 13px;">Dear Admin,</h1>
                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;">A new contact message has been sent with the following information</p>
                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;"><br></p>

                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;"><b>Name:</b> {{$name}}</p>
                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;"><b>Email:</b> {{$email}}</p>
                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;"><b>Message:</b> {{$comment}}</p>
                
                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;"><br></p>

                <p style="font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;color: #718096;">Best Regards,</p>
                
            </div>
            <p style="line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center;padding: 32px;">© 2021 IDU. All rights reserved.</p>
        </div>
</body>

</html>