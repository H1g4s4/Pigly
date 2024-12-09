<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目標体重変更</title>
    <link rel="stylesheet" href="{{ asset('css/goal-weight-setting.css') }}">
</head>
<body>
    <div class="container">
        <div class="weight-management-card">
            <h1>目標体重設定</h1>

            <!-- フォーム開始 -->
            <form action="{{ route('update-goal-weight') }}" method="POST">
                @csrf
                <!-- 目標体重の入力 -->
                <label for="goal_weight">目標体重 (kg)</label>
                <input type="text" id="goal_weight" name="goal_weight" value="{{ old('goal_weight', $goalWeight->goal_weight ?? '') }}" required>
                <!-- バリデーションエラーメッセージ -->
                @error('goal_weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- ボタンを横並びにするためのコンテナ -->
                <div class="button-container">
                    <button type="submit" class="btn">更新</button>
                    <button type="button" onclick="location.href='{{ route('weight-management') }}'" class="btn">戻る</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

