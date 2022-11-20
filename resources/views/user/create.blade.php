<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>家族の家計簿管理アプリ</title>
</head>
<body>
    <h1>家族の家計簿管理アプリ</h1>
    <p>ログイン中のユーザーネーム - {{ Auth::user()->name }}</p>
    <div>
        <p>投稿フォーム</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        <form action="{{ route('management.create') }}" method="post">
            @csrf
            <table>
                <tr>
                    <th><label for="purchase">購入品</label></th>
                    <td><input type="text" id="purchase" name="purchase" placeholder="購入品を入力"></td>
                </tr>
                @error('purchase')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <tr>
                    <th><label for="date">購入日</label></th>
                    <td><input type="date" id="date" name="date"></td>
                </tr>
                @error('date')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <tr>
                    <th><label for="amount_money">金額</label></th>
                    <td><input type="number" id="amount_money" name="amount_money">円</td>
                </tr>
                @error('amount_money')
                <p style="color: red;">{{ $message }}</p>
                @enderror
                <tr>
                    <th><label for="memo">メモ</label><span>140文字まで</span></th>
                    <td><textarea id="memo" type="text" name="memo" placeholder="memoを入力"></textarea></td>
                </tr>
                @error('memo')
                <p style="color: red;">{{ $message }}</p>
                @enderror
            </table>
            <button type="submit">投稿</button>
        </form>
    </div>
</body>
</html>