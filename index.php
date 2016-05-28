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
        require_once('Fisica.php');
        require_once('Juridica.php');
        $clientes = [];
        for ($i = 0; $i < 10; $i++){
            if($i % 2 == 0)
                $clientes[$i] = new Fisica();
            else
                $clientes[$i] = new Juridica();

            $clientes[$i]->setNome("Nome cliente $i")
                        ->setEmail("emailcliente$i@email.com")
                        ->setEndereco("Rua $i")
                        ->setNumero("$i")
                        ->setComplemento("Complemento $i")
                        ->setCep(sprintf("%08s", $i))
                        ->setCidade("Cidade $i")
                        ->setUf("UF $i")
                        ->setNascimento(sprintf("%02s", $i) . "/" . sprintf("%02s", $i) . "/2016")
                        ->setSexo(($i % 2 == 0 ? 'M' : 'F'));
            if($i % 2 == 0)
                $clientes[$i]->setCpf(sprintf("%011s", $i));
            else {
                $clientes[$i]->setCnpj(sprintf("%014s", $i));
                $clientes[$i]->setEndCobranca("Endere&ccedil;o de cobran&ccedil;a ".$i);
            }
            $clientes[$i]->classificar(($i>4?$i-4:$i+1));
        }

        if($path=='DESC')
            krsort($clientes);
        if($path=='ASC')
            ksort($clientes);

        if($path!='' && $path!='DESC' && $path!='ASC'){
            echo "<h2>Listar informa&ccedil;&otilde;es de cliente</h2>";
            $vrfy = function ($c) use ($path) {
                if(($c instanceof Fisica && $c->getCpf() == $path) || ($c instanceof Juridica && $c->getCnpj() == $path)){
                    echo '<table class="table"><tr><td align="right" width="15%"><b>Nome:</b></td><td>' . $c->getNome() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>E-mail:</b></td><td>' . $c->getEmail() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Endere&ccedil;o:</b></td><td>' . $c->getEndereco() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Numero:</b></td><td>' . $c->getNumero() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Complemento:</b></td><td>' . $c->getComplemento() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>CEP:</b></td><td>' . $c->getCep() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Cidade:</b></td><td>' . $c->getCidade() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>UF:</b></td><td>' . $c->getUf() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Nascimento:</b></td><td>' . $c->getNascimento() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Sexo:</b></td><td>' . $c->getSexo() . "</td></tr>" .
                        '<tr><td align="right" width="15%"><b>Classifica&ccedil;&atilde;o:</b></td><td>' . $c->getClassificacao() . "</td></tr>" .
                        ($c instanceof Juridica ? '<tr><td align="right" width="15%"><b>Pessoa Jur&iacute;dica</b></td><td>'.'CNPJ: '.$c->getCnpj().'</td>':'<td align="right" width="15%"><b>Pessoa F&iacute;sica</b></td><td>'.'CPF: '.$c->getCpf().'</td></tr>') .
                        ($c instanceof Juridica ? '<tr><td align="right" width="15%"><b>Endere&ccedil;o 2</b>:</td><td>'.$c->getEndCobranca().'</td></tr>':'') .
                        '</table><a class="btn btn-primary" href="./">VOLTAR</a>';
                }else{
                    return false;
                }
                return false;
            };
            array_walk($clientes, $vrfy);
        }else{
            echo '<h2>Listagem de clientes</h2>';
            echo '<a style="margin-left:5px;" class="btn btn-primary pull-right" href="/DESC">&downarrow;</a><a class="btn btn-primary pull-right" href="/ASC">&uparrow;</a>';
            echo '<table class="table"><thead><th>Nome</th><th>E-mail</th><th>Pessoa</th><th>Classifica&ccedil;&atilde;o</th></thead><tbody>';
            foreach ($clientes as $cliente) {
                echo    '<tr><td>'.$cliente->getNome() .
                        '</td><td>' . $cliente->getEmail() .
                        '</td><td>' . ($cliente instanceof Juridica && $cliente->getCnpj()!=''?"Jur&iacute;dica":"F&iacute;sica") .
                        '</td><td>'.$cliente->getClassificacao() .
                        '</td><td align="right"><a class="btn btn-default" href="/'.($cliente instanceof Juridica && $cliente->getCnpj()!=''?$cliente->getCnpj():$cliente->getCpf()).'">saber +</a></td></tr>';
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
