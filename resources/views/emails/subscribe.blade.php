<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Активация подписки на новости</title>
</head>
<body>
    <h3>Спасибо за подписку, {{$data['email']}}!</h3>

    <p>
        Перейдите <a href="{{ route('subscribe', $data['token']) }}">по ссылке </a>чтобы завершить процесс!
    </p>
</body>
</html>