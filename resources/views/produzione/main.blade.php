<!DOCTYPE html>
@include('layouts.navbar')
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
<body style="padding-top: 65px" class="antialiased">
<div class="row">
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
    <input hidden type="text" id="valPremiAnnui" value={{$premiAnnuiTot}} />
    <input hidden type="text" id="residuoPremiAnnui" value={{$obiettiviAnnui['ob_pa']-$premiAnnuiTot}} />
    <input hidden type="text" id="valProtection" value={{$protectionTot}} />
    <input hidden type="text" id="residuoProtection" value={{$obiettiviAnnui['ob_protection']-$protectionTot}} />
    <input hidden type="text" id="valPuIbridi" value={{$puIbridiTot}} />
    <input hidden type="text" id="residuiPuIbridi" value={{$obiettiviAnnui['ob_avc']-$puIbridiTot}} />
    <input hidden type="text" id="valDnaRetail" value={{$dnaRetailTot}} />
    <input hidden type="text" id="residuoDnaRetail" value={{$obiettiviAnnui['ob_dna_retail']-$dnaRetailTot}} />
    <input hidden type="text" id="valDnaMiddleMarket" value={{$dnaMiddleMarketTot}} />
    <input hidden type="text" id="residuoDnaMiddleMarket"
           value={{$obiettiviAnnui['ob_dna_middle']-$dnaMiddleMarketTot}} />
    <input hidden type="text" id="valRca" value={{$rcaTot}} />
    <input hidden type="text" id="residuoRca" value={{$obiettiviAnnui['ob_rca']-$rcaTot}} />

    <div class="container-fluid" style="font-size: 18px">
               <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">Premi Annui</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="background-color: #718096; color: white; " class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="premiAnnuiChart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable id="1_obPaNoProt">{{ number_format($obiettiviAnnui['ob_pa'], 0, ',', '.')}}</th>
                <th>€ {{ number_format($premiAnnuiTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($premiAnnuiTot/$obiettiviAnnui['ob_pa']*100, 2),2, ',', '.')}}%</th>
                <th>€ {{number_format(($obiettiviAnnui['ob_pa']-$premiAnnuiTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
           <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">di cui Protection</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="protectionChart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable id="2_obProt">{{ number_format($obiettiviAnnui['ob_protection'], 0, ',', '.')}}</th>
                <th>€ {{ number_format($protectionTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($protectionTot/$obiettiviAnnui['ob_protection']*100, 2),2, ',', '.')}}%</th>
                <th>€ {{number_format(($obiettiviAnnui['ob_protection']-$protectionTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">Raccolta A.V.C</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="raccoltaAVCchart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable id="3_obAvc">{{ number_format($obiettiviAnnui['ob_avc'], 0, ',', '.')}}</th>
                <th>€ {{ number_format($puIbridiTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($puIbridiTot/$obiettiviAnnui['ob_avc']*100, 2),2, ',', '.')}}%</th>
                <th>€ {{number_format(($obiettiviAnnui['ob_avc']-$puIbridiTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">DNA Retail</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="dnaRetailChart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable
                    id="5_obDnaRetail">{{ number_format($obiettiviAnnui['ob_dna_retail'], 0, ',', '.')}}</th>
                <th>€ {{ number_format($dnaRetailTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($dnaRetailTot/$obiettiviAnnui['ob_dna_retail']*100, 2),2, ',', '.')}}%</th>
                <th id="residuoDnaRetail">
                    € {{number_format(($obiettiviAnnui['ob_dna_retail']-$dnaRetailTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">DNA Middle Market</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="dnaMiddleMarketChart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable
                    id="4_obDnaMiddle">{{ number_format($obiettiviAnnui['ob_dna_middle'], 0, ',', '.')}}</th>
                <th>€ {{ number_format($dnaMiddleMarketTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($dnaMiddleMarketTot/$obiettiviAnnui['ob_dna_middle']*100, 2),2, ',', '.')}}%
                </th>
                <th>€ {{number_format(($obiettiviAnnui['ob_dna_middle']-$dnaMiddleMarketTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">RCA</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                <th rowspan="2">
                    <div class="chart-container" style="position: relative;width:80px; margin:auto">
                        <canvas id="rcaChart"></canvas>
                    </div>
                </th>
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th contenteditable id="6_obrca">{{ number_format($obiettiviAnnui['ob_rca'], 0, ',', '.')}}</th>
                <th id="valRca">€ {{ number_format($rcaTot, 0, ',', '.')}}</th>
                <th>{{number_format(round($rcaTot/$obiettiviAnnui['ob_rca']*100, 2),2, ',', '.')}}%</th>
                <th id="residuoRca">€ {{number_format(($obiettiviAnnui['ob_rca']-$rcaTot), 0, ',', '.')}}</th>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr style="font-size: 18px">
                <th colspan="5" style="text-align: center" scope="col" class="col-sm">Incassi Retail</th>
            </tr>
            </thead>
            <tbody>
            <tr style="text-align: center">
                <th style="color: white; background-color: #718096" class="col-sm-3">Obiettivo</th>
                <th style="background-color: #00B309; color: white;" class="col-sm-3">Raccolta</th>
                <th style="background-color: #718096; color: white" class="col-sm-3">%</th>
                <th style="background-color: #DF0030; color: white" class="col-sm-3">Residuo</th>
                {{--                <th rowspan="2">--}}
                {{--                    <div class="chart-container" style="position: relative;width:5vw; margin:auto">--}}
                {{--                        <canvas id="incassiRetailChart"></canvas>--}}
                {{--                    </div>--}}
                {{--                </th>--}}
            </tr>
            <tr style="text-align: center; background-color: #cbd5e0">
                <th>€ 1.782.000</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </tbody>
        </table>
    </div>

    </body>
    </html>

</div>

</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

<script>
    // <block:setup:1>
    const premiAnnuiVal = $("#valPremiAnnui").val();
    const premiAnnuiResVal = $("#residuoPremiAnnui").val();

    const DATA_COUNT = 5;
    const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};
    const data = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [premiAnnuiVal, premiAnnuiResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };
    // </block:setup>
    // <block:setup:2>
    const protectionVal = $("#valProtection").val();
    const protectionResVal = $("#residuoProtection").val();

    const data2 = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [protectionVal, protectionResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };
    // </block:setup>
    // <block:setup:3>

    const puIbridiVal = $("#valPuIbridi").val();
    const puIbridiResVal = $("#residuiPuIbridi").val();

    const data3 = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [puIbridiVal, puIbridiResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };
    // <block:setup:3>

    const dnaRetailVal = $("#valDnaRetail").val();
    const dnaRetailResVal = $("#residuoDnaRetail").val();

    const data4 = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [dnaRetailVal, dnaRetailResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };

    // <block:setup:3>

    const dnaMiddleMarketVal = $("#valDnaMiddleMarket").val();
    const dnaMiddleMarketResVal = $("#residuoDnaMiddleMarket").val();

    const data5 = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [dnaMiddleMarketVal, dnaMiddleMarketResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };

    // <block:setup:3>

    const rcaVal = $("#valRca").val();
    const rcaResVal = $("#residuoRca").val();

    const data6 = {
        labels: [
            'Raccolta',
            'Residuo',
        ],
        datasets: [{
            data: [rcaVal, rcaResVal],
            backgroundColor: [
                'rgb(0,199,9)',
                'rgb(248,0,53)',
            ],
            hoverOffset: 4
        }]
    };

    // <block:config:0>
    const config1 = {
        type: 'doughnut',
        data: data,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Premi Annui',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };
    const config2 = {
        type: 'doughnut',
        data: data2,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Protection',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };
    const config3 = {
        type: 'doughnut',
        data: data3,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'Raccolta A.V.C',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };
    // </block:config>
    const config4 = {
        type: 'doughnut',
        data: data4,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'DNA Retail',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };
    // </block:config>
    const config5 = {
        type: 'doughnut',
        data: data5,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'DNA Middle Market',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };
    // </block:config>
    const config6 = {
        type: 'doughnut',
        data: data6,
        options: {
            plugins: {
                title: {
                    display: false,
                    text: 'RCA',
                },
                legend: {
                    display: false,
                    position: 'bottom',
                },
            }
        }
    };

    module.exports = {
        actions: [],
        config1: config1,
        config2: config2,
        config3: config3,
        config4: config3,
        config5: config3,
        config6: config3,
    };
</script>
<script>
    const premiAnnuiChart = new Chart(
        document.getElementById('premiAnnuiChart'),
        config1
    );
    const protectionChart = new Chart(
        document.getElementById('protectionChart'),
        config2
    );
    const raccoltaAVCchart = new Chart(
        document.getElementById('raccoltaAVCchart'),
        config3
    );
    const dnaRetailChart = new Chart(
        document.getElementById('dnaRetailChart'),
        config4
    );
    const dnaMiddleMarketChart = new Chart(
        document.getElementById('dnaMiddleMarketChart'),
        config5
    );
    const rcaChart = new Chart(
        document.getElementById('rcaChart'),
        config6
    );
</script>

<script>

    $("th").blur(function () {
        var dataType = this.id.charAt(0);

        if (dataType == 1) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoPaNoProt', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        } else if (dataType == 2) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoProt', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        } else if (dataType == 3) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoAvc', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        } else if (dataType == 4) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoDnaMiddle', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        } else if (dataType == 5) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoDnaRetail', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        } else if (dataType == 6) {
            var tdValue = $(this).text();
            $.ajax({
                url: '/updateObiettivoAnnuoRca', // This is what I have updated
                type: "GET",
                data: {tdValue}
            }).done(function (msg) {
                //
            });
        }
    });
</script>




