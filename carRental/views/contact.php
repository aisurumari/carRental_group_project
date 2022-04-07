<?php
session_start();
include "../src/Contact.php";

$contact = new Contact();
$isSent = $contact->send_mail("carRentalOffice@gmail.com", $_POST['topic'], $_POST['message'], $_POST['contactMail']);
if($isSent) {
    echo("Dziękujemy za kontakt. Życzymy miłego dnia.");
} else {
    echo("Niestety nie udało się przesłać wiadomości. Prosimy o kontakt później.");
}