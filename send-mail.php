<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit;
}

function clean_input($value) {
    return trim(strip_tags($value ?? ""));
}

$to = "bobo_vas98@abv.bg";

$source = clean_input($_POST["source"] ?? "Сайт");
$name = clean_input($_POST["name"] ?? "");
$phone = clean_input($_POST["phone"] ?? "");
$checkin = clean_input($_POST["checkin"] ?? "");
$checkout = clean_input($_POST["checkout"] ?? "");
$adults = clean_input($_POST["adults"] ?? "");
$children = clean_input($_POST["children"] ?? "0");
$extra_message = clean_input($_POST["message"] ?? "");

if ($name === "" || $phone === "" || $checkin === "" || $checkout === "" || $adults === "") {
    echo "Моля, попълнете всички задължителни полета.";
    exit;
}

$subject = "Ново запитване от сайта - Къща Свети Георги";

$email_body = "Получено е ново запитване от сайта.\n\n";
$email_body .= "Източник: " . $source . "\n\n";
$email_body .= "Име: " . $name . "\n";
$email_body .= "Телефон: " . $phone . "\n\n";
$email_body .= "Настаняване: " . $checkin . "\n";
$email_body .= "Напускане: " . $checkout . "\n";
$email_body .= "Възрастни: " . $adults . "\n";
$email_body .= "Деца: " . $children . "\n";

if ($extra_message !== "") {
    $email_body .= "\nДопълнителна информация:\n" . $extra_message . "\n";
}

$headers = "From: website@kashta-svgeorgi.com\r\n";
$headers .= "Reply-To: website@kashta-svgeorgi.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $email_body, $headers)) {
    header("Location: thanks.html");
    exit;
}

echo "Възникна грешка при изпращането.";
exit;

?>
