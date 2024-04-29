<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\NaiveBayesController;
use App\Http\Controllers\PreprocessingController;
use App\Http\Controllers\RandomSamplingController;
use App\Http\Controllers\TestDataController;
use App\Http\Controllers\TFIDFController;
use App\Http\Controllers\TrainDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('datasets/import', [DatasetController::class, 'import'])->name('datasets.import');
    Route::get('datasets/clear-all', [DatasetController::class, 'clearAll'])->name('datasets.clear-all');
    Route::resource('datasets', DatasetController::class);
    Route::resource('preprocessings', PreprocessingController::class);



    Route::get('preprocessing/cleansing-index', [PreprocessingController::class, 'cleansingIndex'])->name('preprocessings.cleansing-index');
    Route::get('preprocessing/cleansing', [PreprocessingController::class, 'cleansing'])->name('preprocessings.cleansing');

    Route::get('preprocessing/case-folding-index', [PreprocessingController::class, 'caseFoldingIndex'])->name('preprocessings.case-folding-index');
    Route::get('preprocessing/case-folding', [PreprocessingController::class, 'caseFolding'])->name('preprocessings.case-folding');
    
    Route::get('preprocessing/tokenizing-index', [PreprocessingController::class, 'tokenizingIndex'])->name('preprocessings.tokenizing-index');
    Route::get('preprocessing/tokenizing', [PreprocessingController::class, 'tokenizing'])->name('preprocessings.tokenizing');
    
    Route::get('preprocessing/normalization-index', [PreprocessingController::class, 'normalizationIndex'])->name('preprocessings.normalization-index');
    Route::get('preprocessing/normalization', [PreprocessingController::class, 'normalization'])->name('preprocessings.normalization');
    
    Route::get('preprocessing/stopword-removal-index', [PreprocessingController::class, 'stopwordRemovalIndex'])->name('preprocessings.stopword-removal-index');
    Route::get('preprocessing/stopword-removal', [PreprocessingController::class, 'stopwordRemoval'])->name('preprocessings.stopword-removal');
    
    Route::get('preprocessing/stemming-index', [PreprocessingController::class, 'stemmingIndex'])->name('preprocessings.stemming-index');
    Route::get('preprocessing/stemming', [PreprocessingController::class, 'stemming'])->name('preprocessings.stemming');

    Route::get('/index-tfidf', [TFIDFController::class, 'indexTFIDF'])->name('tfidf.index');
    Route::get('/calculate-tfidf', [TFIDFController::class, 'calculateTFIDF'])->name('tfidf.calculate');
    
    Route::get('/random-sampling', [RandomSamplingController::class, 'randomSampling'])->name('random-sampling');

    Route::get('data/train-index-70', [TrainDataController::class, 'index70'])->name('data.train');
    Route::get('data/train-index-80', [TrainDataController::class, 'index80'])->name('data.train-80');
    Route::get('data/train-index-90', [TrainDataController::class, 'index90'])->name('data.train-90');

    Route::get('data/test-index', [TestDataController::class, 'index'])->name('data.test');

    Route::get('pemodelan/naive-bayes/index', [NaiveBayesController::class, 'index'])->name('naive-bayes.index');
    Route::get('pemodelan/naive-bayes/train', [NaiveBayesController::class, 'trainModel'])->name('naive-bayes.train');
    Route::post('pemodelan/naive-bayes/predict', [NaiveBayesController::class, 'predictSentiment'])->name('naive-bayes.predict');
    Route::get('pemodelan/naive-bayes/test', [NaiveBayesController::class, 'testModel'])->name('naive-bayes.test');
});