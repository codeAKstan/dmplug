<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0a0a0a; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #141414; border-radius: 24px; overflow: hidden; border: 1px solid #333; }
        .header { background: #EFFF00; padding: 40px; text-align: center; }
        .header h1 { margin: 0; color: #000; font-size: 28px; font-weight: 800; }
        .content { padding: 40px; }
        .tool-box { background: #1a1a1a; border: 1px solid #333; border-radius: 16px; padding: 20px; margin: 20px 0; }
        .footer { padding: 30px; text-align: center; color: #666; font-size: 12px; }
        .highlight { color: #EFFF00; font-weight: bold; }
        .btn { display: inline-block; padding: 15px 30px; background: #EFFF00; color: #000; text-decoration: none; border-radius: 12px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>ORDER SUCCESSFUL</h1>
        </div>
        <div class="content">
            <p>Hello <span class="highlight">{{ $user->name }}</span>,</p>
            <p>Your purchase of <span class="highlight">{{ $tool->name }}</span> was successful!</p>
            
            <div class="tool-box">
                <p style="margin: 0; color: #888;">Product Category:</p>
                <p style="margin: 5px 0 0 0; font-weight: bold;">{{ $tool->category }}</p>
            </div>

            <p>This email serves as a confirmation of your order. <strong>Please note:</strong> The script/files you just purchased will be sent in a <span class="highlight">separate follow-up email</span> shortly.</p>
            
            <p>Thank you for choosing DMPlug!</p>
            
            <a href="{{ url('/') }}" class="btn">Return to Website</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} DMPlug. All rights reserved.
        </div>
    </div>
</body>
</html>
