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
    <h2>ユーザー管理画面</h2>
    <form action="{{ route('user.create') }}">
        <button>ユーザーを追加</button>
    </form>
    <h2>ユーザー一覧</h2>
    <div>
    @foreach($users as $user)
        <div style="border: 1px solid black; text-align: center;">
            <p>ユーザーID：{{ $user->id }}</p>
            <p>名前：{{ $user->name }}</p>
            <p>eメール：{{ $user->email }}</p>
            <p>権限：{{ $user->authority }}</p>
            <p>パスワード：{{ $user->password }}</p>
            <div>
                <a href="{{ route('user.update.index', ['userId' => $user->id]) }}">編集</a>
                <form action="{{ route('user.delete', ['userId' => $user->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
</body>
</html>
