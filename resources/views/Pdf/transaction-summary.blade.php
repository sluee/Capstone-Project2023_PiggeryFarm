<html>
    <head>
        <title>Financial Summary </title>

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
                Tel. No.: 09121244888, 09505514775<br>
               <strong> Financial Liquidation </strong>

            </div>

        </div>


         <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Financial Liquidation for {{$transactions->formattedDate}}</h2>


        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Particular</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>

                </tr>
            </thead>

            <tbody>

                @foreach ($transactions->financialItems as $item )
                <tr>
                    <td>
                        {{$item->fin_id}}
                    </td>
                    <td style="text-align: right">
                        {{$item->debit}}
                    </td>
                    <td style="text-align: right">
                            {{$item->credit}}
                    </td>
                    <td style="text-align: right">
                        {{$item->balance}}
                    </td>
                </tr>


                @endforeach

                <tr>
                    <td colspan="3">Total Cash on Bank</td>
                    <td style="text-align: right">
                        {{$transactions->totalCashBalance}}
                        </td>
                </tr>


                <tr>
                    <td colspan="3">Remarks:</td>
                    <td style="text-align: right">
                        {{$transactions->remarks}}
                        </td>
                </tr>

            </tbody>

        </table>

    </body>
</html>
