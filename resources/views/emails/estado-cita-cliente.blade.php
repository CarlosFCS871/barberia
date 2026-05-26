<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de tu Cita Actualizado - Snyder Barber</title>
    <style>
        /* ================= BASE EMAIL STYLES ================= */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            background: #0a0a0a;
            color: #f8fafc;
            line-height: 1.6;
        }
        
        /* ================= CONTAINER ================= */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #111113;
            border: 1px solid rgba(245, 220, 91, 0.2);
            border-radius: 16px;
            overflow: hidden;
        }
        
        /* ================= HEADER ================= */
        .email-header {
            background: linear-gradient(135deg, #0a0a0a, #1a1a1c);
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(245, 220, 91, 0.2);
        }
        
        .email-logo {
            max-width: 180px;
            height: auto;
            margin: 0 auto 1rem;
            display: block;
        }
        
        .email-title {
            color: #F5DC5B;
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }
        
        .email-subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
            margin: 0.5rem 0 0;
        }
        
        /* ================= CONTENT ================= */
        .email-content {
            padding: 2rem 1.5rem;
        }
        
        .greeting {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: #f8fafc;
        }
        
        .greeting strong {
            color: #F5DC5B;
        }
        
        .info-text {
            color: #94a3b8;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        /* ================= APPOINTMENT DETAILS ================= */
        .appointment-box {
            background: rgba(30, 30, 35, 0.8);
            border: 1px solid rgba(245, 220, 91, 0.2);
            border-radius: 12px;
            padding: 1.25rem;
            margin: 1.5rem 0;
        }
        
        .appointment-title {
            color: #F5DC5B;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(245, 220, 91, 0.1);
        }
        
        .appointment-row {
            display: table;
            width: 100%;
            margin-bottom: 0.75rem;
        }
        
        .appointment-row:last-child {
            margin-bottom: 0;
        }
        
        .appointment-label {
            display: table-cell;
            width: 40%;
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .appointment-value {
            display: table-cell;
            color: #f8fafc;
            font-size: 0.95rem;
            font-weight: 600;
        }
        
        .appointment-value.highlight {
            color: #F5DC5B;
        }
        
        /* ================= STATUS BADGE ================= */
        .status-section {
            text-align: center;
            padding: 1rem;
            margin: 1.5rem 0;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-confirmada {
            background: rgba(34, 197, 94, 0.15);
            color: #22c55e;
            border: 2px solid rgba(34, 197, 94, 0.4);
        }
        
        .status-cancelada {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 2px solid rgba(239, 68, 68, 0.4);
        }
        
        .status-finalizada {
            background: rgba(245, 220, 91, 0.15);
            color: #F5DC5B;
            border: 2px solid rgba(245, 220, 91, 0.4);
        }
        
        .status-message {
            margin-top: 1rem;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .status-message.confirmada { color: #22c55e; }
        .status-message.cancelada { color: #ef4444; }
        .status-message.finalizada { color: #F5DC5B; }
        
        /* ================= CTA BUTTON ================= */
        .cta-section {
            text-align: center;
            padding: 1.5rem 0;
        }
        
        .cta-button {
            display: inline-block;
            background: #F5DC5B;
            color: #000000;
            text-decoration: none;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            transition: background 0.3s ease;
        }
        
        .cta-button:hover {
            background: #e6c94a;
        }
        
        /* ================= FOOTER ================= */
        .email-footer {
            background: #0a0a0a;
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid rgba(245, 220, 91, 0.2);
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .footer-links {
            margin: 1rem 0;
        }
        
        .footer-links a {
            color: #F5DC5B;
            text-decoration: none;
            margin: 0 0.5rem;
            font-size: 0.9rem;
        }
        
        .footer-copyright {
            margin: 0;
            font-size: 0.8rem;
        }
        
        /* ================= RESPONSIVE ================= */
        @media screen and (max-width: 480px) {
            .email-container {
                border-radius: 0;
            }
            .email-header,
            .email-content,
            .email-footer {
                padding: 1.5rem 1rem;
            }
            .appointment-label,
            .appointment-value {
                display: block;
                width: 100%;
            }
            .appointment-label {
                margin-bottom: 0.25rem;
            }
            .cta-button {
                width: 100%;
                box-sizing: border-box;
            }
            .status-badge {
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>
<body style="margin:0;padding:0;font-family:'Plus Jakarta Sans',Arial,sans-serif;background:#0a0a0a;color:#f8fafc;line-height:1.6">

    <!-- CONTAINER PRINCIPAL -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#0a0a0a">
        <tr>
            <td align="center" style="padding:1rem">
                
                <!-- EMAIL CARD -->
                <table class="email-container" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;background:#111113;border:1px solid rgba(245,220,91,0.2);border-radius:16px;overflow:hidden">
                    
                    <!-- HEADER CON LOGO -->
                    <tr>
                        <td class="email-header" style="background:linear-gradient(135deg,#0a0a0a,#1a1a1c);padding:2rem 1.5rem;text-align:center;border-bottom:1px solid rgba(245,220,91,0.2)">
                            <!-- LOGO - REEMPLAZA CON TU RUTA -->
                            <img src="{{ asset('images/logo.jpg') }}" alt="Snyder Barber" class="email-logo" style="max-width:180px;height:auto;margin:0 auto 1rem;display:block">
                            
                            <h1 class="email-title" style="color:#F5DC5B;font-size:1.4rem;font-weight:700;margin:0;letter-spacing:1px">✂️ Snyder Barber</h1>
                            <p class="email-subtitle" style="color:#94a3b8;font-size:0.95rem;margin:0.5rem 0 0">Actualización de Estado</p>
                        </td>
                    </tr>
                    
                    <!-- CONTENIDO PRINCIPAL -->
                    <tr>
                        <td class="email-content" style="padding:2rem 1.5rem">
                            
                            <!-- SALUDO -->
                            <p class="greeting" style="font-size:1.1rem;margin-bottom:1.5rem;color:#f8fafc">
                                Hola <strong style="color:#F5DC5B">{{ $cita->cliente->nombre }}</strong> 👋
                            </p>
                            
                            <p class="info-text" style="color:#94a3b8;margin-bottom:1.5rem;font-size:0.95rem">
                                Tu cita ha sido actualizada. Aquí están los detalles actualizados:
                            </p>
                            
                            <!-- DETALLES DE LA CITA -->
                            <table class="appointment-box" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:rgba(30,30,35,0.8);border:1px solid rgba(245,220,91,0.2);border-radius:12px;padding:1.25rem;margin:1.5rem 0">
                                <tr>
                                    <td>
                                        <h3 class="appointment-title" style="color:#F5DC5B;font-size:1.1rem;font-weight:600;margin:0 0 1rem;padding-bottom:0.75rem;border-bottom:1px solid rgba(245,220,91,0.1)">📋 Detalles de tu Cita</h3>
                                        
                                        <!-- Barbero -->
                                        <table class="appointment-row" width="100%" cellpadding="0" cellspacing="0" border="0" style="display:table;width:100%;margin-bottom:0.75rem">
                                            <tr>
                                                <td class="appointment-label" style="display:table-cell;width:40%;color:#94a3b8;font-size:0.9rem;font-weight:500">Barbero:</td>
                                                <td class="appointment-value" style="display:table-cell;color:#f8fafc;font-size:0.95rem;font-weight:600">{{ $cita->barbero->nombre }}</td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Servicio -->
                                        <table class="appointment-row" width="100%" cellpadding="0" cellspacing="0" border="0" style="display:table;width:100%;margin-bottom:0.75rem">
                                            <tr>
                                                <td class="appointment-label" style="display:table-cell;width:40%;color:#94a3b8;font-size:0.9rem;font-weight:500">Servicio:</td>
                                                <td class="appointment-value highlight" style="display:table-cell;color:#F5DC5B;font-size:0.95rem;font-weight:600">{{ $cita->servicio->nombre }}</td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Fecha -->
                                        <table class="appointment-row" width="100%" cellpadding="0" cellspacing="0" border="0" style="display:table;width:100%;margin-bottom:0.75rem">
                                            <tr>
                                                <td class="appointment-label" style="display:table-cell;width:40%;color:#94a3b8;font-size:0.9rem;font-weight:500">Fecha:</td>
                                                <td class="appointment-value" style="display:table-cell;color:#f8fafc;font-size:0.95rem;font-weight:600">{{ \Carbon\Carbon::parse($cita->fecha)->format('d M Y') }}</td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Hora -->
                                        <table class="appointment-row" width="100%" cellpadding="0" cellspacing="0" border="0" style="display:table;width:100%;margin-bottom:0.75rem">
                                            <tr>
                                                <td class="appointment-label" style="display:table-cell;width:40%;color:#94a3b8;font-size:0.9rem;font-weight:500">Hora:</td>
                                                <td class="appointment-value highlight" style="display:table-cell;color:#F5DC5B;font-size:1.1rem;font-weight:700">{{ $cita->hora }}</td>
                                            </tr>
                                        </table>
                                        
                                        <!-- Estado -->
                                        <table class="appointment-row" width="100%" cellpadding="0" cellspacing="0" border="0" style="display:table;width:100%;margin-bottom:0">
                                            <tr>
                                                <td class="appointment-label" style="display:table-cell;width:40%;color:#94a3b8;font-size:0.9rem;font-weight:500">Estado:</td>
                                                <td class="appointment-value" style="display:table-cell;color:#f8fafc;font-size:0.95rem;font-weight:600">
                                                    <span style="color:{{ $cita->estado == 'confirmada' ? '#22c55e' : ($cita->estado == 'cancelada' ? '#ef4444' : '#F5DC5B') }};font-weight:700">
                                                        {{ strtoupper($cita->estado) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- ESTADO CON BADGE Y MENSAJE -->
                            <div class="status-section">
                                <!-- Badge visual del estado -->
                                <span class="status-badge status-{{ $cita->estado }}">
                                    @if($cita->estado == 'confirmada') ✅ @endif
                                    @if($cita->estado == 'cancelada') ❌ @endif
                                    @if($cita->estado == 'finalizada') 🎉 @endif
                                    {{ strtoupper($cita->estado) }}
                                </span>
                                
                                <!-- Mensaje condicional (TU LÓGICA ORIGINAL) -->
                                @if($cita->estado == 'confirmada')
                                    <p class="status-message confirmada">✅ Tu cita fue confirmada.</p>
                                @endif

                                @if($cita->estado == 'cancelada')
                                    <p class="status-message cancelada">❌ Tu cita fue cancelada.</p>
                                @endif

                                @if($cita->estado == 'finalizada')
                                    <p class="status-message finalizada">🎉 Tu cita fue finalizada.</p>
                                @endif
                            </div>
                            
                            <!-- BOTÓN CTA (solo si está confirmada) -->
                            @if($cita->estado == 'confirmada')
                            <table class="cta-section" width="100%" cellpadding="0" cellspacing="0" border="0" style="text-align:center;padding:1.5rem 0">
                                <tr>
                                    <td>
                                        <a href="{{ route('cliente.citas.index') }}" class="cta-button" style="display:inline-block;background:#F5DC5B;color:#000000;text-decoration:none;padding:0.9rem 2rem;border-radius:10px;font-weight:700;font-size:1rem">
                                            📅 Ver mis citas
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @endif
                            
                            <!-- NOTA ADICIONAL -->
                            <p style="color:#64748b;font-size:0.9rem;text-align:center;margin:1rem 0 0">
                                <em>¿Tienes dudas? Contáctanos al 925 331 657 o responde a este correo.</em>
                            </p>
                            
                        </td>
                    </tr>
                    
                    <!-- FOOTER -->
                    <tr>
                        <td class="email-footer" style="background:#0a0a0a;padding:1.5rem;text-align:center;border-top:1px solid rgba(245,220,91,0.2);font-size:0.85rem;color:#64748b">
                            
                            <div class="footer-links" style="margin:1rem 0">
                                <a href="{{ route('cliente.dashboard') }}" style="color:#F5DC5B;text-decoration:none;margin:0 0.5rem;font-size:0.9rem">Mi Panel</a>
                                <a href="{{ route('cliente.citas.index') }}" style="color:#F5DC5B;text-decoration:none;margin:0 0.5rem;font-size:0.9rem">Mis Citas</a>
                                <a href="{{ route('cliente.perfil.index') }}" style="color:#F5DC5B;text-decoration:none;margin:0 0.5rem;font-size:0.9rem">Mi Perfil</a>
                            </div>
                            
                            <p class="footer-copyright" style="margin:0;font-size:0.8rem">
                                © {{ date('Y') }} Snyder Barber • Jirón Independencia, Coishco<br>
                                <a href="tel:+51925331657" style="color:#F5DC5B;text-decoration:none">925 331 657</a>
                            </p>
                            
                        </td>
                    </tr>
                    
                </table>
                
                <!-- SPACER FINAL -->
                <div style="height:2rem"></div>
                
            </td>
        </tr>
    </table>

</body>
</html>