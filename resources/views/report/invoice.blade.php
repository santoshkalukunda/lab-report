<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Medical Laboratory Report - {{ $patient->name }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <style>
        body {
            margin: 40px 60px;
            font-size: 16px;
        }

        .col-md-6 {
            float: left;
            width: 50%;
        }

        .col-md-2 {
            float: left;
            width: 2%;
        }

        .font-bold {
            font-weight: bold;
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
            font-size: 15px;
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
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-2" style="margin-top: 40px;">
                <img src="{{ $organization->logo ? asset('storage/' . $organization->logo) : asset('microscope.jpg') }}"
                    width="80px" height="80px">
            </div>
            <div class="text-center org-name" style="font-size: 20px;">{{ $organization->name }}</div>
            <div class="text-center org-name">{{ $organization->address }}</div>
            <div class="text-center org-name">{{ $organization->phone }}, {{ $organization->email }}</div>
            <div class="text-center org-name">{{ $organization->url }}</div>
            <div class="text-center org-name">{{ $organization->pan_vat_type }} : {{ $organization->pan_vat_number }}
            </div>
            <div class="text-center" style="font-size: 16px; font-weight:bold;"><u>INVOICE</u></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                Invoice No.: {{ $report->id }} <br>
                Patient ID: {{ $patient->id }} <br>
                <span>Patient Name: <b>{{ $patient->name }}</b> <br></span>
                <span>Address: {{ $patient->address }} <br></span>
                <span>Referred By: {{ $patient->referred }} <br></span>
            </div>
            <div class="col-md-6 text-right">
                Registed Date: {{ $patient->date }} <br>
                <span>Age/Gender: {{ $patient->age }}{{ $patient->in }}
                </span>
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
                    <span>Phone: {{ $patient->phone }}<br></span>
                @endif
                Printed Date/Time: <span>{{ date('Y/m/d') }} <br>
                    {{ date('h:i:sa') }}</span>

            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Test</th>
                    <th class="text-right">Amount</th>

                </tr>
                @php
                    $newCategoryId = '';
                    $newSubCategoryId = '';
                @endphp
                @foreach ($testList as $index => $test)
                    @if ($test['category_id'] != $newCategoryId)
                        <tr>
                            <td colspan="6" class="text-center font-bold">
                                <u>
                                    {{ $test['category_name'] }}
                                </u>

                            </td>
                        </tr>
                    @endif
                    @if ($test['sub_category_id'] != $newSubCategoryId)
                        <tr>
                            <td colspan="6" class="font-bold">
                                {{ $test['sub_category_name'] }}
                            </td>
                        </tr>
                    @endif
                    <tr>

                        <td style="{{ $test['parent_id'] ? 'padding-left:15px;' : '' }}">
                            {{ $test['name'] }}
                        </td>

                        <td class="text-right">{{ number_format($test['rate'], 2) }}</td>


                    </tr>
                    @php
                        $newCategoryId = $test['category_id'];
                        $newSubCategoryId = $test['sub_category_id'];
                    @endphp
                @endforeach
                @php
                    $total = $testList->sum('rate');
                @endphp
                <tr>
                    <td><b>Total Amount</b> </td>
                    <td class="text-right"> <b>{{ number_format($total, 2) }}</b></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Amount in Word:</b> <span id="words"></span><?php
                    $class_obj = new numbertowordconvertsconver();
                    $convert_number = round($total);
                    echo $class_obj->convert_number($convert_number);
                    ?> Rupees Only </td>
                </tr>
            </table>
            {{-- <div class="text-center font-bold">** End of Report ** </div> --}}
        </div>
        <div class="col-md-12 text-right" style="margin-top: 20px; text-transform: capitalize">
            <div>.....................................</div>
            {{ $patient->user->name }}
            <div>{{ $patient->user->council_no }}</div>
            <div>Received By </div>
        </div>
    </div>
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
</body>

</html>
