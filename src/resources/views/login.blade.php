<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h1 class="title">PiGLy</h1>
            <h2 class="subtitle">ログイン</h2>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- メールアドレス -->
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- パスワード -->
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワードを入力" required>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit" class="submit-btn">ログイン</button>
            </form>

            <div class="register-link">
                <a href="{{ route('register') }}">アカウント作成はこちら</a>
            </div>
        </div>
    </div>
</body>
</html>
