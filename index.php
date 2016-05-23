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
        require_once('Cliente.php');
        $clientes = [];
        for ($i = 0; $i < 10; $i++){
            $clientes[$i] = new Cliente();
            $clientes[$i]->nome = "Nome cliente $i";
            $clientes[$i]->email = "emailcliente$i@email.com";
            $clientes[$i]->endereco = "Rua $i";
            $clientes[$i]->numero = "$i";
            $clientes[$i]->complemento = "Complemento $i";
            $clientes[$i]->cep = sprintf("%08s", $i);
            $clientes[$i]->cidade = "Cidade $i";
            $clientes[$i]->uf = "UF $i";
            $clientes[$i]->nascimento = sprintf("%02s", $i) . "/" . sprintf("%02s", $i) . "/2016";
            $clientes[$i]->sexo = ($i % 2 == 0 ? 'M' : 'F');
            $clientes[$i]->cpf = sprintf("%011s", $i);
        }
        if($path=='DESC')
            arsort($clientes);
        else if($path=='ASC')
            asort($clientes);
        if(strlen($path) == 11){
            echo "<h2>Listar informa&ccedil;&otilde;es de cliente</h2>";
            $vrfy = function ($c) use ($path) {
                if ($c->cpf == $path) {
                    echo '<table class="table"><tr><td align="right" width="15%"><b>Nome:</b></td><td>' . $c->nome . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>E-mail:</b></td><td>' . $c->email . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Endereco:</b></td><td>' . $c->endereco . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Numero:</b></td><td>' . $c->numero . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Complemento:</b></td><td>' . $c->complemento . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>CEP:</b></td><td>' . $c->cep . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Cidade:</b></td><td>' . $c->cidade . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>UF:</b></td><td>' . $c->uf . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Nascimento:</b></td><td>' . $c->nascimento . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Sexo:</b></td><td>' . $c->sexo . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>CPF:</b></td><td>' . $c->cpf . '</table><br><br><br><a class="btn btn-primary" href="./">VOLTAR</a>';
                }else{
                    return false;
                }
                return false;
            };
            array_walk($clientes, $vrfy);
        }else{
            echo '<h2>Listagem de clientes</h2>';
            echo '<a style="margin-left:5px;" class="btn btn-primary pull-right" href="/DESC">&downarrow;</a><a class="btn btn-primary pull-right" href="/ASC">&uparrow;</a>';
            echo '<table class="table"><thead><th>Nome</th><th>E-mail</th><th>Sexo</th></thead><tbody>';
            foreach ($clientes as $cliente) {
                echo '<tr><td>'.$cliente->nome . '</td><td>'.$cliente->email . '</td><td>'.$cliente->sexo . '</td><td align="right"><a class="btn btn-default" href="/' . $cliente->cpf . '">saber +</a></td></tr>';
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
