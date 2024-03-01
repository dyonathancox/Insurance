<?php
// Configurações do banco de dados
$host = "localhost"; // Endereço do banco de dados (geralmente localhost)
$usuario = "dyonathan"; // Usuário do banco de dados (geralmente root)
$senha = ""; // Senha do banco de dados
$banco_de_dados = "formulario_contato"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = mysqli_connect($host, $usuario, $senha, $banco_de_dados);

// Verificar a conexão
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Coletar os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

// Inserir os dados no banco de dados
$sql = "INSERT INTO contatos (nome, sobrenome, telefone, email, mensagem) VALUES ('$nome', '$sobrenome', '$telefone', '$email', '$mensagem')";

if (mysqli_query($conn, $sql)) {
    echo "Obrigado por entrar em contato! Seus dados foram salvos com sucesso.";
} else {
    echo "Erro ao salvar os dados: " . mysqli_error($conn);
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
