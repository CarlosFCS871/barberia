@extends('layouts.cliente')

@section('contenidoCliente')

    <style>
        :root {
            --gold: #F5DC5B;
            --dark: #0f0f0f;
            --card: #171717;
            --border: rgba(245, 220, 91, .15);
            --text: #f5f5f5;
            --muted: #9ca3af;
        }

        body {
            background: #0a0a0a;
            color: var(--text);
        }

        .create-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .create-card {
            width: 100%;
            max-width: 700px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 25px;
            padding: 35px;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .title p {
            color: var(--muted);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
        }

        textarea {
            width: 100%;
            min-height: 180px;
            resize: none;
            background: #0f0f0f;
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 15px;
            color: #fff;
            font-size: 1rem;
        }

        textarea:focus {
            outline: none;
            border-color: var(--gold);
        }

        .rating {
            display: flex;
            gap: 10px;
        }

        .rating label {
            cursor: pointer;
        }

        .rating input {
            display: none;
        }

        .rating span {
            font-size: 2rem;
            color: #444;
            transition: .3s;
        }

        .rating input:checked+span {
            color: var(--gold);
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 15px;
            background: var(--gold);
            color: #000;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: .3s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
        }

        .errors {
            background: rgba(239, 68, 68, .12);
            color: #fca5a5;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>

    <div class="create-wrapper">

        <div class="create-card">

            <div class="title">

                <h1>⭐ Nuevo Testimonio</h1>

                <p>Comparte tu experiencia con Snyder Barber</p>

            </div>

            @if ($errors->any())
                <div class="errors">

                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

            <form action="{{ route('cliente.testimonios.store') }}" method="POST">

                @csrf

                <div class="form-group">

                    <label>

                        Comentario

                    </label>

                    <textarea name="comentario" placeholder="Escribe tu experiencia...">{{ old('comentario') }}</textarea>

                </div>

                <div class="form-group">

                    <label>

                        Calificación

                    </label>

                    <div class="rating">

                        @for ($i = 1; $i <= 5; $i++)
                            <label>

                                <input type="radio" name="calificacion" value="{{ $i }}">

                                <span>★</span>

                            </label>
                        @endfor

                    </div>

                </div>

                <button type="submit" class="btn-submit">

                    Enviar Testimonio

                </button>

            </form>

        </div>

    </div>

@endsection
