<!DOCTYPE html>
@include('layouts.navbar')
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CF Trattativa</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>

        input[type='radio']:after {
            width: 25px;
            height: 25px;
            border-radius: 5px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #ffffff;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 1px solid #000000;
        }

        input[type='radio']:checked:after {
            width: 25px;
            height: 25px;
            border-radius: 5px;
            top: -2px;
            left: -1px;
            position: relative;
            background-color: #de726f;
            content: '\2713';
            padding-left: 5px;
            margin-bottom: -40px;
            color: white;
            display: inline-block;
            visibility: visible;
            border: 1px solid #000000;
        }

        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        @media (min-width: 640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased" style="padding-top: 65px">
<div class="relative flex items-top justify-center min-h-screen py-4 sm:pt-0">
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Produzione</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
    </head>
    <body>
    <table style="width: 80%;height: 50%" class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th class="col-sm-4" scope="col">Bisogno</th>
            <th colspan="10" scope="col">Grado importanza</th>
            <th class="col-sm-1" scope="col">Gestito</th>
            <th class="col-sm-1" scope="col">Voto</th>
        </tr>
        <thead class="thead-dark">
        {{Form::open(array('route' => array('trattativa.salvaTabellaBisogni', $id)))}}
        <tr>
            <th style="text-align: center" scope="col">
                <button class="btn btn-success" type="submit">Salva</button>
                @if($id)
                    <a href="{{route('trattativa.pdf', [$id])}}" target="_blank" type="button"
                       class="bi bi-file-pdf btn btn-danger">PDF</a>
                @endif
            </th>
            <th scope="col">1</th>
            <th scope="col">2</th>
            <th scope="col">3</th>
            <th scope="col">4</th>
            <th scope="col">5</th>
            <th scope="col">6</th>
            <th scope="col">7</th>
            <th scope="col">8</th>
            <th scope="col">9</th>
            <th scope="col">10</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorieImportanza as $categoriaImportanza)
            <tr>
                @if($datiBisogni)
                    <td style="text-align: right">{{$categoriaImportanza->nome}} <a href="#" class="bi bi-info"
                                                                                    data-bs-placement="right"
                                                                                    data-bs-toggle="tooltip"
                                                                                    title="{{$categoriaImportanza->descrizione}}"></a>
                    </td>
                    <td hidden
                        style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 0, true)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 1, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==1, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 2, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==2, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 3, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==3, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 4, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==4, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 5, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==5, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 6, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==6, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 7, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==7, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 8, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==8, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 9, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==9, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 10, $datiBisogni[str_replace(' ', '_', 'im_'.$categoriaImportanza->nome)]==10, array('class'=>'customRadio'))??''}}</td>
                    <td style="text-align: center"> {{Form::select('ge_'.str_replace(' ', '_', $categoriaImportanza->nome), array('0' => 'No', '1' => 'Sì'), $datiBisogni[str_replace(' ', '_', 'ge_'.$categoriaImportanza->nome)], array('class' => 'form-select'))}}</td>
                    @if($datiBisogni['ge_'.str_replace(' ', '_', $categoriaImportanza->nome)])
                        <td style="text-align: center"> {{Form::select('vo_'.str_replace(' ', '_', $categoriaImportanza->nome), range(0,10), $datiBisogni[str_replace(' ', '_', 'vo_'.$categoriaImportanza->nome)], array('class'=> 'form-select'))}}</td>
                    @elseif(!$datiBisogni['ge_'.str_replace(' ', '_', $categoriaImportanza->nome)])
                        <td style="text-align: center"> {{Form::select('vo_'.str_replace(' ', '_', $categoriaImportanza->nome), range(0,10), $datiBisogni[str_replace(' ', '_', 'vo_'.$categoriaImportanza->nome)], array('class'=> 'form-select', 'hidden'))}}</td>
                    @endif
                @else
                    <td style="text-align: right">{{$categoriaImportanza->nome}}</td>
                    <td hidden
                        style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 0, true)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 1)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 2)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 3)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 4)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 5)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 6)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 7)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 8)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 9)}}</td>
                    <td style="text-align: center"> {{Form::radio('im_'.str_replace(' ', '_', $categoriaImportanza->nome), 10)}}</td>
                    <td style="text-align: center"> {{Form::select('ge_'.str_replace(' ', '_', $categoriaImportanza->nome), array('0' => 'No', '1' => 'Sì'), 0, array('class' => 'form-select'))}}</td>
                    <td style="text-align: center"> {{Form::select('vo_'.str_replace(' ', '_', $categoriaImportanza->nome), array('' => '...') + range(1,10), null, array('class'=> 'form-select', 'hidden'))}}</td>
                @endif
                @endforeach
            </tr>
        </tbody>
    </table>
    {{Form::close()}}
    </body>
    </html>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

<script>
    $(document).ready(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>

<script>

    $("select[name^='ge_']").on('change', function () {
        let catName = this.name.substring(3);
        switch (this.value) {
            case "1":
                $('select[name=vo_' + catName.replace(/ /g, "_") + ']').prop("hidden", false);
                break;
            case "0":
                $('select[name=vo_' + catName.replace(/ /g, "_") + ']').prop("hidden", true);
                $('select[name=vo_' + catName.replace(/ /g, "_") + ']').val(0);
                break;
            default:
                $('select[name=vo_' + catName.replace(/ /g, "_") + ']').prop("hidden", true);
        }
    });

</script>
