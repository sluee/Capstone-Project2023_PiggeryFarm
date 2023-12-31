<html>
    <head>
        <title>Payroll History</title>

    </head>
    <style>
        *{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 13pt;
        }

        h1{
            font-size: 22pt;

        }

        table{
            border-collapse: collapse;

        }
        table th, table td{
            padding:2px;
            border: 1px solid #333;
        }

    </style>

    <body>
        <div style="text-align: center; padding-bottom: 12pt; border-bottom: 2px solid #333">

            <img src="{{ public_path('images/logo.png') }}" style="height: 70px; border-radius: 50px; float: left; margin-right: 10px;" alt="RQR Piggery Farm, Inc.">
            <div style="text-align: left;">
                <strong>RQR Piggey Farm Inc. | Saint Agustine Piggery Farm Inc </strong> <br>
                Pondol, San Agustin, Sagbayan, Bohol <br>
                Tel. No.: 09121244888, 09505514775
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Payroll History</h2>

        {{-- <div>
            <p style="display: inline-block; margin-right: 220px; margin-bottom:1" ><span style="font-size: 18px" >Invoice Details: </span> <strong> 0000{{$sale->id}}</strong></p>
            <p style="display: inline-block; margin-right: 20px; margin-bottom:1"><span style="font-size: 18px">Mode of Payment: </span><strong>{{$sale->payment}}</strong> </p>

            <p style="display: inline-block; margin-right: 200px; margin-bottom:1" ><span style="font-size: 18px" >Customer: </span> <strong>{{$sale->customers->name}}</strong></p>
            <p style="display: inline-block; margin-right: 10px;margin-bottom:1"><span style="font-size: 18px">Quantity of Pigs: </span><strong>{{$totalPigs}} pc/s</strong> </p>

            <p style="display: inline-block; margin-right: 200px; margin-bottom:1" ><span style="font-size: 18px" >Date: </span> <strong>{{ $sale->created_at->format('F j, Y') }}</strong></p>
            <p style="display: inline-block; margin-right: 10px; margin-bottom:1"><span style="font-size: 18px">Remarks: </span><strong> {{$sale->remarks}}</strong> </p>
        </div> --}}


        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Payroll</th>
                    <th>Date Covered</th>
                    <th>Days Worked</th>
                    <th>Total Gross Pay</th>
                    <th>Total Deductions</th>
                    <th>Total Net Amount</th>

                </tr>
            </thead>

            <tbody>

                @foreach ($payroll as $item )
                <tr>
                    <td>
                        PAY00{{$item->id}}
                    </td>
                    <td style="text-align: cemter">
                        {{ $item->formattedPeriod }}
                    </td>
                    <td style="text-align: right">
                            {{$item->noOfDaysWorked}}
                    </td>
                    <td style="text-align: right">
                            {{$item->total_gross_amount}}
                    </td>
                    <td style="text-align: right">
                            {{$item->total_deductions_amount}}
                    </td>
                    <td style="text-align: right">
                            {{$item->total_net_amount}}
                    </td>
                </tr>

                @endforeach
                

            </tbody>

        </table>
    </body>
</html>
