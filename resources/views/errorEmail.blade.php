<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Error Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin:0; padding:20px;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background: #fff; border: 1px solid #ddd; border-radius: 5px;">
    <tr>
        <td style="background-color: #d9534f; color: white; padding: 15px; font-size: 24px; font-weight: bold; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
            Application Error Notification
        </td>
    </tr>
    <tr>
        <td style="padding: 20px; color: #333;">
            <h2 style="color: #d9534f; margin-top: 0;">An error occurred in the application</h2>

            <p><strong style="color: #555;">Error message:</strong></p>
            <p style="background: #f2dede; color: #a94442; padding: 15px; border-radius: 4px; border: 1px solid #ebccd1; font-family: monospace; white-space: pre-wrap;">
                {{ $errorMessage }}
            </p>

            <p><strong style="color: #555;">Stack trace:</strong></p>
            <pre style="background: #f9f9f9; color: #555; padding: 15px; border: 1px solid #ccc; border-radius: 4px; font-family: monospace; max-height: 300px; overflow-y: auto; white-space: pre-wrap;">
{{ $stackTrace }}
                </pre>

            <p style="font-size: 12px; color: #999; margin-top: 30px;">This is an automated message. Please do not reply.</p>
        </td>
    </tr>
</table>
</body>
</html>
