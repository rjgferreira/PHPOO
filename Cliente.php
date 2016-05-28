<?php
class Cliente{
	private $nome;
	private $email;
	private $endereco;
	private $numero;
	private $complemento;
	private $cep;
	private $cidade;
	private $uf;
	private $nascimento;
	private $sexo;
	private $classificacao;

	/**
	 * @return mixed
	 */
	public function getNome()
	{
		return $this->nome;
	}

	/**
	 * @param mixed $nome
	 * @return Cliente
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 * @return Cliente
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEndereco()
	{
		return $this->endereco;
	}

	/**
	 * @param mixed $endereco
	 * @return Cliente
	 */
	public function setEndereco($endereco)
	{
		$this->endereco = $endereco;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNumero()
	{
		return $this->numero;
	}

	/**
	 * @param mixed $numero
	 * @return Cliente
	 */
	public function setNumero($numero)
	{
		$this->numero = $numero;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getComplemento()
	{
		return $this->complemento;
	}

	/**
	 * @param mixed $complemento
	 * @return Cliente
	 */
	public function setComplemento($complemento)
	{
		$this->complemento = $complemento;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCep()
	{
		return $this->cep;
	}

	/**
	 * @param mixed $cep
	 * @return Cliente
	 */
	public function setCep($cep)
	{
		$this->cep = $cep;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCidade()
	{
		return $this->cidade;
	}

	/**
	 * @param mixed $cidade
	 * @return Cliente
	 */
	public function setCidade($cidade)
	{
		$this->cidade = $cidade;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUf()
	{
		return $this->uf;
	}

	/**
	 * @param mixed $uf
	 * @return Cliente
	 */
	public function setUf($uf)
	{
		$this->uf = $uf;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getNascimento()
	{
		return $this->nascimento;
	}

	/**
	 * @param mixed $nascimento
	 * @return Cliente
	 */
	public function setNascimento($nascimento)
	{
		$this->nascimento = $nascimento;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getSexo()
	{
		return $this->sexo;
	}

	/**
	 * @param mixed $sexo
	 * @return Cliente
	 */
	public function setSexo($sexo)
	{
		$this->sexo = $sexo;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getClassificacao()
	{
		return $this->classificacao;
	}

	/**
	 * @param mixed $nota
	 * @return Cliente
	 */
	public function setClassificacao($nota)
	{
		$this->classificacao = $nota;
	}
}
