<?php

use miloschuman\highcharts\Highcharts;

//var_dump($series);die();
?>
<?= Highcharts::widget([
  'options' => [
    'chart' => ['type' => 'spline'],
    'title' => ['text' => 'Harga pasar'],
    'xAxis' => [
      'categories' => $tanggal //tanggal
    ],
    'yAxis' => [
      'title' => ['text' => 'Harga']
    ],
    // 'series' => [
    //   ['name' => 'Pasar Jatinegara', 'data' => [3500, 2000, 4500, 3000, 5500, 8000]],
    //   ['name' => 'Pasar Kramatjati', 'data' => [2500, 2000, 4500, 3000, 6500, 6000]],
    //   ['name' => 'Pasar Minggu', 'data' => [2800, 3000, 4500, 8000, 6500, 6200]],
    //   ['name' => 'Pasar Kebayoran Lama', 'data' => [3500, 2900, 2500, 3900, 4500, 4000]],
    //   ['name' => 'Pasar Mampang', 'data' => [3500, 4000, 4200, 3600, 4500, 3500]],
    // ],
    'series' => $pasar,
    'plotOptions' => [
      'column' => [
        'dataLabels' => [
          'enabled' => true,
        ],
      ],
    ],
    'credits' => ['enabled' => false]
  ],
]);
