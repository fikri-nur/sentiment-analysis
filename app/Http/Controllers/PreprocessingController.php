<?php

namespace App\Http\Controllers;

use App\Models\Preprocessing;
use App\Http\Requests\StorePreprocessingRequest;
use App\Http\Requests\UpdatePreprocessingRequest;
use App\Models\Dataset;
use Sastrawi\Stemmer\StemmerFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreprocessingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $preprocessings = Preprocessing::all();
        $datasets = Dataset::all();
        return view('admin.pages.preprocessing.cleansing', compact('preprocessings', 'datasets'));
    }

    public function cleansingIndex()
    {
        $preprocessings = Preprocessing::all();
        $datasets = Dataset::all();
        return view('admin.pages.preprocessing.cleansing', compact('preprocessings', 'datasets'));
    }

    public function cleansing()
    {
        $datasets = Dataset::all();

        // Proses data dalam batch
        foreach ($datasets as $dataset) {
            // Pengecekan null atau data tidak valid
            if (!empty($dataset->full_text)) {
                // Mengganti kata berulang seperti "pagi-pagi" menjadi "pagi"
                $cleaned_text = preg_replace('/\b(\w+)(?:-\1)+\b/', '$1', $dataset->full_text);

                $cleaned_text = preg_replace('/\b(\w+)-\1\b/i', '$1', $cleaned_text);

                // Memperbarui ekspresi reguler untuk hanya menghapus tautan URL
                $cleaned_text = preg_replace('/(?:https?|ftp):\/\/[\S]+|www\.[\S]+/', '', $cleaned_text);

                // Menghilangkan karakter yang tidak diinginkan selain emoji
                $cleaned_text = preg_replace('/[^A-Za-z\s]/', '', $cleaned_text);

                // Menghilangkan spasi berlebih
                $cleaned_text = preg_replace('/\s+/', ' ', $cleaned_text);

                // Menghapus spasi tambahan di awal dan akhir teks
                $cleaned_text = trim($cleaned_text);

                // Simpan hasil pembersihan ke dalam tabel preprocessing
                Preprocessing::updateOrCreate(
                    ['dataset_id' => $dataset->id],
                    ['cleaned_text' => $cleaned_text]
                );
            }
        }

        return redirect()->route('preprocessings.index')->with('success', 'Cleansing process completed successfully.');
    }

    public function caseFoldingIndex()
    {
        $preprocessings = Preprocessing::all();
        return view('admin.pages.preprocessing.case-folding', compact('preprocessings'));
    }

    public function caseFolding()
    {
        // Ambil data preprocessing dalam batch
        $preprocessings = Preprocessing::cursor();

        // Proses data dalam batch
        foreach ($preprocessings as $preprocessing) {
            // Pengecekan apakah teks kosong
            if (!empty($preprocessing->cleaned_text)) {
                // Case folding
                $case_folded_text = mb_strtolower($preprocessing->cleaned_text, 'UTF-8');

                // Update kolom case_folded_text
                $preprocessing->update([
                    'case_folded_text' => $case_folded_text
                ]);
            }
        }

        return redirect()->route('preprocessings.case-folding-index')->with('success', 'Case folding process completed successfully.');
    }

    public function tokenizingIndex()
    {
        $preprocessings = Preprocessing::all();
        return view('admin.pages.preprocessing.tokenizing', compact('preprocessings'));
    }

    public function tokenizing()
    {
        $preprocessings = Preprocessing::all();

        foreach ($preprocessings as $preprocessing) {
            // Pengecekan apakah teks kosong
            if (!empty($preprocessing->case_folded_text)) {
                // Tokenisasi teks
                $tokens = explode(' ', $preprocessing->case_folded_text);

                // Tambahkan tanda petik pada setiap token
                $quoted_tokens = array_map(function ($token) {
                    return '"' . $token . '"';
                }, $tokens);

                // Hapus token yang kosong (tanda petik yang tidak memiliki isi)
                $filtered_tokens = array_filter($quoted_tokens);

                // Gabungkan token yang telah ditambahkan tanda petik menjadi satu string dengan pemisah koma
                $tokenized_text = implode(',', $filtered_tokens);

                // Update kolom tokenized_text
                $preprocessing->update([
                    'tokenized_text' => $tokenized_text
                ]);
            }
        }

        return redirect()->route('preprocessings.tokenizing-index')->with('success', 'Tokenizing process completed successfully.');
    }

    public function normalizationIndex()
    {
        $preprocessings = Preprocessing::all();
        return view('admin.pages.preprocessing.normalization', compact('preprocessings'));
    }

    public function normalization()
    {
        // Baca isi file kata acuan
        $wordMap = $this->loadWordMapFromFile(public_path('nlp-source/slang_word_normalization.txt'));

        // Ambil data preprocessing dari database
        $preprocessings = Preprocessing::all();

        foreach ($preprocessings as $preprocessing) {
            // Pengecekan apakah teks kosong
            if (!empty($preprocessing->tokenized_text)) {
                // Normalisasi teks
                $normalizedText = $this->normalizeText($preprocessing->tokenized_text, $wordMap);

                // Update kolom normalized_text
                $preprocessing->update([
                    'normalized_text' => $normalizedText
                ]);
            }
        }

        return redirect()->route('preprocessings.normalization-index')->with('success', 'Normalization process completed successfully.');
    }

    // Fungsi untuk membaca isi file kata acuan
    private function loadWordMapFromFile($filePath)
    {
        $wordMap = [];

        // Cek apakah file ada
        if (File::exists($filePath)) {
            // Baca isi file sebagai JSON
            $content = File::get($filePath);
            $wordMap = json_decode($content, true);
        }

        return $wordMap;
    }

    // Fungsi untuk melakukan normalisasi teks
    private function normalizeText($text, $wordMap)
    {
        // Pisahkan teks menjadi array kata
        $words = explode(',', $text);

        // Hapus tanda petik dari teks
        $words = array_map(function ($word) {
            return str_replace('"', '', $word);
        }, $words);

        // Lakukan normalisasi kata per kata
        foreach ($words as &$word) {
            // Periksa apakah kata ada dalam daftar wordMap
            if (isset($wordMap[$word])) {
                // Jika ada, ganti kata dengan bentuk standar
                $word = $wordMap[$word];
            }
        }

        // Gabungkan menjadi satu kalimat tanpa tanda koma
        $normalizedText = implode(' ', $words);

        // Pisahkan tiap kata menjadi token kembali
        $normalizedText = explode(' ', $normalizedText);

        // Tambahkan tanda petik pada setiap token
        $normalizedText = array_map(function ($word) {
            return '"' . $word . '"';
        }, $normalizedText);

        // Gabungkan token yang telah ditambahkan tanda petik menjadi satu string dengan pemisah koma
        $normalizedText = implode(',', $normalizedText);

        return $normalizedText;
    }

    public function stopwordRemovalIndex()
    {
        $preprocessings = Preprocessing::all();
        return view('admin.pages.preprocessing.stopword-removal', compact('preprocessings'));
    }

    public function stopwordRemoval()
    {
        $preprocessings = Preprocessing::all();

        // Ambil daftar stopword dari file teks
        $stopwords = file(public_path('nlp-source\758_line_stop_word.txt'), FILE_IGNORE_NEW_LINES);

        foreach ($preprocessings as $preprocessing) {
            // Pengecekan apakah teks kosong
            if (!empty($preprocessing->normalized_text)) {
                // Buat pola untuk mencocokkan stop words
                $pattern = '/\b(?:' . implode('|', $stopwords) . ')\b/i';

                // Hapus stop words dari teks menggunakan preg_replace()
                $filtered_text = preg_replace($pattern, '', $preprocessing->normalized_text);

                // Hilangkan tanda petik kosong ("") dari teks
                $filtered_text = str_replace('""', '', $filtered_text);

                // Hilangkan koma-koma yang kosong dari teks
                do {
                    $prev_text = $filtered_text;
                    $filtered_text = str_replace(',,', ',', $filtered_text);
                } while ($prev_text !== $filtered_text);

                // Hapus koma yang mungkin berada di awal atau akhir teks
                $filtered_text = trim($filtered_text, ',');

                // Update kolom stopwords_removed_text
                $preprocessing->update([
                    'stopwords_removed_text' => $filtered_text
                ]);
            }
        }

        return redirect()->route('preprocessings.stopword-removal-index')->with('success', 'Stopword removal process completed successfully.');
    }

    public function stemmingIndex()
    {
        $preprocessings = Preprocessing::all();
        return view('admin.pages.preprocessing.stemming', compact('preprocessings'));
    }

    //Stemming with sastrawi
    public function stemming()
    {
        $preprocessings = Preprocessing::all();

        // Membuat factory untuk stemmer Bahasa Indonesia
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        foreach ($preprocessings as $preprocessing) {
            // Pengecekan apakah teks kosong
            if (!empty($preprocessing->stopwords_removed_text)) {
                // Tokenisasi teks
                $tokens = explode(',', $preprocessing->stopwords_removed_text);

                // Melakukan stemming pada setiap token
                $stemmed_tokens = array_map(function ($token) use ($stemmer) {
                    return '"' . $stemmer->stem($token) . '"';
                }, $tokens);


                // Menggabungkan token yang telah di-stem menjadi teks
                $stemmed_text = implode(',', $stemmed_tokens);

                // echo 'awal: ' . $preprocessing->stopwords_removed_text . '<br>';
                // echo 'akhir: ' . $stemmed_text . '<br>';
                // die;
                // Update kolom stemmed_text
                $preprocessing->update([
                    'stemmed_text' => $stemmed_text
                ]);
            }
        }

        return redirect()->route('preprocessings.stemming-index')->with('success', 'Stemming process completed successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreprocessingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Preprocessing $preprocessing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Preprocessing $preprocessing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePreprocessingRequest $request, Preprocessing $preprocessing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Preprocessing $preprocessing)
    {
        //
    }
}
