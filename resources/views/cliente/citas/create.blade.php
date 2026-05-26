@extends('layouts.cliente')

@section('title', 'Reservar Cita')

@section('contenidoCliente')

    <style>
        :root {
            --bg: #0f0f10;
            --card: #18181b;
            --border: rgba(255, 255, 255, .08);
            --text: #fff;
            --muted: #a1a1aa;
            --accent: #F5DC5B;
        }

        .create-container {
            padding: 1.5rem;
            color: var(--text);
            max-width: 800px;
            margin: auto;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        label {
            font-size: .9rem;
            color: var(--muted);
        }

        input,
        select,
        textarea {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            padding: .9rem 1rem;
            border-radius: 10px;
        }

        textarea {
            resize: none;
            min-height: 120px;
        }

        .btn {
            margin-top: 1.5rem;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            background: var(--accent);
            color: #000;
            font-weight: 700;
            cursor: pointer;
        }

        .error {
            color: #ef4444;
            font-size: .8rem;
        }
    </style>

    <div class="create-container">

        <div class="card">

            <h1 style="margin-top:0">📅 Reservar Cita</h1>

            <form action="{{ route('cliente.citas.store') }}" method="POST">

                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>Barbero</label>

                        <select name="barbero_id" required>

                            <option value="">Seleccionar</option>

                            @foreach ($barberos as $barbero)
                                <option value="{{ $barbero->id }}"
                                    {{ isset($barberoSeleccionado) && $barberoSeleccionado == $barbero->id ? 'selected' : '' }}>

                                    {{ $barbero->nombre }}

                                </option>
                            @endforeach

                        </select>

                        @error('barbero_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Servicio</label>

                        <select name="servicio_id" required>

                            <option value="">Seleccionar</option>

                            @foreach ($servicios as $servicio)
                                <option value="{{ $servicio->id }}"
                                    {{ isset($servicioSeleccionado) && $servicioSeleccionado == $servicio->id ? 'selected' : '' }}>

                                    {{ $servicio->nombre }}

                                </option>
                            @endforeach

                        </select>


                        @error('servicio_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Fecha</label>

                        <input type="date" name="fecha" required>

                        @error('fecha')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Hora</label>

                        <input type="time" name="hora" required>

                        @error('hora')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>



                </div>

                <button class="btn">
                    💾 Reservar Cita
                </button>

            </form>

        </div>

    </div>

@endsection
