<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH.'vendor/autoload.php';

use Phpml\Classification\C45;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Metric\Accuracy;
use Phpml\Dataset\ArrayDataset;
// use Phpml\Evaluation\Accuracy;
use Phpml\ModelManager;
use Phpml\FeatureExtraction\StopWords;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\SupportVectorMachine\Kernel;

class PsoC4_5Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dataset');
    }

    public function index()
    {
        $dataset = $this->loadDataset(); // Mengambil dataset dari file CSV atau database

        // print_r($dataset);
        $selectedFeatures = $this->featureSelectionPSO($dataset); // Seleksi fitur menggunakan PSO

        $accuracy = $this->c45Classification($dataset, $selectedFeatures); // Klasifikasi menggunakan C4.5

        echo 'Accuracy: ' . $accuracy;
    }

    private function loadDataset()
    {
        // Mengambil dataset dari file CSV atau database
        // $data = [
        //     ['id' => 1, 'gender' => 'Male', 'age' => 65, 'hypertension' => 0, 'heart_disease' => 1, 'ever_married' => 'Yes', 'work_type' => 'Private', 'residence_type' => 'Urban', 'avg_glucose_level' => 248.69, 'bmi' => 29.0, 'smoking_status' => 'formerly smoked', 'stroke' => 1],
        //     // Data lainnya ...
        // ];
        $data = $this->Dataset->getAll();
        // return $data;

        // Konversi dataset menjadi format yang dapat digunakan oleh Php-ML
        $samples = [];
        $targets = [];
        foreach ($data as $row) {
            $samples[] = [$row['age'], $row['hypertension'], $row['heart_disease'], $row['avg_glucose_level'], $row['bmi']];
            $targets[] = $row['stroke'];
        }

        return new ArrayDataset($samples, $targets);
    }

    private function featureSelectionPSO($dataset)
    {
        $samples = $dataset->getSamples();
        $targets = $dataset->getTargets();

        // Implementasi algoritma PSO
        $swarmSize = 30;
        $maxIterations = 100;
        $inertiaWeight = 0.9;
        $cognitiveWeight = 0.5;
        $socialWeight = 0.5;
        $dimensions = count($samples[0]);

        $globalBestPosition = array_fill(0, $dimensions, 0);
        $globalBestFitness = 0;

        $particles = [];
        for ($i = 0; $i < $swarmSize; $i++) {
            $particles[$i]['position'] = array_map(function () {
                return rand(0, 1);
            }, array_fill(0, $dimensions, 0));
            $particles[$i]['velocity'] = array_fill(0, $dimensions, 0);
            $particles[$i]['bestPosition'] = $particles[$i]['position'];
            $particles[$i]['bestFitness'] = 0;
        }

        for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
            foreach ($particles as &$particle) {
                $currentFitness = $this->calculateFitness($particle['position'], $samples, $targets);
                if ($currentFitness > $particle['bestFitness']) {
                    $particle['bestPosition'] = $particle['position'];
                    $particle['bestFitness'] = $currentFitness;

                    if ($currentFitness > $globalBestFitness) {
                        $globalBestPosition = $particle['position'];
                        $globalBestFitness = $currentFitness;
                    }
                }
            }

            for ($i = 0; $i < $swarmSize; $i++) {
                for ($j = 0; $j < $dimensions; $j++) {
                    $random1 = mt_rand() / mt_getrandmax();
                    $random2 = mt_rand() / mt_getrandmax();

                    $cognitiveComponent = $cognitiveWeight * $random1 * ($particles[$i]['bestPosition'][$j] - $particles[$i]['position'][$j]);
                    $socialComponent = $socialWeight * $random2 * ($globalBestPosition[$j] - $particles[$i]['position'][$j]);

                    $particles[$i]['velocity'][$j] = $inertiaWeight * $particles[$i]['velocity'][$j] + $cognitiveComponent + $socialComponent;

                    if ($particles[$i]['velocity'][$j] > 1) {
                        $particles[$i]['velocity'][$j] = 1;
                    } elseif ($particles[$i]['velocity'][$j] < 0) {
                        $particles[$i]['velocity'][$j] = 0;
                    }

                    $particles[$i]['position'][$j] += $particles[$i]['velocity'][$j];
                }
            }
        }

        return $globalBestPosition;
    }

    // private function calculateFitness($position, $samples, $targets)
    // {
    //     $selectedFeatures = array_filter($position, function($value) {
    //         return $value == 1;
    //     });

    //     if (count($selectedFeatures) === 0) {
    //         $subset = $samples;
    //     } else {
    //         $subset = array_map(function($sample) use ($selectedFeatures) {
    //             return array_intersect_key($sample, array_flip($selectedFeatures));
    //         }, $samples);
    //     }

    //     // Melakukan klasifikasi menggunakan KNN pada subset fitur
    //     // ...

    //     return $accuracy; // Mengembalikan performa klasifikasi
    // }
    private function calculateFitness($position, $samples, $targets)
    {
        $selectedFeatures = array_filter($position, function ($value) {
            return $value == 1;
        });

        if (count($selectedFeatures) === 0) {
            $subset = $samples;
        } else {
            $subset = array_map(function ($sample) use ($selectedFeatures) {
                return array_intersect_key($sample, array_flip($selectedFeatures));
            }, $samples);
        }

        // Melakukan klasifikasi menggunakan KNN pada subset fitur
        $xTrain = $subset;
        $yTrain = $targets;

        $classifier = new KNearestNeighbors(3);
        $classifier->train($xTrain, $yTrain);

        $xTest = $subset;
        $yTest = $targets;

        $predictions = $classifier->predict($xTest);
        $accuracy = Accuracy::score($yTest, $predictions);

        return $accuracy; // Mengembalikan performa klasifikasi (misalnya akurasi)
    }

    private function c45Classification($dataset, $selectedFeatures)
    {
        $samples = $dataset->getSamples();
        $targets = $dataset->getTargets();

        if (count($selectedFeatures) === 0) {
            $selectedSamples = $samples;
        } else {
            $selectedSamples = array_map(function ($sample) use ($selectedFeatures) {
                return array_intersect_key($sample, array_flip($selectedFeatures));
            }, $samples);
        }

        $classifier = new C45();
        $classifier->train(new ArrayDataset($selectedSamples, $targets));

        // Melakukan klasifikasi menggunakan C4.5 pada subset fitur terpilih
        // ...

        return $accuracy; // Mengembalikan performa klasifikasi
    }
}
