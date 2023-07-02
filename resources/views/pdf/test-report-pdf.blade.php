<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Report</title>
    <style>
         body {
            margin: 40px 60px;
            font-size: 12px;
        }

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
            border: 1px solid #dddddd;
        }

        td,
        th {
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
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
                <img src="{{$organization->logo ? asset('storage/'.$organization->logo) : asset('logo.jpg') }}" width="80px" height="80px">
            </div>
            {{-- <div class="text-center" style="font-size: 40px; color:rgb(13, 13, 196);"><b>H</b></div> --}}
            <div class="text-center org-name" style="font-size: 20px;">{{ $organization->name }}</div>
            <div class="text-center org-name">{{ $organization->address }}</div>
            <div class="text-center org-name">{{ $organization->phone }}, {{ $organization->email }}</div>
            <div class="text-center org-name">{{ $organization->url }}</div>
            <div class="text-center org-name">{{ $organization->pan_vat_type }} : {{ $organization->pan_vat_number }}</div>
            <div class="text-center" style="font-size: 16px;"><u>Medical Laboratory Report</u></div>


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
        @php
            $i = 1;
            $j = 0;
        @endphp
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>Test</th>
                    <th>Result</th>
                    <th>Unit</th>
                    <th>Referrence Range</th>
                    <th>Method</th>
                </tr>
                @foreach ($tests as $test)
                    @foreach ($testreports as $testreport)
                        @if ($test->id == $testreport->test_id)
                            @if ($j < $test->category->id)
                                <tr>
                                    <td colspan="5" class="text-center"><b><u class="Capitalization">{{ $test->category->name }}
                                                Report</u></b></td>
                                </tr>
                                @php
                                    $j = $test->category->id;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $testreport->test->name }}</td>
                                <td><div style="{{$testreport->status == true ? "font-weight: bold; text-decoration-line: underline;" : ""}}">{{ $testreport->result }}</div></td>
                                <td>{!! $testreport->test->unit !!}</td>
                                <td>{{ $testreport->test->range }}</td>
                                <td>{{ $testreport->remarks }}</td>
                            </tr>
                        @endif

                    @endforeach
                @endforeach

            </table>
        </div>
        <div class="col-md-12 text-right" style="margin-top: 20px; text-transform: capitalize">
            <div>.....................................</div>
            {{ $patient->user->name }}
            <div>{{ $patient->user->council_no }}</div>
            <div>Performed By </div>
        </div>
    </div>
</body>

</html>
