<?php
// A página consulta os serviços cadastrados antes de construir o HTML.
require_once __DIR__ . '/config/database.php';
try {
    $servicos = $pdo->query('SELECT id, nome, descricao, imagem, imagem_alt, pagina, preco FROM servicos ORDER BY id')->fetchAll();
} catch (PDOException $erro) {
    http_response_code(500);
    exit('Não foi possível listar serviços. Crie a tabela servicos seguindo banco/INSTRUCOES.md.');
}
function e($valor): string {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Effeito Pinturas Veiculares | Pintura Automotiva em Chapecó</title>
<meta name="description" content="Effeito Pinturas Veiculares - pintura completa, pintura de peças e retoques automotivos em Chapecó/SC.">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- MENU PRINCIPAL -->
<nav class="navbar navbar-expand-lg navbar-effeito sticky-top py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#inicio">
      <img src="img/logo/logo.jpeg" alt="Logomarca Effeito Pinturas Veiculares">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="#inicio">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="#empresa">Empresa</a></li>
        <li class="nav-item"><a class="nav-link" href="#depoimentos">Depoimentos</a></li>
        <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
        <li class="nav-item ms-lg-2">
          <a class="btn btn-amarelo btn-sm" href="https://wa.me/5549936187351" target="_blank" rel="noopener">
            <i class="bi bi-whatsapp"></i> Fale conosco
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CARROSSEL / DESTAQUES -->
<header id="inicio" class="position-relative">
  <div id="carrosselDestaques" class="carousel slide hero-carousel" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carrosselDestaques" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#carrosselDestaques" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#carrosselDestaques" data-bs-slide-to="2"></button>
      <button type="button" data-bs-target="#carrosselDestaques" data-bs-slide-to="3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <video autoplay muted loop playsinline class="banner-video">
            <source src="vid/pintura_vermelha.mp4" type="video/mp4">
        </video>
        <div class="carousel-caption">
          <span class="slogan">Nova pintura. Novo efeito.</span>
          <h1>Pintura automotiva com acabamento de qualidade</h1>
          <p class="d-none d-md-block">Preparação, correção de imperfeições e aplicação de tinta com profissionais experientes.</p>
          <a href="#servicos" class="btn btn-amarelo mt-2">Ver serviços</a>
        </div>
      </div>
      <div class="carousel-item" style="background-image:url('img/carros/opala_pintado.jpeg');">
        <div class="carousel-caption">
          <span class="slogan">Promoção do mês</span>
          <h1>10% de desconto em pintura completa</h1>
          <p class="d-none d-md-block">Renove a aparência do seu veículo com uma pintura uniforme e duradoura.</p>
          <a href="servico1.html" class="btn btn-amarelo mt-2">Solicitar orçamento</a>
        </div>
      </div>
      <div class="carousel-item">
        <video autoplay muted loop playsinline class="banner-video">
            <source src="vid/pintura_cinza.mp4" type="video/mp4">
        </video>
        <div class="carousel-caption">
          <span class="slogan">Reparos rápidos</span>
          <h1>Pintura de peças danificadas</h1>
          <p class="d-none d-md-block">Portas, capô, para-lamas e para-choques com acabamento igual ao original.</p>
          <a href="servico2.html" class="btn btn-amarelo mt-2">Solicitar orçamento</a>
        </div>
      </div>
      <div class="carousel-item" style="background-image:url('img/pinturas/close-up.jpeg');">
        <div class="carousel-caption">
          <span class="slogan">Correção de detalhes</span>
          <h1>Retoque de pintura sem sair da cor original</h1>
          <p class="d-none d-md-block">Riscos e pequenas áreas descascadas corrigidos com precisão.</p>
          <a href="servico3.html" class="btn btn-amarelo mt-2">Solicitar orçamento</a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carrosselDestaques" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carrosselDestaques" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</header>

<!-- CATÁLOGO DE SERVIÇOS -->
<section id="servicos" class="py-5">
  <div class="container">
    <h2 class="titulo-secao text-center mx-auto" style="width:fit-content;">Nossos Serviços</h2>
    <p class="text-center text-muted mb-5 mx-auto" style="max-width:640px;">
      Da pintura completa ao retoque pontual, cuidamos de cada etapa com atenção aos detalhes.
    </p>
    <div class="row g-4" id="listaServicos" aria-live="polite">
      <?php foreach ($servicos as $servico): ?>
        <div class="col-md-4">
          <div class="card card-servico">
            <img class="card-img-top" src="<?= e($servico['imagem']) ?>" alt="<?= e($servico['imagem_alt']) ?>">
            <div class="card-body d-flex flex-column">
              <h3 class="h5"><?= e($servico['nome']) ?></h3>
              <p class="text-muted small"><?= e($servico['descricao']) ?></p>
              <p class="preco mb-3">A partir de R$ <?= number_format((float)$servico['preco'], 2, ',', '.') ?></p>
              <a class="btn btn-outline-amarelo mt-auto" href="<?= e($servico['pagina']) ?>">Solicitar Orçamento</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if (!$servicos): ?><p>Nenhum serviço cadastrado.</p><?php endif; ?>
    </div>
    <button type="button" class="btn btn-outline-amarelo mt-3" id="atualizarServicos">Atualizar serviços</button>
  </div>
</section>

<!-- EMPRESA -->
<section id="empresa" class="py-5 bg-cinza-medio text-light">
  <div class="container">
    <h2 class="titulo-secao">Effeito Pinturas Veiculares</h2>
    <div class="row g-5 align-items-start">
      <div class="col-lg-6">
        <p>
          A Effeito Pinturas Veiculares foi fundada por Márcio a partir de sua experiência com pintura e reparação
          de veículos. O trabalho começou com pequenos serviços de pintura e recuperação de partes danificadas de
          automóveis, buscando sempre entregar um acabamento de qualidade e atender às necessidades de cada cliente.
        </p>
        <p>
          Com o passar do tempo, a empresa ganhou experiência e passou a realizar serviços completos de pintura
          automotiva, incluindo preparação, correção de imperfeições e aplicação de tinta. Atualmente, a Effeito
          busca oferecer um serviço profissional, utilizando técnicas e materiais adequados para proporcionar um
          acabamento uniforme e duradouro aos veículos.
        </p>

        <div class="row mt-4">
          <div class="col-sm-6 mb-3">
            <h4 class="h6 text-amarelo">Missão</h4>
            <p class="small mb-0">Oferecer serviços de pintura automotiva com qualidade, precisão e profissionalismo.</p>
          </div>
          <div class="col-sm-6 mb-3">
            <h4 class="h6 text-amarelo">Visão</h4>
            <p class="small mb-0">Ser reconhecida como referência em pintura automotiva na região de Chapecó.</p>
          </div>
        </div>

        <address class="mt-4 mb-0">
          <i class="bi bi-geo-alt text-amarelo"></i>
          Rua Rio Grande do Norte, 299 — Bairro Santo Antônio — Chapecó/SC, 89815-500
        </address>

        <!-- Equipe -->
        <div class="mt-4">
          <h4 class="h6 text-amarelo mb-3">Nossa Equipe</h4>
          <div class="d-flex flex-wrap gap-4">
            <div class="text-center equipe-avatar">
              <img src="img/equipe/Marcio_chefe.jpeg" alt="Márcio Ferreira, proprietário e pintor automotivo">
              <div class="small mt-2">Márcio Ferreira<br><span class="text" style="color: gray;">Proprietário / Pintor</span></div>
            </div>
            <div class="text-center equipe-avatar">
              <img src="img/equipe/lucas.jpeg" alt="Lucas Mendes, preparador automotivo">
              <div class="small mt-2">Lucas Mendes<br><span class="text" style="color: gray;">Preparador</span></div>
            </div>
            <div class="text-center equipe-avatar">
              <img src="img/equipe/rafael.jpeg" alt="Rafael Martins, pintor automotivo">
              <div class="small mt-2">Rafael Martins<br><span class="text" style="color: gray;">Pintor</span></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="empresa-map">
          <iframe
            src="https://maps.google.com/maps?q=Rua%20Rio%20Grande%20do%20Norte%2C%20299%2C%20Santo%20Ant%C3%B4nio%2C%20Chapec%C3%B3%20-%20SC&t=&z=15&ie=UTF8&output=embed"
            title="Localização da Effeito Pinturas Veiculares no Google Maps"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DEPOIMENTOS -->
<section id="depoimentos" class="py-5">
  <div class="container">
    <h2 class="titulo-secao text-center mx-auto" style="width:fit-content;">O que nossos clientes dizem</h2>
    <div class="row g-4 mt-2">

      <div class="col-md-6 col-lg-4">
        <div class="card card-depoimento p-4">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-circle me-3"></i>
            <div>
              <h5 class="mb-0 h6">Carlos Henrique</h5>
              <small class="text-muted">15/08/2026</small>
            </div>
          </div>
          <div class="estrelas mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="small mb-0">"Levei meu carro para fazer uma pintura completa e fiquei muito satisfeito com o resultado. A pintura ficou uniforme e com excelente acabamento."</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-depoimento p-4">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-circle me-3"></i>
            <div>
              <h5 class="mb-0 h6">Mariana Alves</h5>
              <small class="text-muted">21/08/2026</small>
            </div>
          </div>
          <div class="estrelas mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="small mb-0">"Precisava pintar uma porta que estava bastante danificada. O serviço ficou muito bem feito e a nova pintura ficou praticamente igual à original."</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-depoimento p-4">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-circle me-3"></i>
            <div>
              <h5 class="mb-0 h6">Rafael Martins</h5>
              <small class="text-muted">27/08/2026</small>
            </div>
          </div>
          <div class="estrelas mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="small mb-0">"Fiz alguns retoques na pintura do meu carro e o resultado ficou excelente. O atendimento também foi muito bom."</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-depoimento p-4">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-circle me-3"></i>
            <div>
              <h5 class="mb-0 h6">Juliana Souza</h5>
              <small class="text-muted">02/09/2026</small>
            </div>
          </div>
          <div class="estrelas mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="small mb-0">"Meu para-choque estava bem riscado depois de uma batida leve. Ficou irreconhecível, parece que saiu de fábrica."</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card card-depoimento p-4">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-person-circle me-3"></i>
            <div>
              <h5 class="mb-0 h6">Eduardo Lima</h5>
              <small class="text-muted">05/09/2026</small>
            </div>
          </div>
          <div class="estrelas mb-2"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="small mb-0">"Atendimento rápido e transparente sobre prazo e valores. Recomendo a Effeito para quem quer um serviço bem-feito."</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CONTATO -->
<section id="contato" class="py-5 bg-cinza-medio">
  <div class="container">
    <h2 class="titulo-secao text-light">Fale Conosco</h2>
    <div class="row g-4">
      <div class="col-lg-7">
        <form id="formContato" class="bg-white p-4 rounded shadow-sm">
          <div class="mb-3">
            <label for="contatoNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="contatoNome" name="nome" maxlength="150" required>
          </div>
          <div class="mb-3">
            <label for="contatoEmail" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="contatoEmail" name="email" maxlength="200" required>
          </div>
          <div class="mb-3">
            <label for="contatoMensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" id="contatoMensagem" name="mensagem" maxlength="3000" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-amarelo">Enviar</button>
          <div id="contatoConfirmacao" class="alert alert-success mt-3 d-none" role="alert">
            Mensagem enviada! Em breve entraremos em contato.
          </div>
        </form>
      </div>

      <div class="col-lg-5">
        <div class="contato-info-card p-4 h-100">
          <h3 class="h5 text-amarelo mb-3">Effeito Pinturas Veiculares</h3>
          <p><i class="bi bi-envelope me-2"></i><a href="mailto:contato@effeitopinturas.com.br">contato@effeitopinturas.com.br</a></p>
          <p><i class="bi bi-telephone me-2"></i><a href="tel:+554936187351">(49) 3618-7351</a></p>
          <p><i class="bi bi-whatsapp me-2"></i><a href="https://wa.me/5549936187351" target="_blank" rel="noopener">(49) 93618-7351</a></p>
          <p><i class="bi bi-geo-alt me-2"></i>Rua Rio Grande do Norte, 299 — Santo Antônio — Chapecó/SC</p>
          <hr class="border-secondary">
          <p class="mb-2">Redes sociais:</p>
          <div class="d-flex gap-3 fs-4">
            <a href="https://instagram.com/effeitopinturas" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://facebook.com/effeitopinturas" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me/5549936187351" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 text-center text-md-start">
    <span class="small">&copy; 2026 Effeito Pinturas Veiculares — Todos os direitos reservados.</span>
    <span class="small">Desenvolvido por <strong class="text-amarelo">Victor Luís Rubert Andriolli</strong></span>
  </div>
</footer>

<!-- BOTÃO WHATSAPP FLUTUANTE -->
<a href="https://wa.me/5549936187351" target="_blank" rel="noopener" class="whatsapp-flutuante" aria-label="Fale conosco pelo WhatsApp">
  <i class="bi bi-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
