<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rappel de rendez-vous médical</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .content {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        .appointment-details {
            margin-top: 20px;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 3px;
        }

        .footer {
            margin-top: 20px;
            color: #777777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Rappel de rendez-vous médical</h1>
        <div class="appointment-details">
            <p>Cher(e) {{$patient->Nom}},</p>
            <p>Nous sommes heureux de vous confirmer votre rendez-vous médical à notre clinique .</p>
            <p>Date du rendez-vous : {{$consultation->Date_consultation}}</p>
            <p>Veuillez noter les informations ci-dessus pour votre référence. Si vous avez besoin d'annuler ou de reprogrammer votre rendez-vous, veuillez nous contacter dès que possible.</p>
            <p>Nous sommes impatients de vous accueillir à notre clinique médical et de vous fournir les meilleurs soins possibles.</p>
            <p>Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.</p>
        </div>
        <div class="footer">
            <p>Cordialement,<br> Mouad <br> LamghariClinique <br>Téléphone du cabinet médical : 0626606709<br>E-mail du cabinet médical : lamgharimouad007@gmail.com</p>
        </div>
    </div>
</body>
</html>
