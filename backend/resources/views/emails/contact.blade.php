<h2>Новое обращение с сайта AgroForward</h2>

<table style="border-collapse:collapse;width:100%;max-width:600px">
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold;width:140px">Имя</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->name }}</td>
    </tr>
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Email</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->email }}</td>
    </tr>
    @if($contactMessage->phone)
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Телефон</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->phone }}</td>
    </tr>
    @endif
    @if($contactMessage->company)
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Компания</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->company }}</td>
    </tr>
    @endif
    @if($contactMessage->subject)
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Тема</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->subject }}</td>
    </tr>
    @endif
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Сообщение</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{!! nl2br(e($contactMessage->message)) !!}</td>
    </tr>
    <tr>
        <td style="padding:8px 12px;border:1px solid #ddd;font-weight:bold">Дата</td>
        <td style="padding:8px 12px;border:1px solid #ddd">{{ $contactMessage->created_at->format('d.m.Y H:i') }}</td>
    </tr>
</table>
