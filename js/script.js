// ---------- ICONS (inline SVG line-art, category-based) ----------
const icons = {
  notebook: `<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="4" width="18" height="12" rx="1.5"/><path d="M1 19h22l-2-3H3z"/></svg>`,
  perifericos: `<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="2" width="16" height="20" rx="4"/><path d="M12 2v6"/></svg>`,
  componentes: `<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="6" y="6" width="12" height="12" rx="1.5"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/></svg>`,
  audio: `<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 14a9 9 0 0 1 18 0"/><rect x="1" y="14" width="6" height="7" rx="2"/><rect x="17" y="14" width="6" height="7" rx="2"/></svg>`,
  monitor: `<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="4" width="20" height="13" rx="1.5"/><path d="M8 21h8M12 17v4"/></svg>`
};

// ---------- PRODUCT DATA ----------
const products = [
  { id:'p1', sku:'BS-NB-1042', name:'Notebook Vertix 14" R5 16GB', cat:'notebook', catLabel:'Notebooks', price:3899, badge:null },
  { id:'p2', sku:'BS-NB-1055', name:'Notebook Aurex Slim i5 8GB', cat:'notebook', catLabel:'Notebooks', price:3249, badge:'-12%' },
  { id:'p3', sku:'BS-PF-2210', name:'Mouse Vortex Óptico 16000dpi', cat:'perifericos', catLabel:'Periféricos', price:189, badge:null },
  { id:'p4', sku:'BS-PF-2231', name:'Teclado Mecânico Nimbus TKL', cat:'perifericos', catLabel:'Periféricos', price:349, badge:null },
  { id:'p5', sku:'BS-PF-2244', name:'Webcam Clarix 1440p', cat:'perifericos', catLabel:'Periféricos', price:279, badge:'Novo' },
  { id:'p6', sku:'BS-CP-3081', name:'SSD NVMe Flux 1TB Gen4', cat:'componentes', catLabel:'Componentes', price:459, badge:null },
  { id:'p7', sku:'BS-CP-3097', name:'Memória RAM Kroma 16GB DDR5', cat:'componentes', catLabel:'Componentes', price:399, badge:null },
  { id:'p8', sku:'BS-CP-3102', name:'Fonte Voltis 650W 80+ Bronze', cat:'componentes', catLabel:'Componentes', price:389, badge:null },
  { id:'p9', sku:'BS-CP-3119', name:'Placa de Vídeo Halox RTX 4060', cat:'componentes', catLabel:'Componentes', price:2599, badge:null },
  { id:'p10', sku:'BS-AU-4015', name:'Headset Sonar Pro 7.1', cat:'audio', catLabel:'Áudio', price:329, badge:null },
  { id:'p11', sku:'BS-AU-4028', name:'Caixa de Som Modulis Bluetooth', cat:'audio', catLabel:'Áudio', price:219, badge:'-8%' },
  { id:'p12', sku:'BS-MO-5077', name:'Monitor Prisma 27" 165Hz QHD', cat:'monitor', catLabel:'Monitores', price:1799, badge:null },
  { id:'p13', sku:'BS-MO-5091', name:'Monitor Deskline 24" 100Hz FHD', cat:'monitor', catLabel:'Monitores', price:899, badge:null },
  { id:'p14', sku:'BS-PF-2260', name:'Headset Gamer Ignis RGB', cat:'perifericos', catLabel:'Periféricos', price:259, badge:null },
];

const categories = [
  { key:'all', label:'Todos' },
  { key:'notebook', label:'Notebooks' },
  { key:'perifericos', label:'Periféricos' },
  { key:'componentes', label:'Componentes' },
  { key:'audio', label:'Áudio' },
  { key:'monitor', label:'Monitores' },
];

let activeFilter = 'all';
let cart = {}; // { productId: qty }

const fmt = (v) => v.toLocaleString('pt-BR', { style:'currency', currency:'BRL' });

// ---------- RENDER FILTERS ----------
function renderFilters(){
  const el = document.getElementById('filters');
  el.innerHTML = categories.map(c =>
    `<button class="filter-pill ${c.key===activeFilter?'active':''}" data-cat="${c.key}">${c.label}</button>`
  ).join('');
  el.querySelectorAll('.filter-pill').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      activeFilter = btn.dataset.cat;
      renderFilters();
      renderGrid();
    });
  });
}

