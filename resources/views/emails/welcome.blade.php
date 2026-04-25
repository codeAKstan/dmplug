<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #0a0a0a; color: #ffffff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 40px; background-color: #141414; border-radius: 30px; margin-top: 40px; border: 1px solid rgba(255, 255, 255, 0.1); }
        .logo { font-size: 32px; font-weight: bold; text-align: center; margin-bottom: 40px; }
        .logo span { color: #EFFF00; }
        .content { line-height: 1.6; font-size: 16px; color: rgba(255, 255, 255, 0.7); }
        .content h1 { color: #ffffff; font-size: 24px; margin-bottom: 20px; }
        .button { display: inline-block; padding: 16px 32px; background-color: #EFFF00; color: #000000; text-decoration: none; border-radius: 16px; font-weight: bold; margin-top: 30px; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">DM<span>Plug</span></div>
        <div class="content">
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>We're thrilled to have you on board at DMPlug. Your account has been successfully created, and you're now part of a community that values efficiency and professional tools.</p>
            <p>You can now explore our range of tools, manage your wallet, and start listing your products.</p>
            <a href="{{ config('app.url') }}/dashboard" class="button">Go to Dashboard</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} DMPlug. All rights reserved.
        </div>
    </div>
</body>
</html>
