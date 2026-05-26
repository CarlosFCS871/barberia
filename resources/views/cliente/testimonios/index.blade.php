@extends('layouts.cliente')
@section('title', 'Mis Testimonios')
@section('contenidoCliente')

    <style>
        :root {
            --gold: #F5DC5B;
            --dark: #0f0f0f;
            --card: #171717;
            --border: rgba(245, 220, 91, .15);
            --text: #f5f5f5;
            --muted: #9ca3af;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            color: var(--text);
        }

        .page-wrapper {
            padding: 30px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .top-header h1 {
            font-size: 2rem;
            font-weight: 800;
        }

        .btn-create {
            background: var(--gold);
            color: #000;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 700;
            transition: .3s;
        }

        .btn-create:hover {
            transform: translateY(-3px);
        }

        .alert-success {
            background: rgba(34, 197, 94, .15);
            color: #86efac;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid rgba(34, 197, 94, .3);
        }

        .grid-testimonios {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .card-testimonio {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 25px;
            transition: .3s;
        }

        .card-testimonio:hover {
            transform: translateY(-5px);
            border-color: var(--gold);
        }

        .stars {
            color: var(--gold);
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .comentario {
            color: #d1d5db;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .estado {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: .85rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .pendiente {
            background: rgba(245, 158, 11, .15);
            color: #fcd34d;
        }

        .aprobado {
            background: rgba(34, 197, 94, .15);
            color: #86efac;
        }

        .rechazado {
            background: rgba(239, 68, 68, .15);
            color: #fca5a5;
        }

        .fecha {
            color: var(--muted);
            font-size: .9rem;
            margin-top: 10px;
        }

        .btn-delete {
            margin-top: 20px;
            width: 100%;
            border: none;
            background: rgba(239, 68, 68, .12);
            color: #f87171;
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            transition: .3s;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: #fff;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
            background: var(--card);
            border-radius: 20px;
            border: 1px dashed var(--border);
        }

        .empty h3 {
            margin-bottom: 10px;
        }
    </style>

    <div class="page-wrapper">

        <div class="top-header">

            <h1>⭐ Mis Testimonios</h1>

            <a href="{{ route('cliente.testimonios.create') }}" class="btn-create">

                + Nuevo Testimonio

            </a>

        </div>

        @if (session('success'))
            <div class="alert-success">

                {{ session('success') }}

            </div>
        @endif

        @forelse($testimonios as $testimonio)
            <div class="grid-testimonios">

                <div class="card-testimonio">

                    <div class="stars">

                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= $testimonio->calificacion ? '★' : '☆' }}
                        @endfor

                    </div>

                    <p class="comentario">

                        "{{ $testimonio->comentario }}"

                    </p>

                    <span class="estado {{ $testimonio->estado }}">

                        {{ ucfirst($testimonio->estado) }}

                    </span>

                    <div class="fecha">

                        Enviado:
                        {{ $testimonio->created_at->format('d/m/Y') }}

                    </div>

                    <form action="{{ route('cliente.testimonios.destroy', $testimonio->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-delete">

                            Eliminar

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty">

                <h3>No tienes testimonios aún</h3>

                <p>Comparte tu experiencia con la barbería</p>

            </div>
        @endforelse

    </div>

@endsection
