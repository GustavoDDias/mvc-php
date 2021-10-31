{% extends 'partials/body.twig.php' %}

{% block title %}Home - LOJA PHP{% endblock %}

{% block body %}

<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="{{BASE}}img/carousel/banner1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{BASE}}img/carousel/banner2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="5000">
            <img src="{{BASE}}img/carousel/banner3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="container" style="margin-top: 3.5rem;">
    <h4>Veja as últimas novidades selecionadas para você!</h4>
    <hr>
</div>

<div class="container" style="margin-bottom: 3rem;">
    <div class="row align-items-start">
        <div class="col-sm">
            <div class="card">
                <img src="{{BASE}}img/cards/img1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Cozinha Completa Compacta Xangai Plus Multimóveis Branco/Fumê</h5>
                    <p class="card-text">de R$ 999,99 por R$719,91à vista ou R$ 799,90 em 12x de R$ 66,66 sem juros.</p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <img src="{{BASE}}img/cards/img2.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Smartphone Motorola Moto G30 128GB White Lilac 4G - 4GB RAM Tela 6,5”</h5>
                    <p class="card-text">de R$ 1.899,00 por R$1.232,10à vista ou R$ 1.369,00 em 10x de R$ 136,90 sem juros</p>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card">
                <img src="{{BASE}}img/cards/img3.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Tênis Adidas Advantage Base Feminino numeros 32 a 45</h5>
                    <p class="card-text">de R$ 229,99 por R$129,99 em 4x de R$ 32,50 sem juros</p>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}