<?php
$start = microtime(true);

// Load dataset
$dataset = new \Phpml\Dataset\ArrayDataset($X, $Y);

$clf = new \Phpml\Classification\KNearestNeighbors(3);

function f_per_particle($m, $alpha) {
    global $nfitur, $X, $Y, $clf;
    $total_features = $nfitur;

    // Get the subset of the features from the binary mask
    if (array_sum($m) == 0) {
        $X_subset = $X;
    } else {
        $X_subset = array_filter($X, function ($row) use ($m) {
            return array_intersect_key($row, array_flip(array_keys($m, 1))) == $row;
        });
        $X_subset = array_values($X_subset);
    }

    // Perform classification and store performance in P
    [$xtrain, $xtes, $ytrain, $ytes] = \Phpml\CrossValidation\Split::randomSplitWithIndexes($X_subset, $Y, 0.3);
    $clf->train($xtrain, $ytrain);
    $P = array_filter($clf->predict($xtes), function ($predicted, $i) use ($ytes) {
        return $predicted == $ytes[$i];
    });
    $P = count($P) / count($ytes);

    // Compute for the objective function
    $j = ($alpha * (1.0 - $P) + (1.0 - $alpha) * (1 - (count($X_subset[0]) / $total_features)));
    return $j;
}

function f($x, $alpha = 0.88) {
    global $nfitur;
    $n_particles = count($x);
    $j = [];
    for ($i = 0; $i < $n_particles; $i++) {
        $j[] = f_per_particle($x[$i], $alpha);
    }
    return $j;
}

// Initialize swarm, arbitrary
$options = ['c1' => 0.5, 'c2' => 0.5, 'w' => 0.9, 'k' => 30, 'p' => 2];
// Call instance of PSO
$nsampel = count($X);
$nfitur = count($X[0]);
$dimensions = $nfitur; // dimensions should be the number of features
$optimizer = new \Phpml\Optimization\ParticleSwarmOptimization\BinaryPSO(30, $dimensions, $options);
// Perform optimization
list($cost, $pos) = $optimizer->optimize('f', 100);

// Create two instances of LogisticRegression
$clf = new \Phpml\Classification\KNearestNeighbors(3);
// Get the selected features from the final positions
$X_selected_features = array_filter($X, function ($row) use ($pos) {
    return array_intersect_key($row, array_flip(array_keys($pos, 1))) == $row;
});
$X_selected_features = array_values($X_selected_features);
[$xtrain, $xtes, $ytrain, $ytes] = \Phpml\CrossValidation\Split::randomSplitWithIndexes($X_selected_features, $Y, 0.3);
// Perform classification and store performance in P
$clf->train($xtrain, $ytrain);
$subset_performance = array_filter($clf->predict($xtes), function ($predicted

, $i) use ($ytes) {
    return $predicted == $ytes[$i];
});
$subset_performance = count($subset_performance) / count($ytes);

[$A_train, $A_test, $B_train, $B_test] = \Phpml\CrossValidation\Split::randomSplitWithIndexes($X, $Y, 0.2);
$clf->train($A_train, $B_train);
$clf_predictions = $clf->predict($A_test);
$svm = $clf->score($A_test, $B_test);
$hasilsvm = round($svm * 100, 2);
$hasil = round($subset_performance * 100, 2);

$end = microtime(true);
$waktu = $end - $start;
?>
