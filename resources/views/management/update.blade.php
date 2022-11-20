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
<h1>家計簿を編集する</h1>
<div>
    <a href="{{ route('management.show') }}">< 戻る</a>
    <p>投稿フォーム</p>
    @if (session('feedback.success'))
    <p style="color: green">{{ session('feedback.success') }}</p>
    @endif
    <form action="{{ route('management.update.put', ['managementId' => $management->id]) }}" method="post">
        @method('PUT')
        @csrf
        <table>
            <tr>
                <th><label for="purchase">購入品</label></th>
                <td><input type="text" id="purchase" name="purchase" value="{{ $management->purchase }}"></td>
            </tr>
            @error('purchase')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <tr>
                <th><label for="purchase">購入日</label></th>
                <td><input type="date" id="date" name="date" value="{{ $management->date }}"></td>
            </tr>
            @error('purchase')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <tr>
                <th><label for="purchase">金額</label></th>
                <td><input type="number" id="amount_money" name="amount_money" value="{{ $management->amount_money }}">円</td>
            </tr>
            @error('amount_money')
            <p style="color: red;">{{ $message }}</p>
            @enderror
            <tr>
                <th><label for="memo">メモ</label><span>140文字まで</span></th>
                <td><textarea id="memo" type="text" name="memo" placeholder="memoを入力">{{ $management->memo }}</textarea></td>
            </tr>
            @error('memo')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </table>
        <button type="submit">編集</button>
    </form>
</div>
</body>
</html>