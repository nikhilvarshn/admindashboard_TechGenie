<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Dear {{$na['name']}}</p>

    <p style="padding-bottom:0px;margin-bottom:0px;">Join doubt clearing session through the below link</p>
    {{$na['link']}}

    <p>According to you, your date and time is <b>{{$na['userdt']}}</b></p>

    <p>{{$na['msgbox']}}</p>

    <p style="margin-bottom:0px;">Your Mentor</p>
    <b>{{$na['mname']}}</b>

    <div style="margin-top:20px;">
        <span>Thanks & Regards</span><br>
        <span>TechGenie Teams</span><br>
        <span><b>Contactus:</b>123456789</span><br>
        <span><b>Email:</b>support@techgenie.com</span>
    </div>
</body>
</html>