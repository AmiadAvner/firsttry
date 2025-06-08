<?php
// כתובת האימייל שתקבל את הפניות
$to = "amiadavner@gmail.com";
$subject = "פנייה חדשה מהאתר - עמיעד אבנר";

// בודק אם נשלח POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // קבלת הנתונים ומסנן תווים לא תקינים
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"] ?? ''));

    // בדיקת תקינות (אפשר להחמיר בהתאם לצורך)
    if (
        empty($name) ||
        empty($phone) ||
        empty($email) ||
        empty($message) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        // הודעה במקרה של שגיאה (אפשר לעצב יפה יותר, או להחזיר ללקוח Json/Html)
        echo "אנא מלא/י את כל השדות בצורה תקינה.";
        exit;
    }

    // מבנה ההודעה
    $body = "פנייה חדשה התקבלה מהאתר:\n\n";
    $body .= "שם מלא: $name\n";
    $body .= "טלפון: $phone\n";
    $body .= "אימייל: $email\n";
    $body .= "--------------------------\n";
    $body .= "פנייה:\n$message\n";
    $body .= "--------------------------\n";
    $body .= "נשלח מאתר עמיעד אבנר.\n";

    // כותרות המייל
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // שליחת המייל
    if (mail($to, $subject, $body, $headers)) {
        // הפנייה לעמוד תודה (אפשר לשנות את הנתיב/שם)
        header('Location: thankyou.html');
        exit;
    } else {
        echo "אירעה שגיאה בשליחת הפנייה. נסה שוב מאוחר יותר.";
        exit;
    }
} else {
    // אם מישהו ניסה להיכנס ישירות
    echo "גישה לא תקינה.";
    exit;
}
?>
