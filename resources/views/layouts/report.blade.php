<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Reporte - @yield('title-head', 'Your title here')</title>
        <style>
            body {
                margin: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                font-size: 0.875rem;
                font-weight: normal;
                line-height: 1.5;
                color: #151b1e;           
            }
            .box-header{
                color: #ffffff;
                background-color: #17a2b8 !important;
                border-color: #17a2b8 !important;
            }
            .table {
                display: table;
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                border-collapse: collapse;
            }
            .table-bordered {
                border: 1px solid #c2cfd6;
            }
            thead {
                display: table-header-group;
                vertical-align: middle;
                border-color: inherit;
            }
            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }
            .table th, .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #c2cfd6;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #c2cfd6;
            }
            .table-bordered thead th, .table-bordered thead td {
                border-bottom-width: 2px;
            }
            .table-bordered th, .table-bordered td {
                border: 1px solid #c2cfd6;
            }
            th, td {
                display: table-cell;
                vertical-align: inherit;
            }
            th {
                font-weight: bold;
                text-align: -internal-center;
                text-align: left;
            }
            tbody {
                display: table-row-group;
                vertical-align: middle;
                border-color: inherit;
            }
            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }
            .izquierda{
                float:left;
            }
            .derecha{
                float:right;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')         
                </div>
            </div>
        </div>
        </body>
</html>

