<?php 
 
return [ 
    'console' => [ 
        'test_command' => [ 
            'sending' => 'Test-E-Mail wird an :email gesendet...', 
            'success' => 'Test-E-Mail erfolgreich gesendet!', 
            'error' => 'Fehler beim Senden der Test-E-Mail: :error', 
            'default_subject' => 'PHPMailer Test-E-Mail', 
            'default_message' => 'Dies ist eine Test-E-Mail, die mit dem Laravel PHPMailer Driver gesendet wurde.', 
        ], 
    ], 
    'emails' => [ 
        'welcome' => [ 
            'subject' => 'Willkommen auf unserer Plattform!', 
            'greeting' => 'Willkommen :name!', 
            'message' => 'Vielen Dank, dass Sie sich unserer Plattform angeschlossen haben. Wir freuen uns, Sie an Bord zu haben!', 
            'cta' => 'Loslegen', 
        ], 
        'password_reset' => [ 
            'subject' => 'Passwort-Reset-Anfrage', 
            'greeting' => 'Hallo :name,', 
            'message' => 'Sie erhalten diese E-Mail, weil wir eine Passwort-Reset-Anfrage für Ihr Konto erhalten haben.', 
            'cta' => 'Passwort Zurücksetzen', 
            'expiry' => 'Dieser Passwort-Reset-Link läuft in :count Minuten ab.', 
            'no_action' => 'Wenn Sie keinen Passwort-Reset angefordert haben, ist keine weitere Aktion erforderlich.', 
        ], 
        'notification' => [ 
            'subject' => 'Neue Benachrichtigung', 
            'greeting' => 'Hallo :name,', 
            'message' => 'Sie haben eine neue Benachrichtigung.', 
            'cta' => 'Benachrichtigung Anzeigen', 
        ], 
        'order_confirmation' => [ 
            'subject' => 'Bestellbestätigung - Bestellung #:order_number', 
            'greeting' => 'Vielen Dank für Ihre Bestellung!', 
            'message' => 'Ihre Bestellung wurde bestätigt und wird bearbeitet.', 
            'order_details' => 'Bestelldetails', 
            'order_number' => 'Bestellnummer', 
            'order_date' => 'Bestelldatum', 
            'total_amount' => 'Gesamtbetrag', 
            'cta' => 'Bestellung Anzeigen', 
        ], 
        'contact_form' => [ 
            'subject' => 'Neue Kontaktformular-Eingabe', 
            'greeting' => 'Neue Kontaktformular-Eingabe erhalten', 
            'from_name' => 'Absendername', 
            'from_email' => 'Absender-E-Mail', 
            'message' => 'Nachricht', 
            'submitted_at' => 'Eingesendet am', 
        ], 
    ], 
    'errors' => [ 
        'configuration' => 'PHPMailer-Konfigurationsfehler', 
        'smtp_connection' => 'SMTP-Verbindung fehlgeschlagen', 
        'authentication' => 'SMTP-Authentifizierung fehlgeschlagen', 
        'sending' => 'E-Mail-Sendung fehlgeschlagen', 
        'invalid_recipient' => 'Ungültige Empfänger-E-Mail-Adresse', 
    ], 
    'success' => [ 
        'email_sent' => 'E-Mail erfolgreich gesendet', 
        'configuration_valid' => 'PHPMailer-Konfiguration gültig', 
    ], 
]; 
