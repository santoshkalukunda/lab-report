<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $patient->name . '-Bill' }}</title>
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
            border: 0px solid #ffff;
        }

        td,
        th {
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
            text-align: left;
            padding: 4px;
        }

        body {
            margin: 15px 50px;
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
                <img src="{{$organization->logo ? asset('storage/'.$organization->logo) : asset('logo.jpg') }}" width="80px" height="80px">
            </div>
            <div class="text-center" style="font-size: 40px; color:rgb(13, 13, 196);"><b>H</b></div>
            <div class="text-center org-name" style="font-size: 20px;">{{ $organization->name }}</div>
            <div class="text-center org-name">{{ $organization->address }}</div>
            <div class="text-center org-name">{{ $organization->phone }}, {{ $organization->email }}</div>
            <div class="text-center org-name">{{ $organization->url }}</div>
            <div class="text-center org-name">{{ $organization->pan_vat_type }} : {{ $organization->pan_vat_number }}</div>
            <div class="text-center" style="font-size: 16px;"><u>Medical Laboratory Bill</u></div>


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
            $total = 0;
        @endphp
        <div class="table-responsive">
            <table class="table table-hover">

                <tr>
                    <th>Test Name</th>
                    <th class="text-right">Amount</th>

                </tr>
                @foreach ($tests as $test)
                    @foreach ($testreports as $testreport)
                        @if ($test->id == $testreport->test_id)
                            @if ($j < $test->category->id)
                                <tr>
                                    <td colspan="5" class="text-center"><b><u
                                                class="Capitalization">{{ $test->category->name }}
                                                Report</u></b></td>
                                </tr>
                                @php
                                    $j = $test->category->id;
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $testreport->test->name }}</td>
                                <td class="text-right">{{ $testreport->test->rate }}/-</td>
                            </tr>
                            @php
                                $total = $total + $testreport->test->rate;
                            @endphp
                        @endif
                    @endforeach
                @endforeach
                <tr>
                    <td><b>Total Amount</b> </td>
                    <td class="text-right"> <b>{{ $total }}/-</b></td>
                </tr>
                <tr>
                    <td colspan="2"><b>In Word:</b> <span id="words"></span><?php
                        $class_obj = new numbertowordconvertsconver();
                        $convert_number = round($total);
                        echo $class_obj->convert_number($convert_number);
                        ?> Rupees Only </td>
                </tr>

            </table>
        </div>
        <div class="col-md-12 text-right" style="margin-top: 20px; text-transform: capitalize">
            <div>.....................................</div>
            {{ $patient->user->name }}
            <div>Received By</div>
        </div>
    </div>

</body>

</html>

<?php
class numbertowordconvertsconver
{
    function convert_number($number)
    {
        if ($number < 0 || $number > 999999999) {
            throw new Exception('Number is out of range');
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = '';
        if ($giga) {
            $result .= $this->convert_number($giga) . ' Million';
        }
        if ($kilo) {
            $result .= (empty($result) ? ' ' : ' ') . $this->convert_number($kilo) . ' Thousand';
        }
        if ($hecto) {
            $result .= (empty($result) ? ' ' : ' ') . $this->convert_number($hecto) . ' Hundred';
        }
        $ones = [' ', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen'];
        $tens = [' ', ' ', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety'];
        if ($deca || $n) {
            if (!empty($result)) {
                $result .= ' ';
            }
            if ($deca < 2) {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n) {
                    $result .= '-' . $ones[$n];
                }
            }
        }
        if (empty($result)) {
            $result = 'zero';
        }
        return $result;
    }
}
?>
