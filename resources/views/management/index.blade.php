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
    @if (Route::has('login'))
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            @endauth
        </div>
    @endif
    <h1>家族の家計簿管理アプリ</h1>
    @if(!is_null(\Illuminate\Support\Facades\Auth::user()))
    <p>ログイン中のユーザーネーム - {{ Auth::user()->name }}</p>
    @else
    <p>ログインしていません</p>
    @endif
    @if(!is_null(\Illuminate\Support\Facades\Auth::user()) && \Illuminate\Support\Facades\Auth::user()->authority === 1)
    <form action="{{ route('user.show') }}" method="POST">
        <button>ユーザーを管理する</button>
    </form>
    @else
    <p>ユーザー管理の権限はありません</p>
    @endif
    <div>
        <p>投稿フォーム</p>
        @if (session('feedback.success'))
            <p style="color: green">{{ session('feedback.success') }}</p>
        @endif
        @if(!is_null(\Illuminate\Support\Facades\Auth::user()))
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
        @else
        <p>投稿権限がありません</p>
        @endif
    </div>
    <p>ただ今の合計使用金額 ー {{ $total }}円 ー</p>
    <h2>購入品一覧</h2>
    <div>
    @foreach($managements as $management)
        <div style="border: 1px solid black; text-align: center;">
            <p>購入品：{{ $management->purchase }}</p>
            <p>購入日：{{ $management->date }}</p>
            <p>金額：{{ $management->amount_money }}</p>
            <p>メモ：{{ $management->memo }}</p>
            <p>購入者：{{ $management->user->name }}</p>
            @if(!is_null(\Illuminate\Support\Facades\Auth::user()) && \Illuminate\Support\Facades\Auth::id() === $management->user_id)
            <div>
                <a href="{{ route('management.update.index', ['managementId' => $management->id]) }}">編集</a>
                <form action="{{ route('management.delete', ['managementId' => $management->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
            @else
                編集権がありません
            @endif
        </div>
    @endforeach
    </div>
</body>
</html>
