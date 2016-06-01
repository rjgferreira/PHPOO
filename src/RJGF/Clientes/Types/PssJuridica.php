<?php
namespace RJGF\Clientes\Types;

use RJGF\Clientes\Cliente;
use RJGF\Clientes\Interfaces\EndrCobrancaInterface;
use RJGF\Clientes\Interfaces\ClassificacaoInterface;

class PssJuridica extends Cliente implements ClassificacaoInterface, EndrCobrancaInterface
{
    private $cnpj;
    private $endCoranca;
    public function classificar($nota){
        parent::setClassificacao($nota);
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getEndCobranca()
    {
        return $this->endCoranca;
    }

    /**
     * @param mixed $cnpj
     */
    public function setEndCobranca($end)
    {
        $this->endCoranca = $end;
    }}