@php
    use Carbon\Carbon;

    $horario1 = Carbon::parse($dados->horas_in);
    $horario2 = Carbon::parse($dados->horas_out);

    $diferencaEmHoras = $horario1->floatDiffInHours($horario2);
@endphp
<center>
    <h1>Declaração de Horas Complementares</h1>
</center>
<p>
    Declaramos, para os devidos fins, que o(a) aluno(a) <b>{{$dados->user->name}}</b> participou da atividade complementar intitulada <b>{{$dados->descricao}}</b>, conforme descrito a seguir:
</p>
<ul>
    <li>
        <b>Descrição da Atividade:</b> {{$dados->comentario}}
    </li>
    <li>
        <b>Data e Horário:</b> Das {{$dados->horas_in}} às {{$dados->horas_out}}, totalizando {{$diferencaEmHoras}} horas
    </li>
</ul>

<br><br><br>

<center>
    ___________________________________________<br>
    <b>Assinatura do Coordenador</b>
</center>
{{-- 




<p><b>Descrição: </b>{{$dados->descricao}}</p>
<p><b>Url: </b>{{$dados->url}}</p>
<p><b>Aluno: </b>{{$dados->user->name}}</p>
@php
    $status = '';
    if ($dados->status == 0) {
        $status = 'Pendente';
    } elseif ($dados->status == 1) {
        $status = 'Aprovado';
    } else {
        $status = 'Recusado';
    }
@endphp
<p><b>Status: </b>{{$status}}</p>
<p><b>Comentário: </b>{{$dados->comentario}}</p>
<p><b>Hora Entrada: </b>{{$dados->horas_in}}</p>
<p><b>Hora Saída: </b>{{$dados->horas_out}}</p> --}}