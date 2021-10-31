<?php 

namespace app\model; 

use app\core\Model;

class CategoriaModel
{ 
    private $pdo; 

    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function getAll()
    {
        $sql = 'SELECT 
                    *
                FROM
                    categorias
                ORDER BY 
                    nome ASC';
        
        $dt = $this->pdo->executeQuery($sql);

        $listaCat = null;

        foreach($dt as $dr)
            $listaCat[] = $this->collection($dr);

        return $listaCat;
    }

    private function collection($param)
    {
        return (object)[
            'id' => $param['id'] ?? null,
            'nome' => $param['nome'] ?? null
        ];
    }
}