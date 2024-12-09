<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weight Log 更新</title>
    <link rel="stylesheet" href="{{ asset('css/weight-management.css') }}">
</head>
<body>
    <div class="container">
        <div class="weight-management-card">
            <h1>Weight Log 更新</h1>

            <!-- フォーム開始 -->
            <form action="{{ route('update-weight-log', $weightLog->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- 日付 -->
                <label for="date">日付</label>
                <input type="date" id="date" name="date" value="{{ old('date', $weightLog->date->format('Y-m-d')) }}" required>
                @error('date')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- 体重 -->
                <label for="weight">体重 (kg)</label>
                <input type="text" id="weight" name="weight" value="{{ old('weight', $weightLog->weight) }}" required>
                @error('weight')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- 摂取カロリー -->
                <label for="calories">摂取カロリー</label>
                <input type="number" id="calories" name="calories" value="{{ old('calories', $weightLog->calories) }}" required>
                @error('calories')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- 運動時間 -->
                <label for="exercise_time">運動時間</label>
                <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}" required>
                @error('exercise_time')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- 運動内容 -->
                <label for="exercise_content">運動内容</label>
                <textarea id="exercise_content" name="exercise_content">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
                @error('exercise_content')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <!-- ボタン -->
                <button type="submit" class="btn">更新</button>
                <button type="button" onclick="location.href='{{ route('weight-management') }}'" class="btn">戻る</button>
                <button type="button" onclick="if(confirm('削除してもよろしいですか？')) location.href='{{ route('delete-weight-log', $weightLog->id) }}'" class="btn-delete">ゴミ箱</button>
            </form>
        </div>
    </div>
</body>
</html>
