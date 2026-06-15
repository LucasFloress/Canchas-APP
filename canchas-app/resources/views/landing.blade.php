<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Canchas Javi — Villa Tesei</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:  #22c55e;
            --green2: #16a34a;
            --dark:   #0a0a0a;
            --card:   #111111;
            --border: #1f1f1f;
        }
        * { box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: var(--dark); color: #e5e5e5; }
        h1, h2, .bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.04em; }

        /* ── Campo de fútbol SVG background ── */
        .hero-bg {
            background-color: #060f06;
            background-image:
                /* líneas del campo */
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(34,197,94,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Animaciones ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.6s ease both; }
        .fade-up-1 { animation-delay: 0.1s; }
        .fade-up-2 { animation-delay: 0.25s; }
        .fade-up-3 { animation-delay: 0.4s; }

        /* ── Botón principal ── */
        .btn-green {
            background: var(--green);
            color: #000;
            font-weight: 500;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-green:hover { background: var(--green2); transform: translateY(-1px); }
        .btn-green:active { transform: translateY(0); }

        /* ── Tarjeta cancha ── */
        .cancha-card {
            background: var(--card);
            border: 1px solid var(--border);
            transition: border-color 0.2s, transform 0.2s;
        }
        .cancha-card:hover { border-color: var(--green); transform: translateY(-3px); }

        /* ── Formulario ── */
        .form-wrap {
            background: var(--card);
            border: 1px solid var(--border);
        }
        .form-input {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            color: #e5e5e5;
            transition: border-color 0.2s;
        }
        .form-input:focus { outline: none; border-color: var(--green); }
        .form-label { color: #888; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em; }

        /* ── Franjas horarias ── */
        .franja {
            border: 1px solid #2a2a2a;
            background: #1a1a1a;
            color: #e5e5e5;
            cursor: pointer;
            transition: all 0.15s;
            user-select: none;
        }
        .franja:hover:not(.ocupada):not(.seleccionada) { border-color: var(--green); color: var(--green); }
        .franja.seleccionada { background: var(--green); border-color: var(--green); color: #000; font-weight: 500; }
        .franja.ocupada { background: #111; border-color: #1f1f1f; color: #333; cursor: not-allowed; text-decoration: line-through; }

        /* ── Paso activo ── */
        .paso { display: none; }
        .paso.activo { display: block; }
        .step-dot { transition: all 0.3s; }
        .step-dot.activo { background: var(--green); }

        /* ── WhatsApp flotante ── */
        .wa-btn {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 50;
            background: #25d366;
            width: 56px; height: 56px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(37,211,102,0.4);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .wa-btn:hover { transform: scale(1.08); box-shadow: 0 6px 28px rgba(37,211,102,0.5); }

        /* ── Loading skeleton ── */
        .skeleton { background: linear-gradient(90deg, #1a1a1a 25%, #242424 50%, #1a1a1a 75%); background-size: 200% 100%; animation: shimmer 1.4s infinite; border-radius: 8px; height: 42px; }
        @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════ --}}
{{-- NAVBAR                                  --}}
{{-- ═══════════════════════════════════════ --}}
<nav class="fixed top-0 left-0 right-0 z-40 px-4 py-3 flex items-center justify-between" style="background: rgba(10,10,10,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid #1a1a1a;">
    <span class="bebas text-2xl" style="color: var(--green);">Canchas Javi</span>
    <a href="#reservar" class="btn-green text-sm px-4 py-2 rounded-lg">Reservar ahora</a>
</nav>

{{-- ═══════════════════════════════════════ --}}
{{-- HERO                                    --}}
{{-- ═══════════════════════════════════════ --}}
<section class="hero-bg relative min-h-screen flex items-center justify-center text-center px-4 pt-16">
    <div class="relative z-10 max-w-2xl mx-auto">

        @if(session('success'))
        <div class="mb-8 px-4 py-3 rounded-xl text-sm font-medium fade-up" style="background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.3); color: var(--green);">
            ✓ {{ session('success') }}
        </div>
        @endif

        <p class="fade-up fade-up-1 text-xs uppercase tracking-widest mb-4" style="color: var(--green);">Villa Tesei · Buenos Aires</p>
        <h1 class="fade-up fade-up-2 text-6xl md:text-8xl leading-none mb-6 text-white">
            TU CANCHA<br>TE ESPERA
        </h1>
        <p class="fade-up fade-up-3 text-base md:text-lg mb-10" style="color: #888;">
            Reservá tu turno en minutos, sin llamadas, sin esperas.
        </p>
        <a href="#reservar" class="fade-up fade-up-3 btn-green inline-block px-8 py-4 rounded-xl text-base">
            Reservar mi cancha →
        </a>
    </div>

    {{-- Indicador scroll --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2" style="color: #444;">
        <span class="text-xs tracking-widest uppercase">scroll</span>
        <div style="width:1px; height:32px; background: linear-gradient(to bottom, #444, transparent);"></div>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- NUESTRAS CANCHAS                        --}}
{{-- ═══════════════════════════════════════ --}}
<section id="canchas" class="py-20 px-4 max-w-5xl mx-auto">
    <p class="text-xs uppercase tracking-widest mb-2" style="color: var(--green);">Instalaciones</p>
    <h2 class="text-4xl md:text-5xl text-white mb-12">Nuestras canchas</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($canchas as $cancha)
        <div class="cancha-card rounded-2xl p-6">
            {{-- Ícono campo --}}
            <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background: rgba(34,197,94,0.1);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="1.5">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <circle cx="12" cy="12" r="3"/>
                    <line x1="12" y1="4" x2="12" y2="20"/>
                    <line x1="2" y1="12" x2="5" y2="12"/>
                    <line x1="19" y1="12" x2="22" y2="12"/>
                </svg>
            </div>
            <p class="text-xs uppercase tracking-widest mb-1" style="color: #555;">Cancha</p>
            <h3 class="bebas text-3xl text-white mb-3">{{ $cancha->numero }}</h3>
            <div class="flex items-end gap-1">
                <span class="text-2xl font-light" style="color: var(--green);">${{ number_format($cancha->precio_base, 0, ',', '.') }}</span>
                <span class="text-xs mb-1" style="color: #555;">/ hora</span>
            </div>
            <a  href="#reservar" onclick="preseleccionarCancha({{ $cancha->id }})"
                class="mt-4 w-full block text-center text-sm py-2.5 rounded-lg border transition-colors"
                style="border-color: #2a2a2a; color: #888;"
                onmouseover="this.style.borderColor='#22c55e'; this.style.color='#22c55e';"
                onmouseout="this.style.borderColor='#2a2a2a'; this.style.color='#888';">
                Reservar esta cancha
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- FORMULARIO DE RESERVA                   --}}
{{-- ═══════════════════════════════════════ --}}
<section id="reservar" class="py-20 px-4">
    <div class="max-w-lg mx-auto">

        <p class="text-xs uppercase tracking-widest mb-2" style="color: var(--green);">Reservas online</p>
        <h2 class="text-4xl md:text-5xl text-white mb-10">Reservá tu turno</h2>

        {{-- Indicador de pasos --}}
        <div class="flex items-center gap-3 mb-10">
            <div class="flex items-center gap-2">
                <div id="dot-1" class="step-dot activo w-7 h-7 rounded-full flex items-center justify-center text-xs font-medium text-black" style="background: var(--green);">1</div>
                <span class="text-xs" style="color: #888;">Cancha y fecha</span>
            </div>
            <div class="flex-1 h-px" style="background: #2a2a2a;"></div>
            <div class="flex items-center gap-2">
                <div id="dot-2" class="step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-medium" style="background: #2a2a2a; color: #555;">2</div>
                <span class="text-xs" style="color: #888;">Horario</span>
            </div>
            <div class="flex-1 h-px" style="background: #2a2a2a;"></div>
            <div class="flex items-center gap-2">
                <div id="dot-3" class="step-dot w-7 h-7 rounded-full flex items-center justify-center text-xs font-medium" style="background: #2a2a2a; color: #555;">3</div>
                <span class="text-xs" style="color: #888;">Confirmar</span>
            </div>
        </div>

        <form id="form-reserva" action="{{ route('reserva.publica.store') }}" method="POST">
            @csrf
            {{-- Campos ocultos que se llenan por JS --}}
            <input type="hidden" name="horario_inicio" id="input-horario-inicio">
            <input type="hidden" name="horario_fin"    id="input-horario-fin">
            <input type="hidden" name="precio_total"   id="input-precio-total">

            {{-- ── PASO 1: Cancha y Fecha ── --}}
            <div id="paso-1" class="paso activo form-wrap rounded-2xl p-6">
                <h3 class="text-lg font-medium text-white mb-6">Elegí la cancha y la fecha</h3>

                <div class="mb-5">
                    <label class="form-label block mb-2">Cancha</label>
                    <select name="cancha_id" id="select-cancha" class="form-input w-full px-4 py-3 rounded-xl text-sm" required>
                        <option value="">— Seleccioná una cancha —</option>
                        @foreach($canchas as $cancha)
                        <option value="{{ $cancha->id }}" data-precio="{{ $cancha->precio_base }}">
                            Cancha {{ $cancha->numero }} — ${{ number_format($cancha->precio_base, 0, ',', '.') }}/h
                        </option>
                        @endforeach
                    </select>
                    @error('cancha_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="form-label block mb-2">Fecha</label>
                    <input  type="date" name="fecha_reserva" id="input-fecha"
                            min="{{ date('Y-m-d') }}"
                            class="form-input w-full px-4 py-3 rounded-xl text-sm" required>
                    @error('fecha_reserva') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="button" onclick="irPaso2()"
                        class="btn-green w-full py-3.5 rounded-xl text-sm">
                    Ver horarios disponibles →
                </button>
            </div>

            {{-- ── PASO 2: Horarios ── --}}
            <div id="paso-2" class="paso form-wrap rounded-2xl p-6">
                <button type="button" onclick="irPaso(1)" class="flex items-center gap-2 text-xs mb-6" style="color: #555;">
                    ← Volver
                </button>
                <h3 class="text-lg font-medium text-white mb-2">Elegí tu horario</h3>
                <p id="subtitulo-paso2" class="text-xs mb-6" style="color: #555;"></p>

                <div id="contenedor-franjas" class="grid grid-cols-2 gap-2 mb-6">
                    {{-- Se llena dinámicamente por JS --}}
                </div>

                <p id="error-horario" class="text-red-500 text-xs mb-4 hidden">Por favor seleccioná un horario.</p>

                <button type="button" onclick="irPaso3()"
                        class="btn-green w-full py-3.5 rounded-xl text-sm">
                    Continuar →
                </button>
            </div>

            {{-- ── PASO 3: Datos del cliente ── --}}
            <div id="paso-3" class="paso form-wrap rounded-2xl p-6">
                <button type="button" onclick="irPaso(2)" class="flex items-center gap-2 text-xs mb-6" style="color: #555;">
                    ← Volver
                </button>
                <h3 class="text-lg font-medium text-white mb-6">Confirmá tu reserva</h3>

                {{-- Resumen --}}
                <div class="rounded-xl p-4 mb-6 text-sm" style="background: #161616; border: 1px solid #1f1f1f;">
                    <div class="flex justify-between mb-2">
                        <span style="color: #555;">Cancha</span>
                        <span id="resumen-cancha" class="text-white font-medium">—</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span style="color: #555;">Fecha</span>
                        <span id="resumen-fecha" class="text-white font-medium">—</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span style="color: #555;">Horario</span>
                        <span id="resumen-horario" class="text-white font-medium">—</span>
                    </div>
                    <div class="flex justify-between pt-2" style="border-top: 1px solid #1f1f1f;">
                        <span style="color: #555;">Total</span>
                        <span id="resumen-total" class="font-medium" style="color: var(--green);">—</span>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="form-label block mb-2">Tu nombre completo</label>
                    <input  type="text" name="cliente_nombre" id="input-nombre"
                            placeholder="Ej: Juan García"
                            class="form-input w-full px-4 py-3 rounded-xl text-sm" required>
                    @error('cliente_nombre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg text-xs" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #f87171;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <button type="submit"
                        class="btn-green w-full py-3.5 rounded-xl text-sm font-medium">
                    Confirmar reserva ✓
                </button>

                <p class="text-center text-xs mt-4" style="color: #444;">
                    El pago se abona en el complejo. Sin tarjeta requerida.
                </p>
            </div>

        </form>
    </div>
</section>

{{-- ═══════════════════════════════════════ --}}
{{-- FOOTER                                  --}}
{{-- ═══════════════════════════════════════ --}}
<footer class="py-12 px-4 mt-8" style="border-top: 1px solid #1a1a1a;">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <span class="bebas text-2xl" style="color: var(--green);">Canchas Javi</span>
            <p class="text-sm mt-2" style="color: #555;">Complejo de fútbol en Villa Tesei,<br>partido de Hurlingham.</p>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest mb-3" style="color: #444;">Ubicación</p>
            <p class="text-sm" style="color: #888;">Av. Ejemplo 1234<br>Villa Tesei, Buenos Aires</p>
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest mb-3" style="color: #444;">Contacto</p>
            <a href="https://wa.me/5491100000000" class="text-sm" style="color: var(--green);">+54 9 11 0000-0000</a>
            <p class="text-sm mt-1" style="color: #555;">Lunes a domingo · 8:00–23:00</p>
        </div>
        <div>
            <a href="{{ url('/admin/login') }}" class="text-2xl cursor-pointer" style="color: var(--green);">
                Iniciar Sesión
            </a>
        </div>
    </div>
    <p class="text-center text-xs mt-10" style="color: #333;">© {{ date('Y') }} Canchas Javi. Todos los derechos reservados.</p>
</footer>

{{-- ═══════════════════════════════════════ --}}
{{-- BOTÓN FLOTANTE WHATSAPP                 --}}
{{-- ═══════════════════════════════════════ --}}
<a href="https://wa.me/5491100000000?text=Hola!%20Quiero%20consultar%20sobre%20una%20reserva"
    target="_blank" class="wa-btn" title="Consultar por WhatsApp">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="white">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

{{-- ═══════════════════════════════════════ --}}
{{-- JAVASCRIPT                              --}}
{{-- ═══════════════════════════════════════ --}}
<script>
    // ── Estado global del formulario ──
    const estado = {
        paso: 1,
        canchaId: null,
        canchaLabel: '',
        fecha: '',
        franjaSeleccionada: null,
    };

    // ── Navegar entre pasos ──
    function irPaso(n) {
        document.querySelectorAll('.paso').forEach(p => p.classList.remove('activo'));
        document.getElementById('paso-' + n).classList.add('activo');

        // Actualizar dots
        [1, 2, 3].forEach(i => {
            const dot = document.getElementById('dot-' + i);
            if (i <= n) {
                dot.classList.add('activo');
                dot.style.background = 'var(--green)';
                dot.style.color = '#000';
            } else {
                dot.classList.remove('activo');
                dot.style.background = '#2a2a2a';
                dot.style.color = '#555';
            }
        });

        estado.paso = n;
        window.scrollTo({ top: document.getElementById('reservar').offsetTop - 20, behavior: 'smooth' });
    }

    // ── Paso 1 → Paso 2 ──
    async function irPaso2() {
        const canchaId = document.getElementById('select-cancha').value;
        const fecha    = document.getElementById('input-fecha').value;

        if (!canchaId || !fecha) {
            alert('Por favor seleccioná una cancha y una fecha.');
            return;
        }

        const opt = document.getElementById('select-cancha').selectedOptions[0];
        estado.canchaId    = canchaId;
        estado.canchaLabel = opt.text;
        estado.fecha       = fecha;
        estado.franjaSeleccionada = null;

        // Actualizar subtítulo
        const fechaFormat = new Date(fecha + 'T00:00:00').toLocaleDateString('es-AR', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
        document.getElementById('subtitulo-paso2').textContent = opt.text + ' · ' + fechaFormat;

        irPaso(2);
        await cargarFranjas(canchaId, fecha);
    }

    // ── Cargar franjas desde la API ──
    async function cargarFranjas(canchaId, fecha) {
        const contenedor = document.getElementById('contenedor-franjas');

        // Mostrar skeletons mientras carga
        contenedor.innerHTML = Array(6).fill('<div class="skeleton"></div>').join('');

        try {
            const url = `{{ route('api.horarios') }}?cancha_id=${canchaId}&fecha=${fecha}`;
            const res = await fetch(url, {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });

            if (!res.ok) throw new Error('Error al consultar horarios');
            const franjas = await res.json();

            contenedor.innerHTML = '';
            franjas.forEach(f => {
                const div = document.createElement('div');
                div.className = 'franja rounded-xl px-4 py-3 text-sm text-center ' + (f.ocupada ? 'ocupada' : '');
                div.textContent = f.label;
                div.dataset.inicio = f.inicio;
                div.dataset.fin    = f.fin;

                if (!f.ocupada) {
                    div.addEventListener('click', () => seleccionarFranja(div, f));
                }
                contenedor.appendChild(div);
            });

        } catch (e) {
            contenedor.innerHTML = '<p class="col-span-2 text-sm text-red-400">Error al cargar los horarios. Intentá de nuevo.</p>';
        }
    }

    // ── Seleccionar una franja ──
    function seleccionarFranja(el, franja) {
        document.querySelectorAll('.franja').forEach(f => f.classList.remove('seleccionada'));
        el.classList.add('seleccionada');
        estado.franjaSeleccionada = franja;
        document.getElementById('error-horario').classList.add('hidden');

        // Llenar inputs ocultos
        document.getElementById('input-horario-inicio').value = franja.inicio;
        document.getElementById('input-horario-fin').value    = franja.fin;
    }

    // ── Paso 2 → Paso 3 ──
    function irPaso3() {
        if (!estado.franjaSeleccionada) {
            document.getElementById('error-horario').classList.remove('hidden');
            return;
        }

        // Calcular precio
        const opt    = document.getElementById('select-cancha').selectedOptions[0];
        const precio = parseFloat(opt.dataset.precio) || 0;
        document.getElementById('input-precio-total').value = precio;

        // Llenar resumen
        const fechaFormat = new Date(estado.fecha + 'T00:00:00').toLocaleDateString('es-AR', {
            weekday: 'long', day: 'numeric', month: 'long'
        });
        document.getElementById('resumen-cancha').textContent  = estado.canchaLabel;
        document.getElementById('resumen-fecha').textContent   = fechaFormat;
        document.getElementById('resumen-horario').textContent = estado.franjaSeleccionada.label;
        document.getElementById('resumen-total').textContent   = '$' + precio.toLocaleString('es-AR');

        irPaso(3);
    }

    // ── Preseleccionar cancha desde las tarjetas ──
    function preseleccionarCancha(id) {
        const select = document.getElementById('select-cancha');
        select.value = id;
    }

    // ── Restaurar estado si hay errores de validación ──
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            const inicio = '{{ old('horario_inicio') }}';
            const fin    = '{{ old('horario_fin') }}';
            if (inicio && fin) {
                document.getElementById('input-horario-inicio').value = inicio;
                document.getElementById('input-horario-fin').value    = fin;
            }
            irPaso(3);
        });
    @endif
</script>

</body>
</html>