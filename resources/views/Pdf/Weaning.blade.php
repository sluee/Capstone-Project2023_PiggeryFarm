<html>
    <head>
        <title>Pigs Weaning Summary</title>

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

            <img src="{{ public_path('/images/logo.png') }}" style="height: 70px; border-radius: 50px; float: left; margin-right: 10px;" alt="RQR Piggery Farm, Inc.">
            <div style="text-align: left;">
                <strong>RQR Piggey Farm Inc. | Saint Agustine Piggery Farm Inc </strong> <br>
                Pondol, San Agustin, Sagbayan, Bohol <br>
                Tel. No.: 09121244888, 09505514775 <br>
                Pig Weaning Summary
            </div>

        </div>


        <h2 style="padding-bottom: 10pt; border-bottom: 1px solid #333; margin-top:10">Weaning Summary</h2>

        <hr>

        <table style=" width: 100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Sow</th>
                    <th>Boar</th>
                    <th>Date of Breed</th>
                    <th>Actual Date of Farrowing</th>
                    <th>Date of Weaning</th>
                    <th># Pigs Born</th>
                    <th># Pigs Alive</th>
                    <th># Pigs Weaned</th>
                    <th>Remarks</th>
                    </tr>
            </thead>

            <tbody>


                <td style="text-align:right">


                    @foreach ($weaning as $item )
                    <tr>
                        <td style="text-align: center">
                            {{$item->id}}
                        </td>
                        <td style="text-align: left;">
                            {{$item->labors->breeding->sow->sow_no}}
                        </td>
                        <td style="text-align: left;">
                            {{$item->labors->breeding->boar->breed}}
                        </td>
                        <td style="text-align: left;">
                            {{$item->labors->breeding->date_of_breed}}
                        </td>
                        <td>
                            {{$item->labors->actual_date_farrowing}}
                        </td>
                        <td>
                            {{$item->labors->date_of_weaning}}
                        </td>
                        <td>
                            {{$item->labors->no_pigs_born}}
                        </td>
                        <td>
                            {{$item->labors->no_pigs_alive}}
                        </td>
                        <td>
                            {{$item->no_of_pigs_weaned}}
                        </td>
                        <td style="text-align: right">
                            {{$item->remarks}}
                        </td>
                    </tr>

                    @endforeach
                 </td>

            </tbody>

        </table>

    </body>
</html>

