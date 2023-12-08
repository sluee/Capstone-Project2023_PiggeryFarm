<html>
    <head>
        <title>Sales Receipt</title>

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


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Sales Receipt</h2>

        <div>
            <p style="display: inline-block; margin-right: 220px; margin-bottom:1" ><span style="font-size: 18px" >Invoice Details: </span> <strong> 0000{{$sale->id}}</strong></p>
            {{-- <p style="display: inline-block; margin-right: 20px; margin-bottom:1"><span style="font-size: 18px">Mode of Payment: </span><strong>{{$sale->payment}}</strong> </p> --}}

            <p style="display: inline-block; margin-right: 200px; margin-bottom:1" ><span style="font-size: 18px" >Customer: </span> <strong>{{$sale->customers->name}}</strong></p>
            <p style="display: inline-block; margin-right: 10px;margin-bottom:1"><span style="font-size: 18px">Quantity of Pigs: </span><strong>{{$totalPigs}} pc/s</strong> </p>

            <p style="display: inline-block; margin-right: 200px; margin-bottom:1" ><span style="font-size: 18px" >Date: </span> <strong>{{ $sale->created_at->format('F j, Y') }}</strong></p>
            <p style="display: inline-block; margin-right: 200ppx; margin-bottom:1"><span style="font-size: 18px">Remarks: </span><strong> {{$sale->remarks}}</strong> </p>
        </div>



        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Pig Weight</th>
                    <th>Rate</th>
                    <th>Total</th>

                </tr>
            </thead>

            <tbody>

                @foreach ($sale->salesItems as $item )
                <tr>
                    <td>
                        {{$item->pig_weight}} kgs.
                    </td>
                    <td style="text-align: right">
                        PhP {{$item->rate}}
                    </td>
                    <td style="text-align: right">
                        PhP {{$item->total}}
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>
        <div style="text-align:right">
            <p>Total Weight: <strong>{{$totalWeight}} kgs.</strong> </p>
            <p>Cash Paid: <strong>PhP{{$sale->is_credit}}</strong> </p>
            <p>Balance: <strong> PhP{{$sale->balance}}</strong></p>
            <p>Total Amount:<strong> PhP{{$sale->total_amount}}</strong></p>
        </div>
    </body>
</html>
