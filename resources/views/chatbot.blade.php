
<!-- Meta CSRF (poner dentro del <head>) -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Chatbot Sofía -->
<div id="chatBot" class="fixed bottom-20 right-6 z-50 flex flex-col items-end">
  <button id="chatToggle" class="w-16 h-16 rounded-full shadow-lg flex items-center justify-center hover:scale-105 transition">
    <img src="{{ asset('imagenes/sofia.png') }}" alt="Sofía" class="w-full h-full rounded-full object-cover">
  </button>

  <div id="chatPanel" class="hidden w-80 md:w-96 bg-white rounded-2xl shadow-2xl mt-4 flex flex-col animate-fadeIn">
    <div class="bg-black p-3 flex justify-between items-center rounded-t-2xl">
      <h3 class="text-white font-bold">Sofía 💬</h3>
      <button id="closeChat" class="text-white font-bold">✕</button>
    </div>

    <div id="chatMessages" class="p-4 h-72 overflow-y-auto flex flex-col gap-3">
      <div class="bg-gray-200 text-black p-3 rounded-xl shadow self-start max-w-[75%]">
        ¡Hola! Soy Sofía, tu asistente de la Biblioteca Virtual. ¿En qué puedo ayudarte?
      </div>
    </div>

    <div id="opciones" class="p-4 flex gap-2 flex-wrap"></div>

    <form id="chatForm" class="flex border-t border-gray-300">
      <input type="text" id="chatInput" placeholder="Escribe tu mensaje..." class="flex-1 bg-gray-100 text-black p-3 rounded-bl-2xl focus:outline-none">
      <button type="submit" class="bg-black hover:bg-gray-800 p-3 text-white rounded-br-2xl">Enviar</button>
    </form>
  </div>
</div>

<style>
  @keyframes fadeIn { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
  .animate-fadeIn{ animation: fadeIn 0.25s ease-out; }
  .lib-card { display:flex; align-items:center; gap:8px; padding:8px; border-radius:12px; background:#f8fafc; border:1px solid #e5e7eb; }
  .lib-card img{ width:48px; height:64px; object-fit:cover; border-radius:6px; }
  a { text-decoration: none; }
</style>

<script>
window.onload = function() {
  const chatToggle = document.getElementById('chatToggle');
  const chatPanel = document.getElementById('chatPanel');
  const closeChat = document.getElementById('closeChat');
  const chatForm = document.getElementById('chatForm');
  const chatMessages = document.getElementById('chatMessages');
  const chatInput = document.getElementById('chatInput');
  const opcionesDiv = document.getElementById('opciones');

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  chatToggle.addEventListener('click', () => chatPanel.classList.toggle('hidden'));
  closeChat.addEventListener('click', () => chatPanel.classList.add('hidden'));

  function appendText(msg, isUser=false){
    const div = document.createElement('div');
    div.className = 'p-3 rounded-xl shadow max-w-[75%] break-words ' + (isUser ? 'bg-black text-white self-end':'bg-gray-200 text-black self-start');
    div.innerHTML = msg;
    chatMessages.appendChild(div);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function appendBooks(libros){
    if(!libros || libros.length===0){ appendText('No encontré libros.'); return; }
    const container = document.createElement('div');
    container.className = 'flex flex-col gap-2 self-start max-w-[95%]';

    libros.forEach(l=>{
      const card = document.createElement('div'); 
      card.className='lib-card';

      const img = document.createElement('img'); 
      img.src = l.imagen || '{{ asset("imagenes/default-book.png") }}';

      const info = document.createElement('div');
      let detalles = l.autor ? `<small>${l.autor} • ${l.cantidad ?? ''} disponibles</small>` : '';
      info.innerHTML = `<strong>${l.titulo}</strong><br>${detalles}`;

      const btn = document.createElement('a'); 
      btn.href = l.url ? l.url : `/libros/${l.id}`; 
      btn.textContent='Ver';
      btn.className='ml-auto px-3 py-1 bg-black text-white rounded hover:opacity-90 text-sm';
      btn.target = '_blank';

      card.appendChild(img); 
      card.appendChild(info); 
      card.appendChild(btn);

      container.appendChild(card);
    });

    chatMessages.appendChild(container);
    chatMessages.scrollTop = chatMessages.scrollHeight;
  }

  function mostrarOpciones(){
    opcionesDiv.innerHTML='';
    ['Ver categorías','Materiales'].forEach(op=>{
      const b = document.createElement('button'); 
      b.type='button'; 
      b.textContent = op;
      b.className='p-2 bg-black text-white rounded hover:bg-gray-800'; 
      opcionesDiv.appendChild(b);
    });
  }

  function responder(userMsg){
    opcionesDiv.innerHTML=''; 
    appendText('Sofía está escribiendo...');

    // ✅ Caso especial para Materiales
    if(userMsg.toLowerCase().includes('materiales')){
        const last = chatMessages.lastChild; 
        if(last && last.textContent==='Sofía está escribiendo...') last.remove();
        appendText('Puedes ver todos los materiales aquí: 📄 <a href="/materiales" target="_blank" class="text-blue-600 underline">Ir a Materiales</a>');
        mostrarOpciones();
        return;
    }

    // Llamada normal al backend para libros/categorías
    fetch("{{ route('chatbot') }}", {
      method:'POST',
      headers:{
        'Content-Type':'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ mensaje: userMsg })
    })
    .then(r => r.json())
    .then(data => {
      const last = chatMessages.lastChild; 
      if(last && last.textContent==='Sofía está escribiendo...') last.remove();

      if(data.type==='list' && data.libros){ 
        appendText(data.respuesta); 
        appendBooks(data.libros); 
      } else appendText(data.respuesta || 'No hay respuesta.');

      mostrarOpciones();
    })
    .catch(err => {
      console.error(err);
      const last = chatMessages.lastChild; 
      if(last && last.textContent==='Sofía está escribiendo...') last.remove();
      appendText('Error al conectar con el servidor.');
      mostrarOpciones();
    });
  }

  opcionesDiv.addEventListener('click',(e)=>{
    if(e.target.tagName==='BUTTON'){
      const t = e.target.textContent; 
      appendText(t,true);
      responder(t.toLowerCase().includes('buscar') ? 'buscar' : t);
    }
  });

  chatForm.addEventListener('submit',(e)=>{
    e.preventDefault(); 
    const val = chatInput.value.trim();
    if(!val) return; 
    appendText(val,true); 
    chatInput.value=''; 
    responder(val);
  });

  mostrarOpciones();
};
</script>
