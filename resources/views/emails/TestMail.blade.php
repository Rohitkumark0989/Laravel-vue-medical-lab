<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Email</title>
</head>
<body>
    <h3>Name : {{$details['data']['name']}}</h3>
    <h3>Date : {{$details['data']['date']}}</h3>
    <h3>Age : {{$details['data']['age']}}</h3>
    <h3>Gender : {{$details['data']['gender']}}</h3>

    <h3>Subtotal: {{$details['data']['subtotal']}}</h3>
    @if($details['data']['discount'] > 0 )
        <h3>Discount : {{$details['data']['discount']}}</h3>
    @endif
    <h3>Total : {{$details['data']['total']}}</h3>
</body>
</html>