// ---------- RENDER GRID ----------
function renderGrid(){
  const el = document.getElementById('productGrid');
  const list = activeFilter==='all' ? products : products.filter(p=>p.cat===activeFilter);
  el.innerHTML = list.map(p => `
    <div class="card">
      ${p.badge ? `<span class="badge">${p.badge}</span>` : ''}
      <div class="card-icon">${icons[p.cat]}</div>
      <p class="card-sku mono">${p.sku}</p>
      <h3>${p.name}</h3>
      <p class="card-cat">${p.catLabel}</p>
      <div class="card-footer">
        <div class="card-price mono">${fmt(p.price)}<small>à vista</small></div>
        <button class="add-btn" data-id="${p.id}" aria-label="Adicionar ${p.name} ao carrinho">+</button>
      </div>
    </div>
  `).join('');
  el.querySelectorAll('.add-btn').forEach(btn=>{
    btn.addEventListener('click', ()=> addToCart(btn.dataset.id));
  });
}

document.getElementById('stockCount').textContent = products.length;

// ---------- CART LOGIC ----------
function addToCart(id){
  cart[id] = (cart[id] || 0) + 1;
  updateCartUI();
  showToast('Adicionado ao carrinho');
}
function changeQty(id, delta){
  if(!cart[id]) return;
  cart[id] += delta;
  if(cart[id] <= 0) delete cart[id];
  updateCartUI();
}
function removeItem(id){
  delete cart[id];
  updateCartUI();
}
function updateCartUI(){
  const count = Object.values(cart).reduce((a,b)=>a+b, 0);
  document.getElementById('cartCount').textContent = count;

  const itemsEl = document.getElementById('drawerItems');
  const ids = Object.keys(cart);
  if(ids.length === 0){
    itemsEl.innerHTML = `<p class="drawer-empty">Seu carrinho está vazio.<br>Adicione peças do catálogo.</p>`;
  } else {
    itemsEl.innerHTML = ids.map(id=>{
      const p = products.find(pr=>pr.id===id);
      const qty = cart[id];
      return `
        <div class="drawer-item">
          <div class="di-icon">${icons[p.cat]}</div>
          <div class="di-info">
            <h4>${p.name}</h4>
            <div class="qty-ctrl">
              <button data-id="${id}" data-delta="-1">−</button>
              <span>${qty}</span>
              <button data-id="${id}" data-delta="1">+</button>
            </div>
            <button class="di-remove" data-remove="${id}">Remover</button>
          </div>
          <div class="di-price mono">${fmt(p.price*qty)}</div>
        </div>
      `;
    }).join('');
    itemsEl.querySelectorAll('[data-delta]').forEach(btn=>{
      btn.addEventListener('click', ()=> changeQty(btn.dataset.id, parseInt(btn.dataset.delta)));
    });
    itemsEl.querySelectorAll('[data-remove]').forEach(btn=>{
      btn.addEventListener('click', ()=> removeItem(btn.dataset.remove));
    });
  }

  const total = ids.reduce((sum,id)=> sum + products.find(p=>p.id===id).price * cart[id], 0);
  document.getElementById('drawerTotal').textContent = fmt(total);
  document.getElementById('checkoutBtn').disabled = ids.length === 0;
}

// ---------- DRAWER TOGGLE ----------
const drawer = document.getElementById('drawer');
const overlay = document.getElementById('overlay');
function openDrawer(){ drawer.classList.add('open'); overlay.classList.add('open'); }
function closeDrawerFn(){ drawer.classList.remove('open'); overlay.classList.remove('open'); }
document.getElementById('cartToggle').addEventListener('click', openDrawer);
document.getElementById('closeDrawer').addEventListener('click', closeDrawerFn);
overlay.addEventListener('click', closeDrawerFn);

document.getElementById('checkoutBtn').addEventListener('click', ()=>{
  showToast('Pedido simulado — sem integração de pagamento nesta demo');
});

// ---------- TOAST ----------
let toastTimer;
function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(()=> t.classList.remove('show'), 2600);
}

// ---------- FORMS (demo only, no backend) ----------
document.getElementById('newsletterForm').addEventListener('submit', (e)=>{
  e.preventDefault();
  document.getElementById('nlMsg').textContent = 'Inscrito! Você vai receber os próximos drops.';
  e.target.reset();
});
document.getElementById('contactForm').addEventListener('submit', (e)=>{
  e.preventDefault();
  document.getElementById('cMsgFeedback').textContent = 'Mensagem enviada! Respondemos em até 1 dia útil.';
  e.target.reset();
});

// ---------- INIT ----------
renderFilters();
renderGrid();
updateCartUI();
