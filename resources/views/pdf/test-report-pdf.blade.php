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
            <div class="text-center" style="font-size: 20px;">Lab Report</div>


        </div>



    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <span><b>Patient Name:</b> {{ $patient->name }} <br></span>
            <span><b>Address:</b> {{ $patient->address }} <br></span>
            <span><b>Age/Gender:</b> {{ $patient->age }}{{ $patient->in }}
                | @if ($patient->gender == 'M')
                    <span>Male</span><br>
                @endif
                @if ($patient->gender == 'F')
                    <span>Female</span><br>
                @endif
                @if ($patient->gender == 'O')
                    <span>Other</span><br>
                @endif
                @if ($patient->phone)
                    <span><b>Phone:</b> {{ $patient->phone }}<br></span>
                @endif
                @if ($patient->email)
                    <span><b>Email:</b> {{ $patient->email }} <br></span>
                @endif
                <span><b>Referred By:</b> {{ $patient->referred }} <br></span>
        </div>
        <div class="col-md-6 text-right">
            <b>Patient ID:</b> {{ $patient->id }} <br>
            <b>Registed Date:</b> {{ $patient->date }} <br>
            <b>Printed Date:</b> <span>{{ date('Y/m/d') }} <br>
                {{ date('h:i:sa') }}</span>
        </div>
    </div>
    @php
        $i = 1;
    @endphp
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>SN</th>
                    <th>Test Name</th>
                    <th>Result</th>
                    <th>Unit</th>
                    <th>Referrence Range</th>
                    <th>Method</th>
                </tr>
                @foreach ($testreports as $testreport)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $testreport->test->name }}</td>
                        <td>{{ $testreport->result }}</td>
                        <td>{!! $testreport->test->unit !!}</td>
                        <td>{{ $testreport->test->range }}</td>
                        <td>{{ $testreport->remarks }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-12 text-right" style="margin-top: 20px; text-transform: capitalize">
            <div>.....................................</div>
            {{ $patient->user->name }}
            <div>Performed By</div>
        </div>
    </div>
</body>

</html>
