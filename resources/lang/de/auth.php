<?php

// lang/de/auth.php

return [
    'login' => 'Anmelden',
    'login_explanation' => 'Bitte geben Sie Ihre E-Mail Adresse ein. Sie erhalten dann einen Link, um diese zu bestätigen und ihre Anmeldung zu vervollständigen.',
    'logout' => 'Abmelden',
    'register' => 'Registrieren',
    'reset_password' => 'Passwort zurücksetzen',
    'verify_email' => 'E-Mail-Adresse bestätigen',
    'verify_email.text' => 'Bitte bestätigen Sie Ihre E-Mail-Adresse, indem Sie auf den Link in der E-Mail klicken, die wir Ihnen gerade gesendet haben. Wenn Sie diese E-Mail nicht erhalten haben, überprüfen Sie bitte Ihren Spam-Ordner.',
    'verify_email.link_sent' => 'Ein neuer Bestätigungslink wurde an Ihre E-Mail-Adresse gesendet.',
    'verify_email.resend' => 'E-Mail erneut senden',
    'forgot_password' => 'Passwort vergessen?',
    'forgot_password.text' => 'Geben Sie Ihre E-Mail-Adresse ein, um einen Link zum Zurücksetzen Ihres Passworts zu erhalten.',
    'forgot_password.submit' => 'Link zum Zurücksetzen senden',
    'confirm_password' => 'Passwort bestätigen',
    'confirm_password.text' => 'Das ist eine geschützte Seite. Bitte bestätigen Sie Ihr Passwort, um fortzufahren.',
    'no_account' => 'Sie haben noch kein Konto?',
    'already_registered' => 'Sie haben bereits ein Konto?',
    'register_now' => 'Jetzt registrieren!',
    'login_now' => 'Jetzt anmelden!',
    'email' => 'E-Mail Adresse',
    'password' => 'Passwort',
    'remember_me' => 'Angemeldet bleiben',
    'forgot_password' => 'Passwort vergessen?',
    'username' => 'Benutzername',
    'full_name' => 'Vor- und Nachname (Rechnungen, ...)',
    'confirm_password' => 'Passwort bestätigen',
    'accept_terms' => 'Ich habe die <a href=":url">AGB</a> gelesen und verstanden und bin damit einverstanden.',
    'accept_privacy' => 'Ich habe die <a href=":url">Datenschutzerklärung</a> gelesen und verstanden und bin damit einverstanden.',
    'failed' => 'Diese Kombination aus Zugangsdaten wurde nicht in unserer Datenbank gefunden. Falls Sie noch kein Konto haben, registrieren Sie sich bitte zuerst!',
    // 'password' => 'Das eingegebene Passwort ist nicht korrekt.',
    'throttle' => 'Zu viele Loginversuche. Versuchen Sie es bitte in :seconds Sekunden nochmal.',

    'otp' => [
        'title' => 'Einmalpasswort',
        'explanation' => 'Bitte geben Sie das Einmalpasswort ein, das wir Ihnen gerade per E-Mail gesendet haben.',
        'email' => [
            'subject' => ':otp ist ihr Einmalpasswort',
            'greeting' => 'Hallo!',
            'message' => 'Ihr Einmalpasswort lautet',
            'explanation' => 'Dieses Einmalpasswort ist nur in den nächsten :minutes Minuten und nur für eine Anmeldung gültig. Bitte geben Sie es nicht weiter. Alternativ können sie den folgenden Link verwenden, um sich direkt anzumelden:',
        ]
    ]
];
