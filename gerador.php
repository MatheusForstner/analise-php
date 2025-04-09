<?php
date_default_timezone_set('America/Sao_Paulo');
header('Content-Type: text/html; charset=UTF-8');

$servername = 'seu servidor';
$username = 'seu usuario';
$password = 'seu senha';
$database = 'tabela dados';

$connectionInfo = array("Database" => $database, "UID" => $username, "PWD" => $password, "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($servername, $connectionInfo);

if ($conn === false) {
    die("Erro de conexão: " . print_r(sqlsrv_errors(), true));
}

function isTrueValue($value) {
    $value = strtolower(trim($value));
    return in_array($value, ['sim', 's', 'sim.', 'yes', '✔']);
}

// Consulta TOP 20
$sql = "SELECT TOP 20 nome, cpf_cnpj, banco_bv, banco_santander, data_input FROM clientes ORDER BY id DESC";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die("Erro na consulta: " . print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="AptosDisplay.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="icon" href="https://www.jng.com.br/Assinaturas/logo_JNG_azul.png" sizes="32x32">
    <title>Lista de Clientes</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="preload" href="AptosDisplay.woff2" as="font" type="font/woff2" crossorigin>
    <style>
        @font-face {
            font-family: 'Aptos Display';
            src: url('AptosDisplay.woff2') format('woff2'),
                url('AptosDisplay.woff') format('woff');
        }

        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box; 
        }

        body {
            font-family: 'Aptos Display';
            background-image: linear-gradient(to right, #003676, #00aae3);
            height:100%;
        }

        .box{
            display: inline-block;
            margin: 20px;
        }

        .box-text{
            margin: 10px;
            margin-left: 550px;
        }

        .box-text a{
            color: #001d40;
            font-size: 26px;
        }

        .box-imagem{
            margin-left: 400px;
        }

        navbar {
            display: flex;
            align-items: center;
            background-color: #ffffff;
        }

        .hideblk{
            display: none;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 40px;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 0 10px #00000030;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .input-row {
            flex: 1 1 45%; /* ajusta para 2 colunas */
            display: flex;
            flex-direction: column;
        }

        .input-row label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-row input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-row input,
        .input-row select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .full {
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .button {
            background-color: #001d40;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0091E4;
        }
        h1 {
            text-align: center;
            color: white;
            margin-top: 20px;
        }

        a {
            color: white;
            text-decoration: none; 
            margin: 0 15px;
            font-size: 16px;
        }

        a:hover {
            color: #0091E4;
        }


        .select2::-ms-expand {
            display: none;
        }
        .select2::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 1em;
            background-color: #34495e;
            transition: .25s all ease;
            pointer-events: none;
        }


        .select2{
            border: 0;
            box-shadow: none;
            padding: 0 1em;
            color: #fff;
            background-color: transparent;
            background-image: none;
            height: 3em;
            border-radius: .25em;
            color: black;
            overflow: hidden;
        }

        footer {
            background-color: #000000;
            position:absolute;
            bottom:0px;
            width:100%;
        }

        .container-footer {
            display: flex;
            justify-content: space-between;
            color: white;
            padding: 10px;
        }

        .input-row {
            display: grid;
            grid-template-columns: 150px 1fr; /* Label e Input lado a lado */
            align-items: center;
            gap: 10px;
        }

        .form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 0 10px #00000030;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #003676;
            color: white;
        }
        .aguardando {
            color: orange;
            font-weight: bold;
            text-align: center;
        }

        footer {
            background-color: #000000;
        }

        .container-footer {
            display: flex;
            justify-content: space-between;
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <navbar>
                <div class="box">
                    <img src="https://www.jng.com.br/Assinaturas/logo_JNG_azul.png" width="100px" class="box-imagem">
                </div>
        </navbar>
    </header>


    <h1>Gerador Banco BV e Santander</h1>
    <div class="container">
        <div class="form">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Banco BV</th>
                    <th>Banco Santander</th>
                    <th>Data de Cadastro</th>
                </tr>

                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)):

                    $nome = $row['nome'];
                    $cpf = $row['cpf_cnpj'];
                    $bv = trim($row['banco_bv'] ?? '');
                    $santander = trim($row['banco_santander'] ?? '');

                    $dataInput = '';
                    if ($row['data_input'] instanceof DateTime) {
                        $dataInput = $row['data_input']->format('d/m/Y H:i');
                    } elseif (!empty($row['data_input'])) {
                        $dataInput = date('d/m/Y H:i', strtotime($row['data_input']));
                    }

                    if (!empty($bv) || !empty($santander)) {
                        // Define ícones
                        $bvIcon = isTrueValue($bv) ? '✅' : '❌';
                        $santanderIcon = isTrueValue($santander) ? '✅' : '❌'; 
                    } else {
                        echo "<tr>
                                <td>$nome</td>
                                <td>$cpf</td>
                                <td colspan='2' class='aguardando'>⏳ Aguardando Processamento</td>
                                <td>$dataInput</td>
                            </tr>";
                        continue;
                    }
                ?>

                <tr>
                    <td><?= $nome ?></td>
                    <td><?= $cpf ?></td>
                    <td><?= $bvIcon ?></td>
                    <td><?= $santanderIcon ?></td>
                    <td><?= $dataInput ?></td>
                </tr>

                <?php endwhile; ?>

            </table>
        </div>
    </div>

    <footer>
        <div class="container-footer">

            <p class="credits-left">
                © 2024 <a href="/home.html">Intranet | JNG</a>
            </p>
            
            <p class="credits-right">
                <span>Desenvolvido por Tecnologia <a href="http://jng.com.br">JNG</a></span>
            </p>
        </div> 
    </footer>
</body>
</html>
