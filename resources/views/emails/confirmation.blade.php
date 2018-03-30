<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового пользователя</title>
</head>
<body>
    <h3>Спасибо за регистрацию, {{$data['name']}}!</h3>

    <p>
        Перейдите <a href="{{ route('confirmation', $data['token']) }}">по ссылке </a>чтобы завершить регистрацию!
    </p>
</body>
</html>