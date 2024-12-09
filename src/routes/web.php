<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WeightManagementController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Controllers\WeightLogController;

// 会員登録画面
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// ログイン画面
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// ログイン処理
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// 体重管理画面（未登録ユーザーは登録画面にリダイレクト）
Route::get('weight-management', [WeightManagementController::class, 'show'])->middleware('auth')->name('weight-management');

// 初期体重登録画面（会員登録後に遷移する）
Route::get('initial-weight', [WeightManagementController::class, 'showInitialWeightForm'])->middleware('auth')->name('initial-weight');

// 目標体重設定の更新ルート
Route::post('update-goal-weight', [WeightTargetController::class, 'update'])->name('update-goal-weight');

// 体重ログの更新
Route::put('update-weight-log/{id}', [WeightLogController::class, 'update'])->name('update-weight-log');

// 体重ログの削除
Route::delete('delete-weight-log/{id}', [WeightLogController::class, 'destroy'])->name('delete-weight-log');

// 初期体重登録処理のためのPOSTルート
Route::post('initial-weight', [WeightManagementController::class, 'storeInitialWeight'])->middleware('auth');

// 目標体重設定画面を表示するルート
Route::get('goal-weight-setting', [WeightTargetController::class, 'showGoalWeightForm'])->name('goal-weight-setting');

// 体重ログを検索するルート
Route::get('search-weight-logs', [WeightLogController::class, 'search'])->name('search-weight-logs');

// 体重ログの追加画面を表示するルート
Route::get('add-weight-log', [WeightLogController::class, 'create'])->name('add-weight-log');

// 体重ログの保存
Route::post('save-weight-log', [WeightLogController::class, 'store'])->name('save-weight-log');
