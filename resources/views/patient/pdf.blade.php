<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patients List</title>
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
            <div class="text-center org-name">{{ $organization->url }}</div>
            <div class="text-center org-name">{{ $organization->pan_vat_type }} : {{ $organization->pan_vat_number }}
        </div>

            <div class="text-center" style="font-size: 20px;">Patient List</div>
        </div>
    </div>
    <hr>
    @php
        $i = 1;
    @endphp
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>SN</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Age/Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Refered by</th>
                    <th>Performed by</th>
                </tr>
                @foreach ($patients as $patient)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $patient->date }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->age }} {{ $patient->in }}| {{ $patient->gender }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->email }}</td>
                        <td>{{ $patient->referred }}</td>
                        <td>{{ $patient->user->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
