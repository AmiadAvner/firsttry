<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["שם מלא"] ?? "");
    $phone   = htmlspecialchars($_POST["טלפון"] ?? "");
    $email   = htmlspecialchars($_POST["אימייל"] ?? "");
    $message = htmlspecialchars($_POST["הודעה"] ?? "");

    $to = "amiadavner@gmail.com";
    $subject = "פנייה חדשה מאתר עמיעד אבנר";
    $body = "שם מלא: $name\nטלפון: $phone\nאימייל: $email\n\nהפנייה:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=utf-8";

    // נשלח? מציג הודעה מתאימה
    if (mail($to, $subject, $body, $headers)) {
        echo "<!DOCTYPE html>
        <html lang='he' dir='rtl'>
        <head>
          <meta charset='UTF-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1.0' />
          <title>הודעה נשלחה</title>
          <style>
            body { background: #f9f9f9; font-family: 'Alef', sans-serif; text-align: center; }
            .msg-box {
              margin: 8em auto 0 auto;
              max-width: 450px;
              background: #fff;
              border-radius: 16px;
              box-shadow: 0 2px 12px #e5d6c2;
              padding: 2.5em 2em;
              color: #26507a;
              font-size: 1.3em;
            }
            .msg-box strong { color: #c06a27; font-size:1.15em; }
            a { color: #2366b8; text-decoration: underline; }
          </style>
        </head>
        <body>
          <div class='msg-box'>
            <strong>הודעתך נשלחה בהצלחה!</strong>
            <div style='margin-top:1em;'>תודה על פנייתך.<br>נחזור אליך בהקדם.</div>
            <div style='margin-top:2em;'><a href='index.html'>חזרה לאתר</a></div>
          </div>
        </body>
        </html>";
    } else {
        echo "<div style='text-align:center; margin-top:3em; font-size:1.2em; color:red;'>אירעה שגיאה בשליחת ההודעה.<br>אנא נסה שוב מאוחר יותר.</div>";
    }
} else {
    header("Location: index.html");
    exit();
}
?>
