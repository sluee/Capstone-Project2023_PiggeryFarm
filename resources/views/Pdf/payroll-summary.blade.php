<html>
    <head>
        <title>Payroll Summary</title>

    </head>
    <style>
        *{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 11pt;
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

            <img src="{{ public_path('images/logo.jpeg') }}" style="height: 70px; border-radius: 50px; float: left; margin-right: 10px;" alt="RQR Piggery Farm, Inc.">
            <div style="text-align: left;">
                <strong>RQR Piggey Farm Inc. | Saint Agustine Piggery Farm Inc </strong> <br>
                Pondol, San Agustin, Sagbayan, Bohol <br>
                Tel. No.: 09121244888, 09505514775 <br>
                Payroll Summary
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Payroll Summary</h2>

        <div>
            <p>Payroll Details: <strong>PAY00{{$payroll->id}}</strong> </p>
            <p>Date Covered: <strong>{{ $formattedDates }}</strong> </p>
            <p>No of Days Worked: <strong>{{$payroll->noOfDaysWorked}}</strong></p>
        </div>



        <hr>

        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Rate</th>
                    <th>Days Worked</th>
                    <th>Total Basis Pay</th>
                    <th>Overtime Hours</th>
                    <th>Overtime Amount</th>
                    <th>Gross Amount</th>
                    <th>Cash Advance</th>
                    <th>Personal Deductions</th>
                    <th>Total Deductions</th>
                    <th>Total Net Amount</th>

                </tr>
            </thead>

            <tbody>


                <td style="text-align:right">


                    @foreach ($payroll->payrollItem as $item )
                    <tr>
                        <td>
                            {{$item->employee->user->firstName}}  {{$item->employee->user->lastName}}
                        </td>
                        <td style="text-align: right">
                            {{$item->employee->position->rate}}
                        </td>
                        <td style="text-align: right">
                            {{$item->daysWorked}}
                        </td>
                        <td style="text-align: right">
                            {{$item->totalBasicPay}}
                        </td>
                        <td style="text-align: right">
                            {{$item->overtimeHours}}
                        </td>
                        <td style="text-align: right">
                            {{$item->overtimeAmount}}
                        </td>
                        <td style="text-align: right">
                            {{$item->grossAmount}}
                        </td>
                        <td style="text-align: right">
                            {{$item->cashAdvance}}
                        </td>
                        <td style="text-align: right">
                            {{$item->personalDeduction}}
                        </td>
                        <td style="text-align: right">
                            {{$item->totalDeductions}}
                        </td>
                        <td style="text-align: right">
                            {{$item->netAmount}}
                        </td>
                    </tr>

                    @endforeach
                 </td>

            </tbody>

        </table>
        <div style="text-align:right">
            <p>Total Payroll: <strong>PhP{{$payroll->total_net_amount}}</strong> </p>

        </div>
    </body>
</html>
