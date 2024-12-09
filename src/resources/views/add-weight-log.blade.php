<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重ログの追加</title>
    <link rel="stylesheet" href="{{ asset('css/add-weight-log.css') }}">
</head>
<body>
    <!-- モーダルウィンドウを表示するためのチェックボックス -->
    <input type="checkbox" id="modal-toggle" class="modal-toggle">
    <!-- モーダルウィンドウ -->
    <div id="weight-log-modal" class="modal">
        <div class="modal-content">
            <h1>Weight Logを追加</h1>

            <!-- 体重ログ追加フォーム -->
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
                <!-- モーダルを閉じる -->
                <label for="modal-toggle" class="btn-close">戻る</label>
            </form>
        </div>
    </div>

    <!-- 開始ボタン -->
    <label for="modal-toggle" class="btn">データ追加</label>
</body>
</html>
