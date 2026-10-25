@php
    $r = $datas['r'];
    $site = general()->title;
    $brand = '#fd5b00';
    $rows = array_filter([
        'Name' => $r['name'] ?? null,
        'Email' => $r['email'] ?? null,
        'Phone' => $r['phone'] ?? null,
        'Subject' => $r['subject'] ?? null,
    ]);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Message - {{ $site }}</title>
</head>
<body style="margin:0;padding:0;background:#f2f3f5;font-family:Arial,Helvetica,sans-serif;color:#333;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f2f3f5;padding:30px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 4px 18px rgba(0,0,0,.06);">

                {{-- Header --}}
                <tr>
                    <td style="background:#1f2024;padding:26px 30px;border-bottom:4px solid {{ $brand }};" align="center">
                        <img src="{{ URL::asset(general()->logo()) }}" alt="{{ $site }}" width="70" style="display:block;width:70px;height:auto;border:0;margin:0 auto 10px;">
                        <div style="color:#ffffff;font-size:20px;font-weight:bold;letter-spacing:.5px;">{{ $site }}</div>
                    </td>
                </tr>

                {{-- Title --}}
                <tr>
                    <td style="padding:30px 30px 10px;">
                        <div style="display:inline-block;background:#fff1e8;color:{{ $brand }};font-size:12px;font-weight:bold;letter-spacing:1px;text-transform:uppercase;padding:5px 12px;border-radius:20px;">New Enquiry</div>
                        <h1 style="margin:14px 0 6px;font-size:22px;color:#1f2024;">You have a new contact message</h1>
                        <p style="margin:0;font-size:14px;color:#777;">Sent from the website contact form on {{ now()->format('d M Y, h:i A') }}</p>
                    </td>
                </tr>

                {{-- Details --}}
                <tr>
                    <td style="padding:20px 30px 0;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #eceef1;border-radius:6px;border-collapse:separate;">
                            @foreach($rows as $label => $value)
                            <tr>
                                <td width="110" style="padding:12px 16px;font-size:13px;color:#888;font-weight:bold;text-transform:uppercase;letter-spacing:.5px;{{ $loop->last ? '' : 'border-bottom:1px solid #eceef1;' }}">{{ $label }}</td>
                                <td style="padding:12px 16px;font-size:15px;color:#1f2024;{{ $loop->last ? '' : 'border-bottom:1px solid #eceef1;' }}">
                                    @if($label == 'Email')
                                        <a href="mailto:{{ $value }}" style="color:{{ $brand }};text-decoration:none;">{{ $value }}</a>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>

                {{-- Message --}}
                <tr>
                    <td style="padding:24px 30px 0;">
                        <div style="font-size:13px;color:#888;font-weight:bold;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;">Message</div>
                        <div style="background:#f8f9fa;border-left:4px solid {{ $brand }};border-radius:4px;padding:16px 18px;font-size:15px;line-height:1.7;color:#333;">
                            @if(!empty($r['message']))
                                {!! nl2br(e($r['message'])) !!}
                            @else
                                <span style="color:#999;font-style:italic;">No message was written.</span>
                            @endif
                        </div>
                    </td>
                </tr>

                {{-- Reply button --}}
                @if(!empty($r['email']))
                <tr>
                    <td style="padding:28px 30px 32px;" align="center">
                        <a href="mailto:{{ $r['email'] }}?subject={{ rawurlencode('Re: '.($r['subject'] ?? '')) }}" style="display:inline-block;background:{{ $brand }};color:#ffffff;text-decoration:none;font-size:15px;font-weight:bold;padding:13px 32px;border-radius:5px;">Reply to {{ $r['name'] ?? 'Customer' }}</a>
                    </td>
                </tr>
                @endif

                {{-- Footer --}}
                <tr>
                    <td style="background:#f8f9fa;border-top:1px solid #eceef1;padding:18px 30px;font-size:12px;color:#999;line-height:1.6;" align="center">
                        This email was sent automatically from the contact form at
                        <a href="{{ url('/') }}" style="color:{{ $brand }};text-decoration:none;">{{ $site }}</a>.<br>
                        &copy; {{ date('Y') }} {{ $site }}. All rights reserved.
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
