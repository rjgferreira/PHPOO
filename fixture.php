<?php
define('CLASS_DIR','src/');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

class Fixture
{
    private $conexao;
    private $cliente;
    private $params;
    private $values;
    private $bind;

    public function __construct(PDO $cnx)
    {
        $this->conexao = $cnx;
        if($this->conexao)
            echo "<pre>Conexão estabelecida!</pre>";
        else
            echo "<pre>Falha na conexão!</pre>";
        $query = "CREATE TABLE IF NOT EXISTS clientes (
                  id int(11) NOT NULL AUTO_INCREMENT,
                  nome varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  email varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  endereco varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  numero varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  complemento varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  cep varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  cidade varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                  uf char(2) COLLATE utf8_unicode_ci NOT NULL,
                  nascimento date NOT NULL,
                  sexo char(1) COLLATE utf8_unicode_ci NOT NULL,
                  cpf char(11) COLLATE utf8_unicode_ci,
                  cnpj char(14) COLLATE utf8_unicode_ci,
                  enderecobranca varchar(255) COLLATE utf8_unicode_ci,
                  classificacao tinyint(1) NOT NULL,
                  PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
        $this->conexao->exec($query);
    }

    public function persist(RJGF\Clientes\Cliente $clnt)
    {
        $this->cliente = $clnt;
        if($this->cliente instanceof \RJGF\Clientes\Types\PssFisica || $this->cliente instanceof \RJGF\Clientes\Types\PssJuridica)
            echo "<pre>Cliente instanciado!<br>";
        echo "Reunindo informações para serem registradas.<br>";
        $params = "nome, email, endereco, numero, complemento, cep, cidade, uf, nascimento, sexo";
        $values = ":nome, :email, :endereco, :numero, :complemento, :cep, :cidade, :uf, :nascimento, :sexo";
        $data1 = array(
            ':nome' => $this->cliente->getNome(),
            ':email' => $this->cliente->getEmail(),
            ':endereco' => $this->cliente->getEndereco(),
            ':numero' => $this->cliente->getNumero(),
            ':complemento' => $this->cliente->getComplemento(),
            ':cep' => $this->cliente->getCep(),
            ':cidade' => $this->cliente->getCidade(),
            ':uf' => $this->cliente->getUf(),
            ':nascimento' => $this->cliente->getNascimento(),
            ':sexo' => $this->cliente->getSexo()
        );
        if ($this->cliente instanceof \RJGF\Clientes\Types\PssJuridica) {
            $params .= ", cnpj, enderecobranca";
            $values .= ", :cnpj, :endcob";
            $data2 = array(
                ':cnpj' => $this->cliente->getCnpj(),
                ':endcob' => $this->cliente->getEndCobranca()
            );
        } else if ($this->cliente instanceof \RJGF\Clientes\Types\PssFisica) {
            $params .= ", cpf";
            $values .= ", :cpf";
            $data2 = array(':cpf' => $this->cliente->getCpf());
        }
        $params .= ", classificacao";
        $values .= ", :classificacao";
        $data3 = array(':classificacao' => $this->cliente->getClassificacao());
        $data = array_merge($data1, $data2, $data3);
        $this->setParams($params);
        $this->setValues($values);
        $this->setBind($data);
        $this->flush();
    }

    public function flush()
    {
        $sql = "INSERT INTO clientes (".$this->getParams().") VALUES (".$this->getValues().")";
        $sttm = $this->conexao->prepare($sql);
        if($sttm->execute($this->getBind()))
            echo "Sucesso no registro das informações!</pre>";
        else
            echo "Sucesso no registro das informações!</pre>";
    }

    public function setParams($p){
        $this->params = $p;
    }

    public function setValues($v){
        $this->values = $v;
    }

    public function setBind($b){
        $this->bind = $b;
    }
    public function getParams(){
        return $this->params;
    }

    public function getValues(){
        return $this->values;
    }

    public function getBind(){
        return $this->bind;
    }
}

try {
    $conn = new \PDO("mysql:host=localhost;dbname=oo", "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $config = new Fixture($conn);
    $clientes = [];
    for ($i = 0; $i < 10; $i++){
        if($i % 2 == 0)
            $clientes[$i] = new RJGF\Clientes\Types\PssFisica();
        else
            $clientes[$i] = new RJGF\Clientes\Types\PssJuridica();

        $clientes[$i]->setNome("Nome Cliente ".($i+1))
            ->setEmail("emailcliente".($i+1)."@email.com")
            ->setEndereco("Rua ".($i+1))
            ->setNumero($i+1)
            ->setComplemento("Complemento ".($i+1))
            ->setCep(sprintf("%08s", $i+1))
            ->setCidade("Cidade ".($i+1))
            ->setUf("UF ".($i+1))
            ->setNascimento(sprintf("%02s", $i+1) . "/" . sprintf("%02s", $i+1) . "/2016")
            ->setSexo(($i % 2 == 0 ? 'M' : 'F'));
        if($i % 2 == 0)
            $clientes[$i]->setCpf(sprintf("%011s", $i+1));
        else {
            $clientes[$i]->setCnpj(sprintf("%014s", $i+1));
            $clientes[$i]->setEndCobranca("Endere&ccedil;o de cobran&ccedil;a ".($i+1));
        }
        $clientes[$i]->classificar(($i>4?$i-4:$i+1));
        $config->persist($clientes[$i]);
    }
    echo '<a href="./">Acessar sistema</a>';
}catch (PDOException $e){
    if($e->getCode()==1049)
        echo "<pre>Processo interrompido:<br><br>O banco de dados 'oo' não existe.</pre>";
}

