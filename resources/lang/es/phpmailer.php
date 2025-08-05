<?php 
 
return [ 
    'console' => [ 
        'test_command' => [ 
            'sending' => 'Enviando email de prueba a :email...', 
            'success' => '¡Email de prueba enviado exitosamente!', 
            'error' => 'Error al enviar email de prueba: :error', 
            'default_subject' => 'Email de Prueba PHPMailer', 
            'default_message' => 'Este es un email de prueba enviado usando el Driver PHPMailer de Laravel.', 
        ], 
    ], 
    'emails' => [ 
        'welcome' => [ 
            'subject' => '¡Bienvenido a nuestra plataforma!', 
            'greeting' => '¡Bienvenido :name!', 
            'message' => 'Gracias por unirte a nuestra plataforma. ¡Estamos emocionados de tenerte a bordo!', 
            'cta' => 'Comenzar', 
        ], 
        'password_reset' => [ 
            'subject' => 'Solicitud de Restablecimiento de Contraseña', 
            'greeting' => 'Hola :name,', 
            'message' => 'Recibes este email porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.', 
            'cta' => 'Restablecer Contraseña', 
            'expiry' => 'Este enlace de restablecimiento de contraseña expirará en :count minutos.', 
            'no_action' => 'Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna acción adicional.', 
        ], 
        'notification' => [ 
            'subject' => 'Nueva Notificación', 
            'greeting' => 'Hola :name,', 
            'message' => 'Tienes una nueva notificación.', 
            'cta' => 'Ver Notificación', 
        ], 
        'order_confirmation' => [ 
            'subject' => 'Confirmación de Pedido - Pedido #:order_number', 
            'greeting' => '¡Gracias por tu pedido!', 
            'message' => 'Tu pedido ha sido confirmado y está siendo procesado.', 
            'order_details' => 'Detalles del Pedido', 
            'order_number' => 'Número de Pedido', 
            'order_date' => 'Fecha del Pedido', 
            'total_amount' => 'Monto Total', 
            'cta' => 'Ver Pedido', 
        ], 
        'contact_form' => [ 
            'subject' => 'Nuevo Envío de Formulario de Contacto', 
            'greeting' => 'Se recibió un nuevo envío del formulario de contacto', 
            'from_name' => 'Nombre del Remitente', 
            'from_email' => 'Email del Remitente', 
            'message' => 'Mensaje', 
            'submitted_at' => 'Enviado el', 
        ], 
    ], 
    'errors' => [ 
        'configuration' => 'Error de configuración de PHPMailer', 
        'smtp_connection' => 'Conexión SMTP fallida', 
        'authentication' => 'Autenticación SMTP fallida', 
        'sending' => 'Error al enviar email', 
        'invalid_recipient' => 'Dirección de email de destinatario inválida', 
    ], 
    'success' => [ 
        'email_sent' => 'Email enviado exitosamente', 
        'configuration_valid' => 'Configuración de PHPMailer válida', 
    ], 
]; 
