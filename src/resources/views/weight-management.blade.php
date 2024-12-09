<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重管理</title>
    <link rel="stylesheet" href="{{ asset('css/weight-management.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add-weight-log.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PiGLy</h1>
            <div class="actions">
                <button class="btn" onclick="location.href='{{ route('goal-weight-setting') }}'">目標体重設定</button>
                <button class="btn" onclick="location.href='{{ route('login') }}'">ログアウト</button>
            </div>
        </div>

        <div class="weight-management-card">
            <div class="goal-summary">
                <div class="goal">
                    @if($goalWeight)
                        <p>目標体重: {{ $goalWeight->goal_weight }} kg</p>
                        <p>目標まで: {{ $goalWeight->goal_weight - $latestWeight }} kg</p>
                    @else
                        <p>目標体重が設定されていません</p>
                    @endif
                    <p>最新体重: {{ $latestWeight }} kg</p>
                </div>
            </div>

            <form action="{{ route('search-weight-logs') }}" method="GET" class="search-form">
                @csrf
                <div class="search">
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $start_date ?? '') }}" required>
                    <span class="date-separator">〜</span>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $end_date ?? '') }}" required>
                    <button type="submit" class="btn search-btn">検索</button>
                </div>
            </form>

            <!-- データ追加ボタン -->
            <label for="modal-toggle" class="data-entry-btn">データ登録</label>

            <!-- モーダルウィンドウ -->
            <input type="checkbox" id="modal-toggle" class="modal-toggle">
            <div class="modal">
                <div class="modal-content">
                    <h1>Weight Logを追加</h1>

                    <form action="{{ route('save-weight-log') }}" method="POST">
                        @csrf
                        <label for="date">日付:</label>
                        <input type="date" name="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>

                        <label for="weight">体重:</label>
                        <input type="number" name="weight" step="0.1" required>

                        <label for="calories">摂取カロリー:</label>
                        <input type="number" name="calories" required>

                        <label for="exercise_time">運動時間:</label>
                        <input type="time" name="exercise_time" required>

                        <label for="exercise_content">運動内容:</label>
                        <textarea name="exercise_content"></textarea>

                        <button type="submit" class="btn">登録</button>
                        <label for="modal-toggle" class="btn-close">閉じる</label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
