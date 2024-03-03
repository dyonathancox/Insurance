<?php
// Incluir o autoload do Composer para PHPMailer
require 'C:\xampp\htdocs\Projeto\vendor\autoload.php';

// Agora você pode usar a classe PHPMailer sem problemas
use PHPMailer\PHPMailer\PHPMailer;
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

try {
    // Configurar as configurações do servidor de e-mail
    $mail->isSMTP(); // Define o método de envio como SMTP
    $mail->Host       = 'smtp.gmail.com'; // Altere para o seu servidor SMTP
    $mail->SMTPAuth   = true; // Ativar autenticação SMTP
    $mail->Username   = 'rascunho628@gmail.com'; // Altere para o seu e-mail SMTP
    $mail->Password   = '401330278coX!'; // Altere para a sua senha SMTP
    $mail->SMTPSecure = 'tls'; // Criptografia TLS, também aceita 'ssl'
    $mail->Port       = 587; // Porta TCP para conexão

    // Definir remetente, destinatário, assunto e corpo do e-mail
    $mail->setFrom($email, $nome . ' ' . $sobrenome);
    $mail->addAddress('rascunho628@gmail.com'); // Endereço de e-mail de destino
    $mail->Subject = 'Contato pelo Site';
    $mail->isHTML(true); // Define o formato do e-mail como HTML
    $mail->Body    = "
        <html>
            <p><b>Nome: </b>$nome $sobrenome</p>
            <p><b>Telefone: </b>$telefone</p>
            <p><b>E-mail: </b>$email</p>
            <p><b>Mensagem: </b>$mensagem</p>
            <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
        </html>
    ";

    // Enviar e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso!';
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}

// Redirecionar para uma página de confirmação após 3 segundos
echo '<script>';
echo 'setTimeout(function(){';
echo 'window.location.href = "index.html";';
echo '}, 3000);'; // Tempo em milissegundos (3 segundos)
echo '</script>';

// Redirecionar para uma página de confirmação
header("Location: index.html");
exit();
?>
