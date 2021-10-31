{% extends 'partials/body.twig.php' %}

{% block title %}Atualizar Produto - LOJA PHP{% endblock %}

{% block body %}
<div class="container">
    <h1>Editar Produto</h1>
</div>

{% for produto in dadosProduto %}
<div class="container">
    <form class="row g-3" id="form-editar-produto">
        <!-- <label>Id</label> -->
        <input type="hidden" name="id" id="idProduto" value="{{ produto.id|e }}">
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Nome (mínimo 5 caracteres)</label>
            <input type="text" class="form-control" id="nomeProduto" maxlength="60" value="{{ produto.nome|e }}" required>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Descrição (mínimo 5 caracteres)</label>
            <input type="text" class="form-control" id="descProduto" maxlength="60" value="{{ produto.descricao|e }}" required>
        </div>
        <div class="col-md-4">
            <label for="inputCity" class="form-label">Quantidade</label>
            <input type="number" min="0" step="1" class="form-control" id="qtdProduto" value="{{ produto.quantidade|e }}" required>
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Categoria</label>
            <select id="catProduto" class="form-select" required>
                <option value="{{ produto.id_cat|e }}">{{ produto.categoria|e }}</option>
                {% for categoria in listaCat %}
                    <option value="{{ categoria.id|e }}">{{ categoria.nome|e }}</option>
                {% endfor %}
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputZip" class="form-label">Preço</label>
            <div class="input-group">
            <span class="input-group-text" id="basic-addon1">R$</span>
            <input type="text" step="0.01" class="form-control" id="precoProduto" value="{{ produto.preco|number_format(2, ',', '.') }}" onKeyPress="return(moeda(this,'.',',',event))" required>
            </div>
        </div>
        <div class="col-12">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{BASE}}produtos/">
                <button type="button" class="btn btn-danger">Cancelar</button>
            </a>
        </div>
    </form>
</div>
{% endfor %}  


<!-- Modal -->
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

<script>
    var modal = new bootstrap.Modal(document.getElementById('myModal'), focus);
    var myModal = document.getElementById('myModal');
    var modal_body = document.getElementById('modal-body');
    var modal_header = document.getElementById('modal-header');
    var modal_title = document.getElementById('modal-title');

    myModal.addEventListener('hidden.bs.modal', function (event) {
        document.location.reload(true);
    });
</script>

<script>
    document.getElementById("form-editar-produto").addEventListener("submit", event => {

    event.preventDefault();

    const form = document.getElementById("form-editar-produto");

    var idProduto = document.getElementById("idProduto").value;
    var nomeProduto = document.getElementById("nomeProduto").value;
    var descProduto = document.getElementById("descProduto").value;
    var qtdProduto = document.getElementById("qtdProduto").value;
    var catProduto = document.getElementById("catProduto").value;
    var precoProduto = document.getElementById("precoProduto").value;

    // Ajax
    var http = new XMLHttpRequest();
    var url = '{{BASE}}update-produto/';
    var params = 'id='+idProduto+'&nomeProduto='+nomeProduto+'&descProduto='+descProduto+'&qtdProduto='+qtdProduto+'&catProduto='+catProduto+'&precoProduto='+precoProduto;

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

    });
</script>

<!-- função para formatar o input de moeda -->
<script>

function moeda(a, e, r, t) {
    let n = ""
    , h = j = 0
    , u = tamanho2 = 0
    , l = ajd2 = ""
    , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}
</script>

{% endblock %}