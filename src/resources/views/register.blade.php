<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="registration-card">
            <h1 class="title">PiGLy</h1>
            <h2 class="subtitle">新規会員登録</h2>
            <p class="step">STEP1 アカウント情報の登録</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!-- 名前 -->
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" placeholder="お名前を入力" value="{{ old('name') }}" required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror

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

                <button type="submit" class="submit-btn">次に進む</button>
            </form>

            <div class="login-link">
                <a href="{{ route('login') }}">ログインはこちら</a>
            </div>
        </div>
    </div>
</body>
</html>
