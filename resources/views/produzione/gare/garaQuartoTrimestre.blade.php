<!DOCTYPE html>
@include('layouts.navbar')
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CF Produzione</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
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
    </head>
    <body>
    <div class="container mt-2">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 14px">
                <th scope="col" class="col-sm-2">Categoria</th>
                <th scope="col" class="col-sm-2">Produzione</th>
                <th scope="col" class="col-sm-2">%</th>
                <th scope="col" class="col-sm-2">Obiettivo Gold</th>
                <th scope="col" class="col-sm-2">Obiettivo Platinum</th>
                <th scope="col" class="col-sm-2">Residuo</th>
            </tr>
            </thead>
            <tbody>
            <tr id="sensible-premiAnnui">
                <th>Premi Annui</th>
                <td>€ {{number_format($premiAnnuiTotGara, 0, ',', '.')}}</td>
                <td>{{number_format(round($premiAnnuiTotGara/150000*100, 2),2, ',', '.')}}%</td>
                <td>€ 150.000</td>
                <td>€ 180.000</td>
                <td id="resPremiAnnui">€ {{number_format(150000-$premiAnnuiTotGara,0, ',', '.')}}</td>
            </tr>
            <tr id="sensible-protection">
                <th>di cui Protection</th>
                <td>€ {{number_format($protectionTotGara, 0, ',', '.')}}</td>
                <td>{{number_format(round($protectionTotGara/45000*100, 2),2, ',', '.')}}%</td>
                <td>€ 45.000</td>
                <td>€ 57.000</td>
                <td id="resProtection">€ {{number_format(45000-$protectionTotGara,0, ',', '.')}}</td>
            </tr>
            <tr id="sensible-puIbridi">
                <th>A.V.C</th>
                <td>€ {{number_format($puIbridiTotGara, 0, ',', '.')}}</td>
                <td>{{number_format(round($puIbridiTotGara/2000000*100, 2),2, ',', '.')}}%</td>
                <td>€ 2.000.000</td>
                <td>€ 2.500.000</td>
                <td id="resPuIbridi">€ {{number_format(2000000-$puIbridiTotGara,0, ',', '.')}}</td>
            </tr>
            <tr id="sensible-dnaPlus">
                <th>DNA Plus</th>
                <td>€ {{number_format($dnaPlusTotGara, 0, ',', '.')}}</td>
                <td>{{number_format(round($dnaPlusTotGara/55000*100, 2),2, ',', '.')}}%</td>
                <td>€ 55.000</td>
                <td>€ 65.000</td>
                <td id="resDnaPlus">€ {{number_format(55000-$dnaPlusTotGara,0, ',', '.')}}</td>
            <tr>
            </tbody>
        </table>
        <table class="table table-bordered mb-5">
            <thead class="thead-dark">
            <tr style="font-size: 14px">
                <th scope="col" class="col-sm-3">Collaboratori</th>
                <th scope="col" class="col-sm-1">PA no Protection</th>
                <th scope="col" class="col-sm-1">Protection</th>
                <th scope="col" class="col-sm-1">AVC</th>
                <th scope="col" class="col-sm-1">DNA Retail</th>
                <th scope="col" class="col-sm-1">DNA Middle</th>
                <th scope="col" class="col-sm-1">Punti Raggiunti</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaCollaboratori as $lc => $collaboratore)
                <tr>
                    <th class="table-success">{{$lc}}</th>
                    <td>{{number_format($collaboratore["PANoProt"], 0, ',', '.')}}</td>
                    <td>{{number_format($collaboratore["Protection"], 0, ',', '.')}}</td>
                    <td>{{number_format($collaboratore["AVC"], 0, ',', '.')}}</td>
                    <td>{{number_format($collaboratore["Retail"], 0, ',', '.')}}</td>
                    <td>{{number_format($collaboratore["Middle"], 0, ',', '.')}}</td>
                    <td>{{number_format($collaboratore["PuntiTot"], 0, ',', '.')}}</td>
                </tr>
            @endforeach
            <tr class="table-warning" style="text-align: end">
                <th>SOMMA RETE</th>
                <td>{{ number_format($totaleRete["PANoProt"], 0, ',', '.')}}</td>
                <td>{{ number_format($totaleRete["Protection"], 0, ',', '.')}}</td>
                <td>{{ number_format($totaleRete["AVC"], 0, ',', '.')}}</td>
                <td>{{ number_format($totaleRete["Retail"], 0, ',', '.')}}</td>
                <td>{{ number_format($totaleRete["Middle"], 0, ',', '.')}}</td>
                <td>{{ number_format($totaleRete["PuntiTot"], 0, ',', '.')}}</td>
            </tr>
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{--                    {!! $productionDanniNoAutos->links() !!}--}}
        </div>
    </div>
    </body>
    </html>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        const premiAnnuiVal = $("#resPremiAnnui").text().substring(2);
        const protectionVal = $("#resProtection").text().substring(2);
        const puIbridiVal = $("#resPuIbridi").text().substring(2);
        const dnaPlusVal = $("#resDnaPlus").text().substring(2);

        if(premiAnnuiVal < 0)
            document.getElementById("sensible-premiAnnui").style.backgroundColor = '#33cc33';
        else
            document.getElementById("sensible-premiAnnui").style.backgroundColor = '#ff9999';

        if(protectionVal < 0)
            document.getElementById("sensible-protection").style.backgroundColor = '#33cc33';
        else
            document.getElementById("sensible-protection").style.backgroundColor = '#ff9999';

        if(puIbridiVal < 0)
            document.getElementById("sensible-puIbridi").style.backgroundColor = '#33cc33';
        else
            document.getElementById("sensible-puIbridi").style.backgroundColor = '#ff9999';

        if(dnaPlusVal < 0)
            document.getElementById("sensible-dnaPlus").style.backgroundColor = '#33cc33';
        else
            document.getElementById("sensible-dnaPlus").style.backgroundColor = '#ff9999';
    })
</script>
