<?php
session_start();
error_reporting(0);

// Hardcoded data for demonstration purposes
$candidates = [
    [
        'position' => 'President',
        'data' => [
            ['cname' => 'Alice', 'tvotes' => 120],
            ['cname' => 'Bob', 'tvotes' => 150]
        ]
    ],
    [
        'position' => 'Vice President',
        'data' => [
            ['cname' => 'Charlie', 'tvotes' => 130],
            ['cname' => 'David', 'tvotes' => 140]
        ]
    ],
    [
        'position' => 'Secretary',
        'data' => [
            ['cname' => 'Eve', 'tvotes' => 110],
            ['cname' => 'Frank', 'tvotes' => 115]
        ]
    ]
];

$i = 0;
foreach ($candidates as $positionData) {
    $pos = $positionData['position'];
    $candidateData = $positionData['data'];

    echo "ctx[$i] = document.getElementsByClassName('myChart')[$i].getContext('2d');
        myChart[$i] = new Chart(ctx[$i], {
            type: 'bar',
            data: {
                labels: ["; 

    foreach ($candidateData as $candidate) {
        echo "'{$candidate['cname']}',";
    }

    echo "],
                datasets: [{
                    label: '$pos',
                    data: [";

    foreach ($candidateData as $candidate) {
        echo "{$candidate['tvotes']},";
    }

    echo "],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        });
    ";
    $i++;
}
?>
