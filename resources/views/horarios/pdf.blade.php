<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario Semanal - KT&U</title>
    <style>
        @page {
            margin: 1cm;
            size: letter landscape; /* Orientación horizontal */
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #4f46e5;
            margin: 0;
            text-transform: uppercase;
            font-size: 22px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Mantiene las columnas del mismo ancho */
        }
        th {
            background-color: #4f46e5;
            color: white;
            padding: 8px;
            font-size: 12px;
            border: 1px solid #3730a3;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
            height: 50px; /* Altura mínima para las celdas de tiempo */
        }
        .hora-col {
            background-color: #f3f4f6;
            font-weight: bold;
            font-size: 11px;
            width: 80px;
        }
        .clase-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 4px;
            padding: 4px;
        }
        .materia-nombre {
            display: block;
            font-weight: bold;
            color: #1e40af;
            font-size: 10px;
        }
        .docente-nombre {
            display: block;
            font-size: 9px;
            color: #4b5563;
            margin-top: 2px;
        }
        .aula-tag {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            font-size: 8px;
            padding: 1px 4px;
            border-radius: 3px;
            margin-top: 3px;
        }
        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 10px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Sistema de Gestión Académica KT&U</h1>
        <p>REPORTE DE HORARIO SEMANAL - GESTIÓN 2026</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="hora-col">HORA</th>
                @foreach($dias as $dia)
                    <th>{{ strtoupper($dia) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($horas as $hora)
            <tr>
                <td class="hora-col">
                    {{ \Carbon\Carbon::parse($hora)->format('g:i A') }}
                </td>
                @foreach($dias as $dia)
                    <td>
                        @php
                            // Buscamos si hay una clase que coincida con el día y la hora
                            $clase = $horarios->where('dia', $dia)
                                              ->where('hora_inicio', '<=', $hora)
                                              ->where('hora_fin', '>', $hora)
                                              ->first();
                        @endphp

                        @if($clase)
                            <div class="clase-box">
                                <span class="materia-nombre">{{ $clase->asignatura->nombre }}</span>
                                <span class="docente-nombre">{{ $clase->profesor->nombre }} {{ $clase->profesor->apellido }}</span>
                                <span class="aula-tag">AULA: {{ $clase->aula ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Impreso el: {{ date('d/m/Y H:i:s') }} | KT&U Platform
    </div>

</body>
</html>