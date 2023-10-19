<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>


    <p>Bonjour {{ $mailData['name'] }}</p>

    <p>Nous avons le plaisir de vous inviter à joindre la société {{ $mailData['societe'] }} .</p>
    <p>Prière de trouver ci-dessous e-mail et le lien qui redirigent vers l'application pour valider votre profil:</p>

    <p>Email: {{ $mailData['email'] }}</p>

    <p>Lien: http://127.0.0.1:8000/register</p>


    <p>Cordialement.</p>
</body>
</html>
