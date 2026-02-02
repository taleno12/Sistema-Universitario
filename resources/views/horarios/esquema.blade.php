@extends('adminlte::page')

@section('title', 'Horario Semanal')

@section('content_header')
    <h1 class="text-indigo"><i class="fas fa-th mr-2"></i>Horario Semanal KT&U</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered text-center m-0">
                <thead class="bg-indigo text-white">
                    <tr>
                        <th style="width: 100px;">Hora</th>
                        @foreach($dias as $dia)
                            <th>{{ $dia }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($horas as $hora)
                    <tr>
                        <td class="align-middle bg-light font-weight-bold">
                            {{ \Carbon\Carbon::parse($hora)->format('g:i A') }}
                        </td>
                        @foreach($dias as $dia)
                            <td class="align-middle" style="height: 80px; width: 150px;">
                                @php
                                    $clase = $horarios->where('dia', $dia)
                                              ->where('hora_inicio', '<=', $hora)
                                              ->where('hora_fin', '>', $hora)
                                              ->first();
                                @endphp

                                @if($clase)
                                    <div class="p-2 shadow-sm rounded bg-light border-left border-indigo">
                                        <small class="text-indigo font-weight-bold d-block">
                                            {{ $clase->asignatura->nombre }}
                                        </small>
                                        <div class="d-flex align-items-center justify-content-center mt-1">
                                            @if($clase->profesor->foto)
                                                <img src="{{ asset('storage/'.$clase->profesor->foto) }}" 
                                                     class="rounded-circle mr-1" width="20" height="20">
                                            @endif
                                            <small class="text-muted">{{ $clase->profesor->nombre }}</small>
                                        </div>
                                        <span class="badge badge-secondary mt-1" style="font-size: 0.7rem;">
                                            {{ $clase->aula }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop