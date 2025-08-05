<?php 
 
return [ 
    'console' => [ 
        'test_command' => [ 
            'sending' => 'Envoi d\'un email de test à :email...', 
            'success' => 'Email de test envoyé avec succès !', 
            'error' => 'Échec de l\'envoi de l\'email de test : :error', 
            'default_subject' => 'Email de Test PHPMailer', 
            'default_message' => 'Ceci est un email de test envoyé en utilisant le Driver PHPMailer de Laravel.', 
        ], 
    ], 
    'emails' => [ 
        'welcome' => [ 
            'subject' => 'Bienvenue sur notre plateforme !', 
            'greeting' => 'Bienvenue :name !', 
            'message' => 'Merci de rejoindre notre plateforme. Nous sommes ravis de vous accueillir !', 
            'cta' => 'Commencer', 
        ], 
        'password_reset' => [ 
            'subject' => 'Demande de Réinitialisation de Mot de Passe', 
            'greeting' => 'Bonjour :name,', 
            'message' => 'Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.', 
            'cta' => 'Réinitialiser le Mot de Passe', 
            'expiry' => 'Ce lien de réinitialisation expirera dans :count minutes.', 
            'no_action' => 'Si vous n\'avez pas demandé de réinitialisation, aucune action n\'est requise.', 
        ], 
        'notification' => [ 
            'subject' => 'Nouvelle Notification', 
            'greeting' => 'Bonjour :name,', 
            'message' => 'Vous avez une nouvelle notification.', 
            'cta' => 'Voir la Notification', 
        ], 
        'order_confirmation' => [ 
            'subject' => 'Confirmation de Commande - Commande #:order_number', 
            'greeting' => 'Merci pour votre commande !', 
            'message' => 'Votre commande a été confirmée et est en cours de traitement.', 
            'order_details' => 'Détails de la Commande', 
            'order_number' => 'Numéro de Commande', 
            'order_date' => 'Date de Commande', 
            'total_amount' => 'Montant Total', 
            'cta' => 'Voir la Commande', 
        ], 
        'contact_form' => [ 
            'subject' => 'Nouveau Message de Formulaire de Contact', 
            'greeting' => 'Nouveau message de formulaire de contact reçu', 
            'from_name' => 'Nom de l\'Expéditeur', 
            'from_email' => 'Email de l\'Expéditeur', 
            'message' => 'Message', 
            'submitted_at' => 'Envoyé le', 
        ], 
    ], 
    'errors' => [ 
        'configuration' => 'Erreur de configuration PHPMailer', 
        'smtp_connection' => 'Échec de connexion SMTP', 
        'authentication' => 'Échec d\'authentification SMTP', 
        'sending' => 'Échec de l\'envoi d\'email', 
        'invalid_recipient' => 'Adresse email de destinataire invalide', 
    ], 
    'success' => [ 
        'email_sent' => 'Email envoyé avec succès', 
        'configuration_valid' => 'Configuration PHPMailer valide', 
    ], 
]; 
