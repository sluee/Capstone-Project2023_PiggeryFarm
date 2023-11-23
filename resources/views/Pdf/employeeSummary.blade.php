<html>
    <head>
        <title>Employee Summary</title>

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
                Employee Summary
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Employee Summary</h2>

       

        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Rate Per Day</th>

                    </tr>
            </thead>

            <tbody>

                @foreach ($employee as $item )
                <tr>
                    <td style="text-align: center">
                        {{$item->id}}
                    </td>
                    <td style="text-align: center;">
                        {{$item->user->firstName}} {{$item->user->lastName}}
                    </td>
                    <td style="text-align: center;">
                        {{$item->user->address}}
                    </td>
                    <td style="text-align: left;">
                        {{$item->user->gender}}
                    </td>
                    <td style="text-align: left;">
                        {{$item->user->phone}}
                    </td>
                    <td style="text-align: left;">
                        {{$item->user->email}}
                    </td>
                    <td style="text-align: left;">
                        {{$item->position->position}}
                    </td>
                    <td style="text-align: center;">
                        {{$item->position->rate}}
                    </td>

                </tr>

                @endforeach
                 

            </tbody>

        </table>

    </body>
</html>

