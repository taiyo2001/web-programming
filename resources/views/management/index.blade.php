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
                {{-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> --}}
                {{-- <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log out</a> --}}
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

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
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
    <div>
    @foreach($managements as $management)
        <div>
            <p>購入品：{{ $management->purchase }}</p>
            <p>購入日：{{ $management->date }}</p>
            <p>金額：{{ $management->amount_money }}</p>
            <p>メモ：{{ $management->memo }}</p>
            <p>購入者：{{ $management->user->name }}</p>
            <div>
                <a href="{{ route('management.update.index', ['managementId' => $management->id]) }}">編集</a>
                <form action="{{ route('management.delete', ['managementId' => $management->id]) }}" method="post">
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
