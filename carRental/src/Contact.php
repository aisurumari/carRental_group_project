<?php


class Contact
{
    public function send_mail($to_email = "carRentalOffice@gmail.com", $subject, $body, $headers): bool
    {
        return (mail($to_email, $subject, $body, $headers));
    }
}
