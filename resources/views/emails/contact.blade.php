<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pesan Kontak Baru</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 8px; background-color: #ffffff; }
        h2 { color: #08236f; border-bottom: 2px solid #08236f; padding-bottom: 8px; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
        th { background-color: #f5f5f7; color: #08236f; width: 150px; }
        .message-box { background-color: #f9f9fb; padding: 15px; border-left: 4px solid #d4af37; margin-top: 15px; border-radius: 4px; }
    </style>
</head>
<body style="background-color: #f4f5f7; padding: 20px 0;">
    <div class="container">
        <h2>Pesan Kontak Baru - BPSMB Surakarta</h2>
        <p>Anda menerima pesan baru melalui formulir kontak website publik BPSMB Surakarta.</p>
        
        <table>
            <tr>
                <th>Nama Pengirim</th>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <th>Email Pengirim</th>
                <td><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
            </tr>
            <tr>
                <th>Subjek</th>
                <td>{{ $data['subject'] }}</td>
            </tr>
        </table>

        <div class="message-box">
            <strong>Isi Pesan:</strong><br>
            {!! nl2br(e($data['message'])) !!}
        </div>
    </div>
</body>
</html>
