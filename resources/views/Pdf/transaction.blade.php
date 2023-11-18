<html>
    <head>
        <title>Liquidation Transaction Summary</title>

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

            <img src="{{ public_path('images/logo.png') }}" style="height: 70px; border-radius: 50px; float: left; margin-right: 10px;" alt="RQR Piggery Farm, Inc.">
            <div style="text-align: left;">
                <strong>RQR Piggey Farm Inc. | Saint Agustine Piggery Farm Inc </strong> <br>
                Pondol, San Agustin, Sagbayan, Bohol <br>
                Tel. No.: 09121244888, 09505514775 <br>
                Liquidation Transaction Summary
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Financial Transaction Summary</h2>

        <hr>

        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Total Cash</th>
                    <th>Remarks</th>

                    </tr>
            </thead>

            <tbody>


                <td style="text-align:right">


                    @foreach ($transaction as $item )
                    <tr>
                        <td style="text-align: center">
                            {{$item->id}}
                        </td>
                        <td style="text-align: left;">
                            {{$item->date}}
                        </td>
                        <td style="text-align: left;">
                            {{$item->totalCashBalance}}
                        </td>
                        <td style="text-align: center;">
                            {{$item->remarks}}
                        </td>

                    </tr>

                    @endforeach
                 </td>

            </tbody>

        </table>

    </body>
</html>

