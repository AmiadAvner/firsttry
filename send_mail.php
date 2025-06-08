<?php
// בודק אם שלחו את הטופס
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // קבלת הנתונים מהטופס
    $name    = htmlspecialchars($_POST["שם מלא"] ?? "");
    $phone   = htmlspecialchars($_POST["טלפון"] ?? "");
    $email   = htmlspecialchars($_POST["אימייל"] ?? "");
    $message = htmlspecialchars($_POST["הודעה"] ?? "");

    // כתובת הדוא"ל אליה תשלח ההודעה
    $to = "amiadavner@gmail.com";
    $subject = "פנייה חדשה מאתר עמיעד אבנר";
    
    $body = "שם מלא: $name\nטלפון: $phone\nאימייל: $email\n\nהפנייה:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\nContent-Type: text/plain; charset=utf-8";

    // שליחת המייל
    if (mail($to, $subject, $body, $headers)) {
        echo "<div style='text-align:center; margin-top:3em; font-size:1.4em; color:green;'>ההודעה נשלחה בהצלחה!<br>נחזור אליך בהקדם.</div>";
    } else {
        echo "<div style='text-align:center; margin-top:3em; font-size:1.2em; color:red;'>אירעה שגיאה בשליחת הטופס.<br>אנא נסה שוב מאוחר יותר.</div>";
    }
} else {
    // אם נכנסו ישירות, מפנה חזרה לאתר
    header("Location: index.html");
    exit();
}
?>
