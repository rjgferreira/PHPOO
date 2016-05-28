<?php
require_once"Cliente.php";
require_once "ClassificacaoInterface.php";
require_once "CobrancaInterface.php";
class Juridica extends Cliente implements ClassifyInterface, CobrancaInterface
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