<?php
    include_once "../_model/Conexao.php";
    include_once "../_model/Produto.php";
    include_once "CategoriaDAO.php";

    /**
     * Classe DAO de produto que implementa métodos de CRUD e outras que meche no BD
     * @version 1
     * @author Ives Matheus
     */
    class ProdutoDAO
    {

        function __construct()
        {   }

        /**
        * Método que insere vários produtos no BD
        * @param $produtos array de produto
        * @return true ou false para caso de sucesso da inserção de dados
        * @version 1
        * @author Ives Matheus
        */
        public function inserir($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "INSERT INTO produto(nome, peso, validade, quantidade, preco, imagem, id_categoria) VALUES(:nome, :peso, :validade, :quantidade, :preco, :imagem, :id_categoria)";
                //$con->exec("set names utf8");
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("nome", $produto->getNome());
                    $stm->bindValue("peso", $produto->getPeso());
                    $stm->bindValue("validade", $produto->getValidade());
                    $stm->bindValue("quantidade", $produto->getQuantidade());
                    $stm->bindValue("preco", $produto->getPreco());
                    $stm->bindValue("imagem", $produto->getImagem());
                    $stm->bindValue("id_categoria", $produto->getCategoria()->getId());

                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que lista todos os produtos no BD
        * @return array contendo todos os produtos do BD
        * @version 1
        * @author Ives Matheus
        */
        public function listar()
        {
            $retorno = array(0 => null);
            $i = 0;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto";

                $stm = $con->prepare($sql);
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $produto = new Produto();
                    $produto->setId($row["id"]);
                    $produto->setNome($row["nome"]);
                    $produto->setPeso($row["peso"]);
                    $produto->setValidade($row["validade"]);
                    $produto->setQuantidade($row["quantidade"]);
                    $produto->setPreco($row["preco"]);
                    $produto->setImagem($row["imagem"]);
                    $produto->setCategoria(CategoriaDAO::listaPorId(new Categoria($row["id_categoria"], "", "", "")));

                    $retorno[$i] = $produto;
                    $i++;
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que procura um produto filtrado pelo seu id no BD
        * @param $produto objeto contendo o id
        * @return retorna um produto resultado da consulta ou null caso não exista
        * @version 1
        * @author Ives Matheus
        */
        public static function listaPorId($produto)
        {
            $retorno = null;

            try
            {
                $con = Conexao::getConexao();
                $sql = "SELECT * FROM produto WHERE id = :id";

                $stm = $con->prepare($sql);
                $stm->bindValue("id", $produto->getId());
                $stm->execute();

                while($row = $stm->fetch())
                {
                    $retorno = new Produto();
                    $retorno->setId($row["id"]);
                    $retorno->setNome($row["nome"]);
                    $retorno->setPeso($row["peso"]);
                    $retorno->setValidade($row["validade"]);
                    $retorno->setQuantidade($row["quantidade"]);
                    $retorno->setPreco($row["preco"]);
                    $retorno->setImagem($row["imagem"]);
                    $retorno->setCategoria(CategoriaDAO::listaPorId(new Categoria($row["id_categoria"], "", "", "")));
                }
            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que atualiza vários produtos no BD
        * @param $produtos array de produto
        * @return true ou false para caso de sucesso na atualização de dados
        * @version 1
        * @author Ives Matheus
        */
        public function atualizar($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "UPDATE produto SET nome = :nome, peso = :peso, validade = :validade, quantidade = :quantidade, preco = :preco, imagem = :imagem, id_categoria = :id_categoria WHERE id = :id";
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $produto->getId());
                    $stm->bindValue("nome", $produto->getNome());
                    $stm->bindValue("peso", $produto->getPeso());
                    $stm->bindValue("validade", $produto->getValidade());
                    $stm->bindValue("quantidade", $produto->getQuantidade());
                    $stm->bindValue("preco", $produto->getPreco());
                    $stm->bindValue("imagem", $produto->getImagem());
                    $stm->bindValue("id_categoria", $produto->getCategoria()->getId());

                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

        /**
        * Método que exclui vários produtos
        * @param $produtos array de produto
        * @return true ou false para caso de sucesso na exclusão de dados
        * @version 1
        * @author Ives Matheus
        */
        public function excluir($produtos)
        {
            $con = Conexao::getConexao();
            $retorno = false;

            try
            {
                $sql = "DELETE FROM produto WHERE id = :id";
                $con->beginTransaction();

                foreach ($produtos as $key => $produto)
                {
                    $stm = $con->prepare($sql);
                    $stm->bindValue("id", $produto->getId());
                    $stm->execute();
                }

                $retorno = $con->commit();
            }
            catch (PDOException $e)
            {
                $retorno = $con->rollBack();
                echo $e->getMessage();
            }
            finally
            {
                return $retorno;
            }
        }

    }

?>
