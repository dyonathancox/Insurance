<?php
// Incluir o autoload do Composer para PHPMailer
require 'C:\xampp\htdocs\Projeto\vendor\autoload.php';

// Agora você pode usar a classe PHPMailer sem problemas
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception;

// Variáveis recebidas do formulário
$nome = $_POST['nome'] ?? '';
$sobrenome = $_POST['sobrenome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';
$data_envio = date('Y-m-d');
$hora_envio = date('H:i:s');

// Conectar ao banco de dados
$servidor = "localhost"; // ou o endereço do servidor do banco de dados
$usuario_bd = "root"; // seu usuário do banco de dados
$senha_bd = ""; // sua senha do banco de dados
$banco = "contato"; // nome do seu banco de dados

// Estabelecer conexão
$conexao = new mysqli($servidor, $usuario_bd, $senha_bd, $banco);

// Verificar conexão
if ($conexao->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conexao->connect_error);
}

// Preparar e executar a consulta SQL para inserir os dados na tabela "contatos"
$sql = "INSERT INTO contatos (nome, sobrenome, telefone, email, mensagem, data_envio, hora_envio) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssssss", $nome, $sobrenome, $telefone, $email, $mensagem, $data_envio, $hora_envio);

if ($stmt->execute()) {
    echo "Dados inseridos com sucesso no banco de dados!";
} else {
    echo "Erro ao inserir dados no banco de dados: " . $conexao->error;
}

// Fechar a conexão com o banco de dados
$stmt->close();
$conexao->close();

// Criar uma nova instância do PHPMailer
$mail = new PHPMailer(true); // Passando 'true' habilita exceções para manipulação de erros

// Adicione este bloco de código após a linha que fecha a conexão com o banco de dados
// Criar uma nova instância do PHPMailer
$mail_contato = new PHPMailer(true); // Passando 'true' habilita exceções para manipulação de erros

try {
    // Configurar as configurações do servidor de e-mail
    $mail_contato->isSMTP(); // Define o método de envio como SMTP
    $mail_contato->Host       = 'smtp.gmail.com'; // Altere para o seu servidor SMTP
    $mail_contato->SMTPAuth   = true; // Ativar autenticação SMTP
    $mail_contato->Username   = 'mailteste0303@gmail.com'; // Altere para o seu e-mail SMTP
    $mail_contato->Password   = '2829217565'; // Altere para a sua senha SMTP
    $mail_contato->SMTPSecure = 'tls'; // Criptografia TLS, também aceita 'ssl'
    $mail_contato->Port       = 587; // Porta TCP para conexão

    // Definir remetente, destinatário, assunto e corpo do e-mail
    $mail_contato->setFrom('mailteste0303@gmail.com', 'Seu Nome'); // Altere para o seu nome
    $mail_contato->addAddress($email); // Endereço de e-mail do destinatário, pegue do formulário

    $mail_contato->Subject = 'Contato recebido';
    $mail_contato->isHTML(true); // Define o formato do e-mail como HTML
    $mail_contato->Body    = "
        <html>
            <p>Obrigado por entrar em contato conosco, $nome $sobrenome!</p>
            <p>Aqui estão os detalhes da sua mensagem:</p>
            <p><b>Nome:</b> $nome $sobrenome</p>
            <p><b>Telefone:</b> $telefone</p>
            <p><b>E-mail:</b> $email</p>
            <p><b>Mensagem:</b> $mensagem</p>
            <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
        </html>
    ";

    // Enviar e-mail
    $mail_contato->send();
    echo 'E-mail de confirmação enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail de confirmação: {$mail_contato->ErrorInfo}";
}

// Redirecionar para uma página de confirmação após 3 segundos
echo '<script>';
echo 'alert("Sua mensagem foi enviada com sucesso!");'; // Exibe o alerta na tela
echo 'window.location.href = "index.html";'; // Redireciona para a página inicial após o alerta
echo '</script>';
?>
