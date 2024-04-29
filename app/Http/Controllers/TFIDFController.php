<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preprocessing;
use App\Models\TfIdf;

class TFIDFController extends Controller
{
    // Menghitung Term Frequency (TF) untuk sebuah dokumen
    public function calculateTF($document)
    {
        $tf = [];
        $words = str_word_count($document, 1, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'); // Menggunakan STR_WORD_COUNT dengan parameter untuk mempertahankan karakter khusus
        $wordCount = array_count_values($words);
        $totalWords = count($words);

        foreach ($wordCount as $word => $count) {
            $tf[$word] = $count / $totalWords;
        }

        return $tf;
    }

    // Menghitung Inverse Document Frequency (IDF) untuk semua dokumen
    public function calculateIDF($documents)
    {
        $idf = [];
        $totalDocuments = count($documents);

        // Menghitung jumlah dokumen yang mengandung setiap kata
        foreach ($documents as $document) {
            $words = str_word_count($document, 1, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $uniqueWords = array_unique($words);

            foreach ($uniqueWords as $word) {
                if (!isset($idf[$word])) {
                    $idf[$word] = 0;
                }

                $idf[$word]++;
            }
        }

        // Menghitung IDF
        foreach ($idf as $word => $count) {
            $idf[$word] = log($totalDocuments / $count);
        }

        return $idf;
    }

    // Menghitung TF-IDF untuk semua dokumen
    public function calculateTFIDF()
    {
        $preprocessings = Preprocessing::all();
        $documents = $preprocessings->pluck('stemmed_text')->toArray();

        $tfidf = [];

        // Menghitung IDF
        $idf = $this->calculateIDF($documents);
        // Menghitung TF-IDF untuk setiap dokumen
        foreach ($preprocessings as $preprocessing) {
            $tf = $this->calculateTF($preprocessing->stemmed_text);
            $tfidf[$preprocessing->id] = [];

            foreach ($tf as $word => $tfValue) {
                $tfidf[$preprocessing->id][$word] = $tfValue * $idf[$word];

                // Simpan hasil TF-IDF ke dalam database
                $tfidfModel = new TfIdf();
                $tfidfModel->preprocessing_id = $preprocessing->id;
                $tfidfModel->word = $word;
                $tfidfModel->tf_idf_score = $tfidf[$preprocessing->id][$word];
                $tfidfModel->save();
            }
        }

        return redirect()->route('tfidf.index')->with('success', 'TF-IDF process completed successfully.');
    }

    // Menampilkan hasil TF-IDF
    public function indexTFIDF()
    {
        $tfidfs = TfIdf::all();
        $preprocessings = Preprocessing::all();
        // Periksa apakah stemmed text kosong atau tidak
        $stemmedTextEmpty = true;
        foreach ($preprocessings as $preprocessing) {
            if ($preprocessing->stemmed_text != null) {
                $stemmedTextEmpty = false; 
                break;
            }
        }
        return view('admin.pages.tf-idf.index', compact('tfidfs', 'stemmedTextEmpty'));
    }
}
