<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page{
            margin: 0;

        }
        @media print{
            body {
                /* background:url({{asset("images\/a.jpg")}}); */
                background: url("http://localhost:8000/images/a.jpg") no-repeat   ;
                background-size:contain;
                background-position: center;
                width: 100vw;
                height: 110vh;
                margin: 0;
                padding: 1rem;
            }
            .header{
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
                margin-inline: 50px;
                margin-block: 130px;
            }
        }



    </style>
</head>
<body>
    <div class="header">
       <strong> Nom :  {{$consultation->patient->Nom}} </strong>
       <strong> Prenom :  {{$consultation->patient->Prenom}} </strong>
       <strong> Numero :  {{$consultation->patient->Numero}} </strong>
       <strong> Date consultation :  {{$consultation->Date_consultation}} </strong>
       <strong> Montant :  {{$consultation->paiment->Montant}} DH</strong>
       @if ($consultation->paiment->typepaiment_id=="2")
        <strong> Num Check : {{$consultation->paiment->numerocheck}}</strong>
        <strong> Date Emission : {{$consultation->paiment->date_demission}}</strong>
        @endif
        @if ($consultation->paiment->typepaiment_id=="3")
        <strong>  Date Depot : {{$consultation->paiment->date_depot}}</strong>
        <strong>  Transaction : {{$consultation->paiment->transaction}}</strong>
       @endif
    </div>
</body>
<script>
    window.print()
    window.location.href='/Consultations'
</script>
</html>
