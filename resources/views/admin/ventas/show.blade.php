@extends('layouts.admin')
@section('title', 'Detalle de Venta')
@section('AdminContenido')
    <style>
        /* ================= VARIABLES - SISTEMA CONSISTENTE ================= */
        :root {
            --sb-bg: #000000;
            --sb-card: #0a0a0a;
            --sb-border: rgba(255, 255, 255, 0.08);
            --sb-text: #ffffff;
            --sb-muted: #a1a1aa;
            --sb-accent: #F5DC5B;
            --sb-accent-hover: #e6c94a;
            --sb-accent-soft: rgba(245, 220, 91, 0.12);
            --sb-yellow: #eab308;
            --sb-green: #22c55e;
            --sb-red: #ef4444;
            --sb-blue: #3b82f6;
            --sb-radius: 16px;
            --sb-transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="light"] {
            --sb-bg: #f8f9fa;
            --sb-card: #ffffff;
            --sb-border: #e5e7eb;
            --sb-text: #0a0a0a;
            --sb-muted: #4b5563;
            --sb-accent: #b89600;
            --sb-accent-hover: #a38500;
            --sb-accent-soft: rgba(245, 220, 91, 0.18);
            --sb-yellow: #ca8a04;
            --sb-green: #16a34a;
            --sb-red: #dc2626;
            --sb-blue: #2563eb;
        }

        /* ================= BASE ================= */
        .venta-show {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            color: var(--sb-text);
            padding: 1rem;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .venta-show *,
        .venta-show *::before,
        .venta-show *::after {
            box-sizing: border-box;
            max-width: 100%;
        }

        /* ================= HEADER ================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--sb-border);
        }

        .page-header h1 {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            font-weight: 800;
            margin: 0;
        }

        .btn {
            padding: 0.65rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--sb-transition);
            min-height: 40px;
        }

        .btn-primary {
            background: var(--sb-accent);
            color: #000;
        }

        .btn-primary:hover {
            background: var(--sb-accent-hover);
            transform: translateY(-2px);
        }

        /* ================= RECEIPT CARD ================= */
        .receipt-card {
            background: var(--sb-card);
            border: 1px solid var(--sb-border);
            border-radius: var(--sb-radius);
            overflow: hidden;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .receipt-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--sb-accent), transparent);
        }

        /* Header */
        .receipt-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px dashed var(--sb-border);
            background: var(--sb-bg);
        }

        .receipt-id {
            font-size: 0.8rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .receipt-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .status-pagado {
            background: rgba(34, 197, 94, 0.15);
            color: var(--sb-green);
            border: 2px solid var(--sb-green);
        }

        .status-pendiente {
            background: rgba(234, 179, 8, 0.15);
            color: var(--sb-yellow);
            border: 2px solid var(--sb-yellow);
        }

        .status-anulado {
            background: rgba(239, 68, 68, 0.15);
            color: var(--sb-red);
            border: 2px solid var(--sb-red);
        }

        /* Body */
        .receipt-body {
            padding: 1.5rem;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            padding: 0.6rem 0;
            border-bottom: 1px dotted var(--sb-border);
        }

        .receipt-row:last-child {
            border-bottom: none;
        }

        .receipt-label {
            color: var(--sb-muted);
            font-size: 0.85rem;
        }

        .receipt-value {
            font-weight: 600;
            color: var(--sb-text);
            font-size: 0.9rem;
            text-align: right;
        }

        .receipt-value.highlight {
            color: var(--sb-accent);
            font-size: 1.2rem;
            font-weight: 800;
        }

        .receipt-divider {
            margin: 1.25rem 0;
            border-top: 1px dashed var(--sb-border);
        }

        /* Sections */
        .receipt-section {
            margin-bottom: 1.25rem;
        }

        .receipt-section-title {
            font-size: 0.7rem;
            color: var(--sb-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .receipt-section-title::before {
            content: '';
            width: 3px;
            height: 14px;
            background: var(--sb-accent);
            border-radius: 2px;
        }

        /* Total Box */
        .total-box {
            background: linear-gradient(135deg, rgba(245, 220, 91, 0.1), rgba(245, 220, 91, 0.05));
            border: 1px solid var(--sb-accent-soft);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            text-align: center;
        }

        .total-box .label {
            font-size: 0.8rem;
            color: var(--sb-muted);
            margin-bottom: 0.25rem;
        }

        .total-box .amount {
            font-size: 2rem;
            font-weight: 800;
            color: var(--sb-accent);
            letter-spacing: -1px;
        }

        /* Footer */
        .receipt-footer {
            padding: 1rem 1.5rem;
            background: var(--sb-bg);
            border-top: 1px solid var(--sb-border);
            font-size: 0.75rem;
            color: var(--sb-muted);
            text-align: center;
            line-height: 1.5;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .venta-show {
                padding: 0.75rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .receipt-body {
                padding: 1.25rem;
            }

            .receipt-value {
                text-align: left;
                margin-top: 0.2rem;
            }

            .receipt-row {
                flex-direction: column;
                gap: 0.2rem;
            }
        }

        @media (max-width: 480px) {
            .venta-show {
                padding: 0.5rem;
            }

            .page-header h1 {
                font-size: 1.3rem;
            }

            .receipt-card::before {
                height: 3px;
            }

            .receipt-header {
                padding: 1.25rem;
            }

            .receipt-body {
                padding: 1rem;
            }

            .total-box .amount {
                font-size: 1.6rem;
            }
        }

        @media (hover: none) and (pointer: coarse) {
            .btn {
                min-height: 48px !important;
            }
        }
    </style>

    <div class="venta-show">
        <header class="page-header">
            <h1>🧾 Detalle de Venta</h1>
            <a href="{{ route('admin.ventas.index') }}" class="btn btn-primary">← Volver al listado</a>
        </header>

        <article class="receipt-card">
            <!-- HEADER -->
            <div class="receipt-header">
                <div class="receipt-id">VENTA #{{ str_pad($venta->id, 4, '0', STR_PAD_LEFT) }}</div>
                <span class="receipt-status status-{{ $venta->estado_pago }}">
                    {{ $venta->estado_pago === 'pagado' ? '✅' : ($venta->estado_pago === 'pendiente' ? '⏳' : '❌') }}
                    {{ ucfirst($venta->estado_pago) }}
                </span>
            </div>

            <!-- BODY -->
            <div class="receipt-body">
                <div class="receipt-section">
                    <div class="receipt-section-title">👤 Información del Cliente</div>
                    <div class="receipt-row"><span class="receipt-label">Nombre</span><span
                            class="receipt-value">{{ $venta->cliente->nombre ?? 'N/A' }}
                            {{ $venta->cliente->apellido ?? '' }}</span></div>
                    <div class="receipt-row"><span class="receipt-label">Email</span><span
                            class="receipt-value">{{ $venta->cliente->email ?? 'N/A' }}</span></div>
                </div>

                <div class="receipt-section">
                    <div class="receipt-section-title">✂️ Atención & Servicio</div>
                    <div class="receipt-row"><span class="receipt-label">Barbero</span><span
                            class="receipt-value">{{ $venta->barbero->nombre ?? 'N/A' }}
                            {{ $venta->barbero->apellido ?? '' }}</span></div>
                    <div class="receipt-row"><span class="receipt-label">Cita ID</span><span
                            class="receipt-value">{{ $venta->cita_id ? '#' . str_pad($venta->cita_id, 4, '0', STR_PAD_LEFT) : 'N/A' }}</span>
                    </div>
                </div>

                <div class="receipt-divider"></div>

                <div class="receipt-section">
                    <div class="receipt-section-title">💳 Método de Pago</div>
                    <div class="receipt-row"><span class="receipt-label">Forma</span><span
                            class="receipt-value">{{ ucfirst($venta->metodo_pago) }}</span></div>
                    <div class="receipt-row"><span class="receipt-label">Estado</span><span class="receipt-value"
                            style="text-transform:capitalize;">{{ $venta->estado_pago }}</span></div>
                    <div class="receipt-row"><span class="receipt-label">Procesado</span><span
                            class="receipt-value">{{ $venta->created_at->format('d/m/Y H:i') }}</span></div>
                </div>

                <!-- TOTAL BOX -->
                <div class="total-box">
                    <div class="label">TOTAL PAGADO</div>
                    <div class="amount">S/ {{ number_format($venta->total, 2) }}</div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="receipt-footer">
                🔐 Documento generado automáticamente por Snyder Barber POS<br>
                📅 Fecha de emisión: {{ $venta->created_at->format('d M Y, h:i A') }}<br>
                ⚙️ ID Sistema: {{ $venta->id }} | Cita: {{ $venta->cita_id }}
            </div>
        </article>
    </div>
@endsection
