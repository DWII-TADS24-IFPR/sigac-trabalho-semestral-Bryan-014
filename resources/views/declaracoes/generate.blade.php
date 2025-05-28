<h1>Declaração de Horas Complementares</h1>
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
<p><b>Hora Saída: </b>{{$dados->horas_out}}</p>