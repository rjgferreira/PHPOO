<?php
$rota = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$path = urldecode(substr($rota['path'], 1));
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="container">
    <?php
        $conn = new \PDO("mysql:host=localhost;dbname=oo", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        if($path!='' && $path!='DESC' && $path!='ASC') {
            // Se existe ID
            $sql = "SELECT * FROM clientes";
            if(strlen($path)==11)
                $sql .= " WHERE cpf = '$path'";
            else
                $sql .= " WHERE cnpj = '$path'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $clientes = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<h2>Listar informa&ccedil;&otilde;es de Clientes</h2>";
            echo '<table class="table"><tr><td align="right" width="15%"><b>Nome:</b></td><td>' . $clientes['nome'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>E-mail:</b></td><td>' . $clientes['email'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Endere&ccedil;o:</b></td><td>' . $clientes['endereco'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Numero:</b></td><td>' . $clientes['numero'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Complemento:</b></td><td>' . $clientes['complemento'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>CEP:</b></td><td>' . $clientes['cep'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Cidade:</b></td><td>' . $clientes['cidade'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>UF:</b></td><td>' . $clientes['uf'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Nascimento:</b></td><td>' . $clientes['nascimento'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Sexo:</b></td><td>' . $clientes['sexo'] . "</td></tr>" .
                '<tr><td align="right" width="15%"><b>Classifica&ccedil;&atilde;o:</b></td><td>' . $clientes['classificacao'] . "</td></tr>" .
                ($clientes['cnpj']!='' ? '<tr><td align="right" width="15%"><b>Pessoa Jur&iacute;dica</b></td><td>'.'CNPJ: '.$clientes['cnpj'].'</td>':'<td align="right" width="15%"><b>Pessoa F&iacute;sica</b></td><td>'.'CPF: '.$clientes['cpf'].'</td></tr>') .
                ($clientes['cnpj']!='' ? '<tr><td align="right" width="15%"><b>Endere&ccedil;o 2</b>:</td><td>'.$clientes['enderecobranca'].'</td></tr>':'') .
                '</table><a class="btn btn-primary" href="./">VOLTAR</a>';

        }else{
            $sql = "SELECT id, nome, email, cpf, cnpj, classificacao FROM clientes";
            if($path=='DESC')
                $sql .= " ORDER BY id $path";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo '<h2>Listagem de clientes</h2>';
            echo '<a style="margin-left:5px;" class="btn btn-primary pull-right" href="/DESC">&downarrow;</a><a class="btn btn-primary pull-right" href="/ASC">&uparrow;</a>';
            echo '<table class="table"><thead><th>Nome</th><th>E-mail</th><th>Pessoa</th><th>Classifica&ccedil;&atilde;o</th></thead><tbody>';
            foreach ($clientes as $cliente) {
                echo    '<tr><td>'.$cliente['nome'] .
                    '</td><td>' . $cliente['email'] .
                    '</td><td>' . ($cliente['cnpj']!=''?"Jur&iacute;dica":"F&iacute;sica") .
                    '</td><td>'.$cliente['classificacao'] .
                    '</td><td align="right"><a class="btn btn-default" href="/'.($cliente['cnpj']!=''?$cliente['cnpj']:$cliente['cpf']).'">saber +</a></td></tr>';
            }
            echo '</tbody></table>';
        }
    ?>
    </div>
</div>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
