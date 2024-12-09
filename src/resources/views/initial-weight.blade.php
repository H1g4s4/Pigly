<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 - 初期体重登録</title>
    <link rel="stylesheet" href="{{ asset('css/initial-weight.css') }}">
</head>
<body>
    <div class="container">
        <div class="registration-card">
            <h1 class="title">PiGLy</h1>
            <h2 class="subtitle">新規会員登録</h2>
            <p class="step">STEP2 体重データの入力</p>

            <form action="{{ route('initial-weight') }}" method="POST">
                @csrf
                <!-- 現在の体重 -->
                <label for="current_weight">現在の体重</label>
                <input type="number" id="current_weight" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力" step="0.1" required>
                @error('current_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- 目標の体重 -->
                <label for="goal_weight">目標の体重</label>
                <input type="number" id="goal_weight" name="goal_weight" value="{{ old('goal_weight') }}" placeholder="目標の体重を入力" step="0.1" required>
                @error('goal_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <button type="submit" class="submit-btn">アカウント作成</button>
            </form>

        </div>
    </div>
</body>
</html>
