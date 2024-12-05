<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';

if (!function_exists('enviarEmailSolicitacaoCadastro')) {
    function enviarEmailSolicitacaoCadastro($emailAdmin, $emailUsuario, $nomeUsuario) {
        try {
            $mail = new PHPMailer(true);

            include_once 'acessoServer.php';

            // Configurações do SMTP
            $mail->isSMTP();
            $mail->Host = host(); // Defina seu host SMTP
            $mail->SMTPAuth = true;
            $mail->Username = user(); // Seu usuário SMTP
            $mail->Password = pass(); // Sua senha SMTP
            $mail->SMTPSecure = 'ssl'; // Modo de criptografia
            $mail->Port = port(); // Porta SMTP
            $mail->CharSet = 'UTF-8';

            // Remetente
            $mail->setFrom('noreply@gremiotimoteo.online', 'Grêmio Gerenciamento');

            // Destinatário
            $mail->addAddress($emailAdmin, 'Administrador');

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = "[Grêmio Gerenciamento] Solicitação de Cadastro de Usuário";
            $mail->Body = 'Olá Administrador,<br><br>';
            $mail->Body .= 'O usuário <strong>' . $nomeUsuario . '</strong> com o e-mail <strong>' . $emailUsuario . '</strong> solicitou cadastro no sistema.<br>';
            $mail->Body .= 'Por favor, acesse o sistema para aprovar ou recusar essa solicitação.<br>';
            $mail->Body .= 'Acesse: <a href="https://seu-sistema.online/login.php">https://seu-sistema.online/login.php</a><br><br>';
            $mail->Body .= 'Atenciosamente,<br>';
            $mail->Body .= 'Equipe Grêmio Gerenciamento';

            // Envio do e-mail
            if (!$mail->send()) {
                echo 'Não foi possível enviar a mensagem.';
                echo 'Erro: ' . $mail->ErrorInfo;
            } else {
                echo 'E-mail enviado ao administrador!';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
    }
}
?>
