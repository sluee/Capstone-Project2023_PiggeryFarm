<html>
    <head>
        <title>Feeds Purchase Summary</title>

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
                Payroll Summary
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Feeds Purchase</h2>

      

        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Feeds</th>
                    <th>Quantity</th>
                    <th>Feeds Rate</th>
                    <th>Total Amount</th>
                    </tr>
            </thead>

            <tbody>

                @foreach ($feedsPurchase as $item )
                <tr>
                    <td style="text-align: center">
                        {{$item->id}}
                    </td>
                    <td style="text-align: left;">
                        {{$item->formattedPeriod}}
                    </td>
                    <td>
                        {{$item->feeds->categories->name}}
                        <span>
                            {{$item->feeds->supplier->name}}
                        </span>

                    </td>
                    <td style="text-align: right">
                        {{$item->qty}}
                    </td>
                    <td style="text-align: right">
                        {{$item->feeds->categories->price}}
                    </td>
                    <td style="text-align: right">
                        {{$item->totalAmount}}
                    </td>

                </tr>

                @endforeach
                 

            </tbody>

        </table>

    </body>
</html>
