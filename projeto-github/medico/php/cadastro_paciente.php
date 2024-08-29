<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Pesquisar'])) {
    $Cep = preg_replace('/[^0-9]/', '', $_POST["_Endereco"]);
    
    $url = "https://viacep.com.br/ws/{$Cep}/json/";
    
    $response = file_get_contents($url);
    
    $data = json_decode($response, true);

    if (!isset($data['erro'])) {
        $rua = $data['logradouro'] ?? 'Não Encontrado';    
        $bairro = $data['bairro'] ?? 'Não Encontrado';
        $cidade = $data['localidade'] ?? 'Não Encontrado';
        $uf = $data['uf'] ?? 'Não Encontrado';
        $_Resultado = "{$uf}-{$cidade}-{$bairro}-{$rua}";
    } else {
        echo "Não foi Possível realizar a busca";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir</title>
    <link rel="stylesheet" href="../css/cadastro_paciente.css">
</head>
<body>
    <div class="titulo">
        <h1>Cadastro de Paciente</h1>
    </div>
    <div id="container">
        <h2 class="destaque">Preencha as informações do paciente</h2>
        <form action="" method="POST" id="form_endereco">
            <div name="api-card" id="api-card">
                <p>CEP</p>
                <input class="endereco" type="text" required placeholder="00000000" name="_Endereco" value="<?php echo isset($_POST['_Endereco']) ? htmlspecialchars($_POST['_Endereco']) : ''; ?>">
                <div class="botao"><input type="submit" name="Pesquisar" value="Pesquisar"></div>

                <p>Logradouro</p>
                <input class="endereco" placeholder="Logradouro" type="text" value="<?php echo isset($rua) ? htmlspecialchars($rua) : ''; ?>">
        
                <p>Bairro</p>
                <input class="endereco" type="text" value="<?php echo isset($bairro) ? htmlspecialchars($bairro) : ''; ?>" placeholder="Bairro">
        
                <p>Cidade</p>
                <input class="endereco" type="text" value="<?php echo isset($cidade) ? htmlspecialchars($cidade) : ''; ?>" placeholder="Cidade">
                
                <p>Estado</p>
                <input class="endereco" type="text" value="<?php echo isset($uf) ? htmlspecialchars($uf) : ''; ?>" placeholder="Estado">
            </div>
        </form>
        <form action="query_cadastro.php" method="post" id="form_dados_cli">
            <div id="CardCadastro">
                <p>Nome</p>
                <input class="dado_cli" type="text"  required placeholder="Nome" name="_Nome" value="<?php echo isset($_POST['_Nome']) ? htmlspecialchars($_POST['_Nome']) : ''; ?>">

                <p>Senha</p>
                <input class="dado_cli" type="password" required placeholder="Senha" name="_Senha" value="<?php echo isset($_POST['_Senha']) ? htmlspecialchars($_POST['_Senha']) : ''; ?>">

                <p>Gmail</p>
                <input class="dado_cli" type="email" required placeholder="Gmail" name="_Gmail" value="<?php echo isset($_POST['_Gmail']) ? htmlspecialchars($_POST['_Gmail']) : ''; ?>">

                <p>CPF</p>
                <input class="dado_cli" type="text" required placeholder="CPF" name="_Cpf" value="<?php echo isset($_POST['_Cpf']) ? htmlspecialchars($_POST['_Cpf']) : ''; ?>">
        
                <p>Nome de Usuário</p>
                <input class="dado_cli" type="text" required placeholder="Nome de Usuario" name="_NomeUsu" value="<?php echo isset($_POST['_NomeUsu']) ? htmlspecialchars($_POST['_NomeUsu']) : ''; ?>">

                <p>Data de Nascimento</p>
                <input class="nasc_cli" type="date" required placeholder="Data de Nascimento" name="_Data" value="<?php echo isset($_POST['_Data']) ? htmlspecialchars($_POST['_Data']) : ''; ?>">
                <input type="hidden" name="_Resultado" value="<?php echo isset($_Resultado) ? htmlspecialchars($_Resultado) : ''; ?>">

                <div class="botao"><input type="submit" value="Cadastrar"></div>
                <a href="interface_med.php">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>