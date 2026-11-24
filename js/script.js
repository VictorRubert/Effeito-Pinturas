// Envia os campos do formulário para o PHP usando fetch e FormData.
function configurarFormulario(formulario, endpoint, aviso) {
    if (!formulario) return;
    formulario.addEventListener('submit', async (evento) => {
        evento.preventDefault();
        if (!formulario.reportValidity()) return;
        const botao = formulario.querySelector('button[type="submit"]');
        botao.disabled = true;
        aviso.classList.add('d-none');
        try {
            const resposta = await fetch(endpoint, {
                method: 'POST', body: new FormData(formulario)
            });
            const dados = await resposta.json();
            if (!resposta.ok || !dados.sucesso) throw new Error(dados.mensagem);
            aviso.textContent = dados.mensagem;
            aviso.classList.remove('alert-danger', 'd-none');
            aviso.classList.add('alert-success');
            formulario.reset();
        } catch (erro) {
            aviso.textContent = erro.message || 'Não foi possível enviar.';
            aviso.classList.remove('alert-success', 'd-none');
            aviso.classList.add('alert-danger');
        } finally { botao.disabled = false; }
    });
}
configurarFormulario(document.getElementById('formContato'), 'backend/contato.php', document.getElementById('contatoConfirmacao'));
for (let i = 1; i <= 3; i++) {
    configurarFormulario(document.getElementById('formOrcamento' + i), 'backend/orcamento.php', document.getElementById('confirmacaoOrcamento' + i));
}
// Cria elementos sem interpretar os textos do banco como HTML.
function elemento(tag, classe, texto) {
    const item = document.createElement(tag);
    item.className = classe;
    if (texto !== undefined) item.textContent = texto;
    return item;
}
async function listarServicos() {
    const lista = document.getElementById('listaServicos');
    if (!lista) return;
    try {
        const resposta = await fetch('backend/servicos.php');
        const dados = await resposta.json();
        if (!resposta.ok || !dados.sucesso) throw new Error(dados.mensagem);
        lista.replaceChildren();
        if (!dados.servicos.length) lista.textContent = 'Nenhum serviço cadastrado.';
        for (const servico of dados.servicos) {
            const coluna = elemento('div', 'col-md-4');
            const card = elemento('div', 'card card-servico');
            const imagem = elemento('img', 'card-img-top');
            imagem.src = /^img\/[\w./-]+$/.test(servico.imagem) ? servico.imagem : 'img/logo/logo.jpeg';
            imagem.alt = servico.imagem_alt;
            const corpo = elemento('div', 'card-body d-flex flex-column');
            const preco = Number(servico.preco).toLocaleString('pt-BR', {style:'currency', currency:'BRL'});
            const link = elemento('a', 'btn btn-outline-amarelo mt-auto', 'Solicitar Orçamento');
            link.href = /^servico[123]\.html$/.test(servico.pagina) ? servico.pagina : '#contato';
            corpo.append(elemento('h3','h5',servico.nome), elemento('p','text-muted small',servico.descricao), elemento('p','preco mb-3','A partir de ' + preco), link);
            card.append(imagem, corpo);
            coluna.append(card);
            lista.append(coluna);
        }
    } catch (erro) {
        lista.replaceChildren(elemento('p','alert alert-danger','Não foi possível carregar os serviços. ' + erro.message));
    }
}
// A listagem inicial é feita pelo PHP, como no projeto BEvolution.
// O botão permite atualizar os serviços usando JavaScript + fetch, sem recarregar a página.
const atualizarServicos = document.getElementById('atualizarServicos');
if (atualizarServicos) atualizarServicos.addEventListener('click', listarServicos);
