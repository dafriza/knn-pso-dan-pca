<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use Phpml\Preprocessing\Normalizer;
class KnnPSO extends CI_Controller
{
    function index()
    {
        // Path file XLS
        $xlsFile = FCPATH."assets/dist/xls/healthcare-dataset-stroke-data-no-missing-value.xls";

        // Membaca file XLS
        $spreadsheet = IOFactory::load($xlsFile);

        // Mengambil data dari sheet pertama
        $worksheet = $spreadsheet->getActiveSheet();

        // Mendapatkan jumlah baris dan kolom
        $totalRows = $worksheet->getHighestRow();
        $totalCols = $worksheet->getHighestColumn();

        // Mendefinisikan fitur yang akan digunakan
        $selectedFeatures = ['gender', 'age', 'hypertension', 'heart_disease', 'ever_married', 'work_type', 'Residence_type', 'avg_glucose_level', 'bmi', 'smoking_status'];

        // Mendapatkan indeks kolom untuk fitur yang dipilih
        $selectedFeatureIndexes = [];
        foreach ($selectedFeatures as $selectedFeature) {
            $selectedFeatureIndexes[] = array_search(
                $selectedFeature,
                $worksheet
                    ->getRowIterator(1)
                    ->current()
                    ->toArray(),
            );
        }

        // Mendapatkan indeks kolom untuk target 'stroke'
        $targetIndex = array_search(
            'stroke',
            $worksheet
                ->getRowIterator(1)
                ->current()
                ->toArray(),
        );

        // Looping untuk membaca data per baris dan melakukan seleksi fitur
        $data = [];
        $target = [];
        for ($row = 2; $row <= $totalRows; $row++) {
            $rowData = [];
            foreach ($selectedFeatureIndexes as $colIndex) {
                $cellValue = $worksheet->getCellByColumnAndRow($colIndex, $row)->getValue();
                $rowData[] = $cellValue;
            }
            $data[] = $rowData;

            $targetValue = $worksheet->getCellByColumnAndRow($targetIndex, $row)->getValue();
            $target[] = $targetValue;
        }

        // Normalisasi fitur
        $normalizer = new Normalizer();
        $normalizedData = $normalizer->fitTransform($data);

        // Split data train dan test (80%:20%)
        $splitRatio = 0.8;
        $splitIndex = (int) ($splitRatio * count($normalizedData));

        $dataTrain = array_slice($normalizedData, 0, $splitIndex);
        $dataTest = array_slice($normalizedData, $splitIndex);

        $targetTrain = array_slice($target, 0, $splitIndex);
        $targetTest = array_slice($target, $splitIndex);

        // Melanjutkan dengan script yang diberikan
        $clf = new Phpml\Classification\KNearestNeighbors(3);

        function f_per_particle($m, $alpha)
        {
            global $dataTrain, $targetTrain, $clf;

            $totalFeatures = count($m);

            if (array_sum($m) == 0) {
                $XSubset = $dataTrain;
            } else {
                $XSubset = [];
                foreach ($dataTrain as $sample) {
                    $subset = [];
                    foreach ($m as $index => $value) {
                        if ($value == 1) {
                            $subset[] = $sample[$index];
                        }
                    }
                    $XSubset[] = $subset;
                }
            }

            // Perform classification and store performance in P
            $xTrainSubset = [];
            $xTestSubset = [];
            $yTrainSubset = [];
            $yTestSubset = [];
            $dataSize = count($XSubset);
            for ($i = 0; $i < $dataSize; $i++) {
                if ($i < 0.7 * $dataSize) {
                    $xTrainSubset[] = $XSubset[$i];
                    $yTrainSubset[] = $targetTrain[$i];
                } else {
                    $xTestSubset[] = $XSubset[$i];
                    $yTestSubset[] = $targetTrain[$i];
                }
            }

            $clf->train($xTrainSubset, $yTrainSubset);
            $P = $clf->predict($xTestSubset);
            $accuracy = accuracy($P, $yTestSubset);

            // Compute for the objective function
            $j = $alpha * (1.0 - $accuracy) + (1.0 - $alpha) * (1 - count($XSubset[0]) / $totalFeatures);
            return $j;
        }

        function f($x, $alpha = 0.88)
        {
            $nParticles = count($x);
            $j = [];
            for ($i = 0; $i < $nParticles; $i++) {
                $j[] = f_per_particle($x[$i], $alpha);
            }
            return $j;
        }

        $options = ['c1' => 0.5, 'c2' => 0.5, 'w' => 0.9, 'k' => 30, 'p' => 2];
        $nsample = count($dataTrain);
        $nfeature = count($dataTrain[0]);
        $dimensions = $nfeature;

        $optimizer = new Phpml\Optimization\ParticleSwarmOptimization(30, $dimensions, $options);
        $optimizer->optimize('f', 100);

        $clf = new Phpml\Classification\KNearestNeighbors(3);
        $XSelectedFeatures = [];
        foreach ($dataTrain as $sample) {
            $subset = [];
            foreach ($optimizer->getBestPosition() as $index => $value) {
                if ($value == 1) {
                    $subset[] = $sample[$index];
                }
            }
            $XSelectedFeatures[] = $subset;
        }

        $clf->train($XSelectedFeatures, $targetTrain);

        $clfPredictions = $clf->predict($dataTest);
        $subsetPerformance = accuracy($clfPredictions, $targetTest);

        function accuracy($predictions, $actuals)
        {
            $correctCount = 0;
            $totalCount = count($predictions);
            for ($i = 0; $i < $totalCount; $i++) {
                if ($predictions[$i] == $actuals[$i]) {
                    $correctCount++;
                }
            }
            return $correctCount / $totalCount;
        }

        // Evaluasi akurasi dan confusion matrix
        $confusionMatrix = [[0, 0], [0, 0]];

        $totalData = count($targetTest);
        for ($i = 0; $i < $totalData; $i++) {
            $predictedClass = $clfPredictions[$i];
            $actualClass = $targetTest[$i];
            $confusionMatrix[$actualClass][$predictedClass]++;
        }

        $accuracy = accuracy($clfPredictions, $targetTest);
        $hasil = round($accuracy * 100, 2);

        echo "Confusion Matrix:\n";
        echo $confusionMatrix[0][0] . "\t" . $confusionMatrix[0][1] . "\n";
        echo $confusionMatrix[1][0] . "\t" . $confusionMatrix[1][1] . "\n";

        echo 'Akurasi: ' . $hasil . "%\n";
    }
}
