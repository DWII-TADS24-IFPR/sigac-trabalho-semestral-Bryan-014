@extends('layouts.main')

@section('css-resources')
    @vite(['resources/css/reset.css', 'resources/css/components.css', 'resources/css/header.css', 'resources/css/table.css'])
@endsection

@section('header')
    @include('layouts.navbar')   
@endsection

@section('aside-links')
    @include('layouts.aside')   
@endsection

@section('cont-box')
    <x-bread-crumb page="Horas Cumpridas"/>
    <div>
        <div class="wrapper-inputs">
            <div class="primary-input">
                <div>
                    <select name="curso" id="curso">
                        <option value="">Curso</option>
                        @foreach ($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <p id="response-curso">
                    @error('curso')                        
                        {{$message}}
                    @enderror
                </p>
            </div>
            <div class="primary-input">
                <div>
                    <select name="turma" id="turma" disabled>
                        <option value="">turma</option>
                    </select>
                </div>
                <p id="response-turma">
                    @error('turma')                        
                        {{$message}}
                    @enderror
                </p>
            </div>
        </div>
        <div class="row">
            <center>
                <div id="myChart" style="max-width:700px; height:400px"></div>
            </center>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        let curso_select = document.querySelector('#curso');
        let turma_select = document.querySelector('#turma');
        let valid = false;
        const turmas_por_curso = @json($turmasPorCurso);
        const horasPorTurma = @json($horasPorTurma);

        curso_select.addEventListener('change', e => {
            valid = false;
            turma_select.innerHTML = `<option value="">turma</option>`;
            turmas_por_curso.forEach(tpc => {
                if (curso_select.value == tpc.curso) {
                    tpc.turmas.forEach(turma => {
                        turma_select.innerHTML += `
                            <option value="${turma.id}">${turma.ano}</option>
                        `;
                    });
                    valid = true;
                }
            });
            turma_select.disabled = !valid;
        });

        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawEmptyChart);

        function drawEmptyChart() {
            const data = google.visualization.arrayToDataTable([
                ['Aluno', 'Horas']
            ]);
            const options = {
                title: 'Total de Horas por Aluno',
                hAxis: { title: 'Alunos' },
                vAxis: { title: 'Horas' },
                legend: 'none'
            };
            const chart = new google.visualization.ColumnChart(document.getElementById('myChart'));
            chart.draw(data, options);
        }

        turma_select.addEventListener('change', e => {
            const turmaId = turma_select.value;
            if (!turmaId || !horasPorTurma[turmaId]) return;

            const dataArray = [['Aluno', 'Horas']];
            horasPorTurma[turmaId].forEach(item => {
                dataArray.push([item.nome, item.horas]);
            });

            const data = google.visualization.arrayToDataTable(dataArray);
            const options = {
                title: 'Total de Horas por Aluno',
                hAxis: { title: 'Alunos' },
                vAxis: { title: 'Horas' },
                legend: 'none'
            };

            const chart = new google.visualization.ColumnChart(document.getElementById('myChart'));
            chart.draw(data, options);
        });
    </script>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection