<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Report</title>
    <style>
        .col-md-6 {
            float: left;
            width: 50%;
        }

        .col-md-2 {
            float: left;
            width: 2%;
        }


        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
            margin: 5px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
        }

        body {
            margin: 15px 20px;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .image {
            width: 50px;
            height: 50px;

            background-repeat: no-repeat;
            background-size: contain;
            border: 1px solid red;
        }

        .org-name {
            color: rgb(177, 8, 8);
        }

    </style>
</head>

<body>
    <div>
        <div class="row ">
            <div class="col-md-2" style="margin-top: 40px;">
                <img src="{{ public_path('logo.jpg') }}" width="80px" height="60px">
            </div>
            <div class="text-center" style="font-size: 40px; color:rgb(13, 13, 196);"><b>H</b></div>
            <div class="text-center org-name" style="font-size: 20px;">{{ $organization->name }}</div>
            <div class="text-center org-name">{{ $organization->address }}</div>
            <div class="text-center org-name">{{ $organization->phone }}</div>
            <div class="text-center org-name">{{ $organization->email }}</div>
            <div class="text-center org-name">{{ $organization->url }}</div>
            <div class="text-center" style="font-size: 20px;">Test Report List</div>
        </div>
    </div>
    <hr>
    @php
        $i = 1;
    @endphp
    <div class="row">
        <div class="table-responsive">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>SN</th>
                        <th>Date</th>
                        <th>Patient Name</th>
                        <th>Age/Gender</th>
                        <th>Test Name</th>
                        <th>Result</th>
                        <th>Unit</th>
                        <th>Method</th>
                    </tr>
                    @foreach ($testreports as $testreport)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ date('Y-m-d', strtotime($testreport->created_at)) }}</td>
                            <td>{{ $testreport->patient->name }}</td>
                            <td>{{$testreport->patient->age}}{{ $testreport->patient->in }}| {{ $testreport->patient->gender }}</td>
                            <td>{{ $testreport->test->name }}</td>
                            <td>{{ $testreport->result }}</td>
                            <td>{!! $testreport->test->unit !!}</td>
                            <td>{{ $testreport->remarks }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>
