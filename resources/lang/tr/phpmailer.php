<?php

return [
    'console' => [
        'test_command' => [
            'sending' => ':email adresine test e-postası gönderiliyor...',
            'success' => 'Test e-postası başarıyla gönderildi!',
            'error' => 'Test e-postası gönderilemedi: :error',
            'default_subject' => 'PHPMailer Test E-postası',
            'default_message' => 'Bu, Laravel PHPMailer Driver kullanılarak gönderilen bir test e-postasıdır.',
        ],
    ],
    'emails' => [
        'welcome' => [
            'subject' => 'Platformumuza hoş geldiniz!',
            'greeting' => 'Hoş geldin :name!',
            'message' => 'Platformumuza katıldığınız için teşekkür ederiz. Sizi aramızda görmekten heyecan duyuyoruz!',
            'cta' => 'Başlayın',
        ],
        'password_reset' => [
            'subject' => 'Şifre Sıfırlama Talebi',
            'greeting' => 'Merhaba :name,',
            'message' => 'Hesabınız için bir şifre sıfırlama talebi aldığımız için bu e-postayı alıyorsunuz.',
            'cta' => 'Şifreyi Sıfırla',
            'expiry' => 'Bu şifre sıfırlama bağlantısı :count dakika içinde sona erecek.',
            'no_action' => 'Şifre sıfırlama talebinde bulunmadıysanız, başka bir işlem yapmanıza gerek yoktur.',
        ],
        'notification' => [
            'subject' => 'Yeni Bildirim',
            'greeting' => 'Merhaba :name,',
            'message' => 'Yeni bir bildiriminiz var.',
            'cta' => 'Bildirimi Görüntüle',
        ],
        'order_confirmation' => [
            'subject' => 'Sipariş Onayı - Sipariş #:order_number',
            'greeting' => 'Siparişiniz için teşekkür ederiz!',
            'message' => 'Siparişiniz onaylandı ve işleniyor.',
            'order_details' => 'Sipariş Detayları',
            'order_number' => 'Sipariş Numarası',
            'order_date' => 'Sipariş Tarihi',
            'total_amount' => 'Toplam Tutar',
            'cta' => 'Siparişi Görüntüle',
        ],
        'contact_form' => [
            'subject' => 'Yeni İletişim Formu Gönderimi',
            'greeting' => 'Yeni iletişim formu gönderimi alındı',
            'from_name' => 'Gönderen Adı',
            'from_email' => 'Gönderen E-postası',
            'message' => 'Mesaj',
            'submitted_at' => 'Gönderim Tarihi',
        ],
    ],
    'errors' => [
        'configuration' => 'PHPMailer yapılandırma hatası',
        'smtp_connection' => 'SMTP bağlantısı başarısız',
        'authentication' => 'SMTP kimlik doğrulaması başarısız',
        'sending' => 'E-posta gönderilemedi',
        'invalid_recipient' => 'Geçersiz alıcı e-posta adresi',
    ],
    'success' => [
        'email_sent' => 'E-posta başarıyla gönderildi',
        'configuration_valid' => 'PHPMailer yapılandırması geçerli',
    ],
]; 