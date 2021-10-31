<?php 

namespace app\controller;

use app\core\Controller;
use app\model\ProdutoModel;
use app\model\CategoriaModel;
use app\classes\Input;

class ProdutoController extends Controller
{
    private $produtoModel;
    private $categoriaModel;

    public function __construct()
    { 
        $this->produtoModel = new ProdutoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index()
    {
        $listaProd = $this->produtoModel->getAll();

        $this->load('produtos/main', [
            'listaProd' => $listaProd
        ]);
    }

    public function cadastrar()
    {
        $listaCat = $this->categoriaModel->getAll();

        $this->load('produtos/cadastro', [
            'listaCat' => $listaCat
        ]);
    }

    public function insert()
    {
        $produto = $this->getInput();

        if(!$this->validate($produto, false)){
           return $this->showMessage('Os dados preenchidos são inválidos.', 422);
        }

        $result = $this->produtoModel->insert($produto);

        if (!$result == true)
            return $this->showMessage('Erro ao cadastrar produto!', 422);


        return $this->showMessage('Produto cadastrado com sucesso!', 200);  
    }

    public function editar()
    {
        $idProduto = Input::get('id');

        $listaCat = $this->categoriaModel->getAll();

        $dadosProduto = $this->produtoModel->getById($idProduto);

        $this->load('produtos/editar', [
            'listaCat' => $listaCat,
            'dadosProduto' => $dadosProduto
        ]);
    }

    public function update()
    {
        $produto = $this->getInput();

        if(!$this->validate($produto)){
           return $this->showMessage('Os dados preenchidos são inválidos!', 422);
        }

        $result = $this->produtoModel->update($produto);
        
        if (!$result == true)
            return $this->showMessage('Erro ao atualizar produto!', 422);

            
        return $this->showMessage('Produto atualizado com sucesso!', 200);
    }

    public function delete()
    {
        $idProduto = Input::post('id');

        $result = $this->produtoModel->delete($idProduto);

        if (!$result == true)
            return $this->showMessage('Erro ao deletar produto', 422);


        return $this->showMessage('Produto deletado com sucesso!', 200);
    }  

    private function getInput()
    {
        return (object)[
            'id' => Input::post('id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => Input::post('nomeProduto'),
            'descricao' => Input::post('descProduto'),
            'quantidade' => Input::post('qtdProduto'),
            'categoria' => Input::post('catProduto'),
            'preco' => Input::post('precoProduto')
        ];
    }

    private function validate(Object $produto, bool $validateId = true)
    {
        if($produto->id <= 0 && $validateId)
            return false;

        if(strlen($produto->nome) < 5)
            return false;
        
        if(strlen($produto->descricao) < 5)
            return false;
            
        return true;
    }
}