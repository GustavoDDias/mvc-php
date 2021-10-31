{% extends 'partials/body.twig.php' %}

{% block title %}Produtos - LOJA PHP{% endblock %}

{% block body %}
<div class="container">
    <h1>Produtos</h1>
</div>

<div class="container">
    <a href="{{BASE}}cadastro-produto">
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-info" id="btn-cadastrar" type="button">Cadastrar produto</button>
        </div>
    </a>
    <div class="container">
    </div>
    <hr>
    {% if listaProd == null %}
        <div style="padding: 2rem 0;">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
            </svg>
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                <div>
                    Sem produtos cadastrados.
                </div>
            </div>
        </div>
    {% else %}
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                {% for produto in listaProd %}
                <tr>
                    <th scope="row">{{ produto.id|e }}</th>
                    <td>{{ produto.nome|e }}</td>
                    <td>{{ produto.descricao|e }}</td>
                    <td>{{ produto.quantidade|e }}</td>
                    <td>R$ {{ produto.preco|number_format(2, ',', '.') }}</td>
                    <td>{{ produto.categoria|e }}</td>
                    <td>
                        <div class="actions-btn" style="display: flex; justify-content: center;">
                            <a href="{{BASE}}editar-produto?id={{ produto.id|e }}">
                                <button type="button" class="btn btn-primary btn-sm">Editar</button>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmaExclusaoModal('{{ produto.id|e }}')">Excluir</button>
                        </div>
                    </td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
    {% endif %}
    <div class="container">
    </div>
</div>

<!-- Modal Response -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h5 class="modal-title" id="modal-title" style="color: #fff;"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" id="modal-body">
      </div>
    </div>
  </div>
</div>

<!-- Modal Confirm -->
<div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="modal-header-confirm">
        <h5 class="modal-title" id="modal-title-confirm" style="color: #fff;"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" id="modal-body-confirm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="btn-confirm">Excluir</button>
        <button type="button" class="btn btn-danger" id="btn-confirm-cancel" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
    // modal response
    var modal = new bootstrap.Modal(document.getElementById('myModal'), focus);
    var myModal = document.getElementById('myModal');
    var modal_body = document.getElementById('modal-body');
    var modal_header = document.getElementById('modal-header');
    var modal_title = document.getElementById('modal-title');

    myModal.addEventListener('hidden.bs.modal', function (event) {
        document.location.reload(true);
    });

    // modal confirm
    var modalConfirm = new bootstrap.Modal(document.getElementById('modalConfirm'), focus);
    var myModalConfirm = document.getElementById('modalConfirm');
    var modal_body_confirm = document.getElementById('modal-body-confirm');
    var modal_header_confirm = document.getElementById('modal-header-confirm');
    var modal_title_confirm = document.getElementById('modal-title-confirm');

    // myModalConfirm.addEventListener('hidden.bs.modal', function (event) {
    //     document.location.reload(true);
    // });
</script>

<script>
    function confirmaExclusaoModal(idProduto){ 
    
        idProd = null;
        idProd = idProduto;

        modal_header_confirm.style.backgroundColor = "#dc3545";
        modal_title_confirm.innerHTML = "Atenção!";
        modal_body_confirm.innerHTML = "Deseja realmente excluir este produto?";
        modalConfirm.show();

    }

    document.getElementById("btn-confirm").addEventListener("click", event => { 
        modalConfirm.hide();
        excluirProduto(idProd);
    });

    document.getElementById("btn-confirm-cancel").addEventListener("click", event => { 
        modalConfirm.hide();
    });

    function excluirProduto(idProd){

        // Ajax
        var http = new XMLHttpRequest();
        var url = '{{BASE}}delete-produto/';
        var params = 'id='+idProd;

        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState == 4 && http.status == 200) {

                modal_header.style.backgroundColor = "#28a745";
                modal_title.innerHTML = "Sucesso!";
                modal_body.innerHTML = http.responseText;
                modal.show();

            } else if(http.readyState == 4 && http.status == 422) {

                modal_header.style.backgroundColor = "#dc3545";
                modal_title.innerHTML = "Erro!";
                modal_body.innerHTML = http.responseText;
                modal.show();
            }
        }
        http.send(params);    

    }
</script>
{% endblock %}