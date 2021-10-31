<?php 

namespace app\model; 

use app\core\Model;

class ProdutoModel
{ 
    private $pdo; 

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function getAll()
    {
        $sql = 'SELECT 
                    produtos.id, produtos.nome, descricao, quantidade, preco, categorias.nome as categoria
                FROM
                    produtos, categorias, rel_prod_cat
                WHERE
                    produtos.id = rel_prod_cat.id_prod AND 
                    categorias.id = rel_prod_cat.id_cat
                ORDER BY 
                    produtos.nome ASC';
        
        $dt = $this->pdo->executeQuery($sql);

        $listaProd = null;

        foreach($dt as $dr)
            $listaProd[] = $this->collection($dr);

        return $listaProd;
    }

    public function getById(int $idProduto)
    {
        $sql = 'SELECT
                    produtos.id, produtos.nome, descricao, quantidade, preco, categorias.id as id_cat, categorias.nome as categoria
                FROM
                    produtos, categorias, rel_prod_cat
                WHERE
                    produtos.id = rel_prod_cat.id_prod AND 
                    categorias.id = rel_prod_cat.id_cat AND
                    produtos.id = :id_produto';

        $param = [
            ':id_produto' => $idProduto
        ];
        
        $dr = $this->pdo->executeQueryOneRow($sql, $param);

        $dadosProduto = null;

        $dadosProduto[] = $this->collection($dr);

        return $dadosProduto;
    }

    public function insert(Object $produto)
    {
        $this->pdo->beginTransaction();

        try {
            $sql1 = 'INSERT INTO 
                            produtos (nome, descricao, quantidade, preco) 
                        VALUES 
                            (:nome, :descricao, :quantidade, :preco)';

            $params1 = [
                ':nome' => $produto->nome,
                ':descricao' => $produto->descricao,
                ':quantidade' => $produto->quantidade,
                ':preco' => str_replace(',','.', str_replace('.','', $produto->preco))
            ];

            if(!$this->pdo->executeNonQuery($sql1, $params1))
                throw new \Exception();

            $id_produto = $this->pdo->getLastID();
            
            $sql2 = 'INSERT INTO 
                        rel_prod_cat (id_prod, id_cat) 
                    VALUES 
                        (:id_prod, :id_cat)';

            $params2 = [
                ':id_prod' => $id_produto,
                ':id_cat' => $produto->categoria
            ];

            if(!$this->pdo->executeNonQuery($sql2, $params2))
                throw new \Exception();

            $this->pdo->commit();
            
            return true;
            
        } catch (\Exception $e) {
            $this->pdo->rollback();
            return false;
        }
    }

    public function update(Object $produto)
    {
        $this->pdo->beginTransaction();

        try {
            $sql1 = 'UPDATE 
                        produtos
                    SET 
                        nome = :nome, descricao = :descricao, quantidade = :quantidade, preco = :preco
                    WHERE
                        id = :id';

            $params1 = [
                ':id' => $produto->id,
                ':nome' => $produto->nome,
                ':descricao' => $produto->descricao,
                ':quantidade' => $produto->quantidade,
                ':preco' => str_replace(',','.', str_replace('.','', $produto->preco))
            ];

            if(!$this->pdo->executeNonQuery($sql1, $params1))
                throw new \Exception();
            
            $sql2 = 'UPDATE 
                        rel_prod_cat
                    SET 
                        id_cat = :id_cat
                    WHERE
                        id_prod = :id_prod';

            $params2 = [
                ':id_prod' => $produto->id,
                ':id_cat' => $produto->categoria
            ];

            if(!$this->pdo->executeNonQuery($sql2, $params2))
                throw new \Exception();

            $this->pdo->commit();
            
            return true;
            
        } catch (\Exception $e) {
            $this->pdo->rollback();
            return false;
        }
    }

    public function delete(int $idProduto)
    {
        $this->pdo->beginTransaction();

        try {
            $sql1 = 'DELETE FROM
                        produtos
                    WHERE
                        id = :id';

            $params1 = [
                ':id' => $idProduto
            ];

            if(!$this->pdo->executeNonQuery($sql1, $params1))
                throw new \Exception();
            
                $sql2 = 'DELETE FROM
                            rel_prod_cat
                        WHERE
                            id_prod = :id';

                $params2 = [
                    ':id' => $idProduto
                ];

            if(!$this->pdo->executeNonQuery($sql2, $params2))
                throw new \Exception();

            $this->pdo->commit();
            
            return true;
            
        } catch (\Exception $e) {
            $this->pdo->rollback();
            return false;
        }
    }

    private function collection($param)
    {
        return (object)[
            'id' => $param['id'] ?? null,
            'id_cat' => $param['id_cat'] ?? null,
            'nome' => $param['nome'] ?? null,
            'preco' => $param['preco'] ?? null,
            'descricao' => $param['descricao'] ?? null,
            'categoria' => $param['categoria'] ?? null,
            'quantidade' => $param['quantidade'] ?? null
        ];
    }
}