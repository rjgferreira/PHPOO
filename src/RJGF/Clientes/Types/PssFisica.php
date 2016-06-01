<?php
namespace RJGF\Clientes\Types;

use RJGF\Clientes\Cliente;
use RJGF\Clientes\Interfaces\ClassificacaoInterface;

class PssFisica extends Cliente implements ClassificacaoInterface{

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