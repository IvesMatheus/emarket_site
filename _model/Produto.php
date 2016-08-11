<?php
    /**
    * Classe que representa um produto
    * @version 1
    * @author Ives Matheus
    */
    class Produto
    {
        /**
        * Id do produto
        */
        private $id;
        /**
        * Nome do produto
        */
        private $nome;
        /**
        * Peso do produto (em gramas ou litros)
        */
        private $peso;
        /**
        * Data de validade do produto
        */
        private $validade;
        /**
        * Quantidade em estoque pra venda pelo sistema
        */
        private $quantidade;
        /**
        * Preco do produto
        */
        private $preco;
        /**
        * Caminho da imagem que representa o produto
        */
        private $imagem

        public function __constructor()
        {
            $args = func_get_args();
            $num_args = func_num_args();

            if($num_args == 7)
            {
                $this->id = $args[0];
                $this->nome = $args[1];
                $this->peso = $args[2];
                $this->validade = $args[3];
                $this->quantidade = $args[4];
                $this->preco = $args[5];
                $this->imagem = $args[6];
            }
            else if($num_args == 6)
            {
                $this->id = 0;
                $this->nome = $args[0];
                $this->peso = $args[1];
                $this->validade = $args[2];
                $this->quantidade = $args[3];
                $this->preco = $args[4];
                $this->imagem = $args[5];
            }
            else
            {
                $this->id = 0;
                $this->nome = "";
                $this->peso = "";
                $this->validade = 0;
                $this->quantidade = 0;
                $this->preco = 0.0;
                $this->imagem = "";
            }
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setNome($nome)
        {
            $this->nome = $nome;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function setPeso($peso)
        {
            $this->peso = $peso;
        }

        public function getPeso()
        {
            return $this->peso;
        }

        public function setValidade($validade)
        {
            $this->validade = $validade;
        }

        public function getValidade()
        {
            return $this->validade;
        }

        public function setQuantidade($quantidade)
        {
            $this->quantidade = $quantidade;
        }

        public function getQuantidade()
        {
            return $this->quantidade;
        }

        public function setPreco($preco)
        {
            $this->preco = $preco;
        }

        public function getPreco()
        {
            return $this->preco;
        }

        public function setImagem($imagem)
        {
            $this->imagem = $imagem;
        }

        public function __toString()
        {
            return $this->id."<br>".$this->nome."<br>".$this->peso."<br>".$this->validade."<br>".$this->quantidade."<b>".$this->preco."<br>".$this->imagem;
        }
    }
?>
