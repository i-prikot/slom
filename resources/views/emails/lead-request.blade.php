<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Новая заявка с сайта СЛОМ24</title>
</head>
<body style="font-family: sans-serif; line-height: 1.5; color: #111;">
    <h1 style="font-size: 20px; margin-bottom: 16px;">Новая заявка с сайта СЛОМ24</h1>

    <p><strong>ID заявки:</strong> {{ $leadRequest->id }}</p>
    <p><strong>Телефон:</strong> {{ $leadRequest->phone_display }}</p>

    @if ($leadRequest->name)
        <p><strong>Имя:</strong> {{ $leadRequest->name }}</p>
    @endif

    <p><strong>Источник:</strong> {{ $leadRequest->source }}</p>
    <p><strong>Тип формы:</strong> {{ $leadRequest->form_type }}</p>
    <p><strong>Дата и время:</strong> {{ $leadRequest->created_at->format('d.m.Y H:i') }}</p>
</body>
</html>
