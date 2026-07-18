# ByteShop — Site da Loja

Site completo em HTML/CSS/JS puro (sem frameworks, sem build step).

## Estrutura

```
byteshop-site/
├── index.html      → estrutura da página
├── css/
│   └── style.css   → todo o estilo visual (tema escuro/neon)
└── js/
    └── script.js    → catálogo de produtos, carrinho, filtros e formulários
```

## Como abrir

Só dar duplo clique no `index.html` — abre direto no navegador, não precisa de servidor nem instalação.

Se preferir rodar com um servidor local (recomendado para evitar bloqueios de CORS em alguns navegadores):

```bash
cd byteshop-site
python3 -m http.server 8000
```

Depois acesse `http://localhost:8000` no navegador.

## O que já funciona

- Catálogo com 14 produtos e filtro por categoria
- Carrinho de compras (adicionar, ajustar quantidade, remover, subtotal em tempo real)
- Formulário de newsletter e de contato (feedback visual na tela)
- Totalmente responsivo (mobile, tablet, desktop)

## O que é só demonstração

- **Carrinho e formulários não têm backend.** Os dados ficam na memória do navegador (variável JS) e são perdidos ao recarregar a página. Para produção, é preciso:
  - Conectar o checkout a um gateway de pagamento (Stripe, Mercado Pago, PagSeguro etc.)
  - Salvar pedidos e cadastros de newsletter em um banco de dados ou serviço (ex: Firebase, Supabase, planilha via API)
  - Trocar os formulários de "Enviar mensagem" por um serviço de e-mail real (ex: Formspree, EmailJS, ou backend próprio)
- **Produtos e preços são fictícios**, criados como ponto de partida — edite `js/script.js` (array `products`) para colocar o catálogo real.

## Onde editar o quê

| Quero mudar...              | Arquivo             |
|------------------------------|---------------------|
| Textos, títulos, seções      | `index.html`        |
| Cores, fontes, espaçamentos  | `css/style.css`     |
| Produtos, preços, categorias | `js/script.js` (array `products` no topo) |
| Lógica do carrinho           | `js/script.js`      |
