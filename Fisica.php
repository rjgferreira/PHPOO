<?php
require_once"Cliente.php";
require_once "ClassificacaoInterface.php";
class Fisica extends Cliente implements ClassifyInterface{
    private $cpf;
    public function classificar($nota){
        parent::setClassificacao($nota);
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
}