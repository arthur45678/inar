<?php

namespace App\Services;

//use App\Models\Chart as ChartModel;
//use Mockery\Exception;

//{
//    labels: [],
//    datasets: [
//    {
//        data: [],
//        borderColor: '',
//        label: ''
//    }
//],
//}

class Chart{

//    public $name;

    protected $defaultData = [
        "labels" => [],
        "datasets" => [],
        "options" => [],
        "size" => ['width' => null, 'height' => null]
    ];

    protected $data;

    public function __construct(){
//        $this->name = $name;
        $this->data = $this->defaultData;
    }

    public function labels(array $labels){
        $this->set("labels", $labels);
    }

    public function datasets(array $datasets){
        $this->set("datasets", $datasets);
    }

    public function explode2d(string $data){
        /*
         * First explode string by \n (Enter)
         * Then explode every string in resulted array by " "(space)
         *
         * "50 90
         * 80 110"     ===>   [["data" => [50, 90], "label" => "Set 1"], ["data" => [80, 110], "label" => "Set 2"] ]
         *
         *
         * */

        $datasets = collect(explode(PHP_EOL, $data));
        $mDataset = $datasets->filter(function ($value) {
            return !empty($value); // remove empty string (datark enter arvacnery)
        })->map(function ($datasetString, $i){ return [
            "label" => 'Dataset ' . ($i + 1),
            "data" => array_filter(explode(" ", $datasetString), 'strlen'),
        ]; })->toArray();

        return $mDataset;
    }

    public function implode2d(array $fullData){
        $labels = implode(" ", $fullData["labels"]);
        $rows = collect($fullData["datasets"])->map(function($dataRow){
            return implode(" ", $dataRow["data"]);
        })->toArray();

        $data = implode(PHP_EOL, $rows);

        return compact("labels", "data");
    }

    protected function set(string $key, array $value){
        if(!array_key_exists($key, $this->defaultData)) throw new \Error("Invalid Key provided - $key.");

        $this->data[$key] = $value;
    }

    public function json(){
        return json_encode($this->data, JSON_NUMERIC_CHECK,JSON_UNESCAPED_UNICODE);
    }

    public function array(){
        return $this->data;
    }
}
