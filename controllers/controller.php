<?php

require_once 'models/model.php';

// This is where you'll be putting the function for converting the number into a work and vice versa

class Controller{
    private $model;

    public function __construct(){
        $this->model = new Model();
        $this->default ='';
        $this->numbers = [
            'zero' => 0,
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19,
        ];

        $this->tenths = [
            'twenty' => 20,
            'thirty' => 30,
            'forty' => 40,
            'fifty' => 50,
            'sixty' => 60,
            'seventy' => 70,
            'eighty' => 80, 
            'ninety' => 90
        ];

        $this->words = [
            0 =>'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 =>'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 =>'nineteen',
        ];

        $this->tenthsWords = [
            2 => 'twenty',
            3 => 'thirty',
            4 => 'forty',
            5 => 'fifty',
            6 => 'sixty',
            7 => 'seventy',
            8 => 'eighty', 
            9 => 'ninety'
        ];

        $this->errMessage = 'Error: invalid Input please enter a valid number!';
    }

    public function index(){
        $formTitle = 'Word 📝 to Number 🔢 Converter';
        $firstInputFieldType = 'text';
        $secondInputFieldType = 'number';
        $firstInputFieldPlaceholder = 'Input Word Here';
        $secondInputFieldPlaceholder = 'Equivalent Number Value';
        $change = 'Try Number to Word Converter';
        $this->default = 'wordToNumber';

        require_once $_SERVER['DOCUMENT_ROOT'] . '/chanz/views/view.php';
        return;
    }

    public function PHPToUSDConverter ($val){
        $url = 'https://v6.exchangerate-api.com/v6/11d6c8ed368bdf2aa929a82a/latest/PHP';
        $response = file_get_contents($url);
        $data = json_decode($response);

        return $val * $data->conversion_rates->USD;
    }

    public function secondaryNumberToWord($val){
        // echo $val;
        $words = '';

        if($val < 20){
            $words .= $this->words[$val];
        }elseif ($val < 100){
            $words .= $this->tenthsWords[floor($val / 10)];

            if($val % 10){
                $words .= '-'.$this->words[$val % 10];
            }
        }elseif ($val < 1000){
            $words .= $this->words[floor($val/100)].' hundred';

            if ($val % 100){
                $words .= ' and '.$this->secondaryNumberToWord($val % 100);
            }
        }elseif ($val < 10000){
            $words .= $this->words[floor($val/1000)].' thousand';

            if ($val % 1000){
                $words .= ' '.$this->secondaryNumberToWord($val % 1000);
            }
        }elseif ($val < 100000){
            $words .= $this->secondaryNumberToWord(floor($val / 1000)).' thousand';

            if ($val % 1000){
                $words .= ' '.$this->secondaryNumberToWord($val % 1000);
            }
        }elseif ($val < 1000000){
            $words .= $this->secondaryNumberToWord(floor($val / 1000)).' thousand';

            if ($val % 1000){
                $words .= ' '.$this->secondaryNumberToWord($val % 1000);
            }
        }else{
            $this->errMessage = 'Error: Number should not be greater than 1 million';
        }
        
        return $words;
    }

    public function checkValidWord($word){
        $word = preg_replace('/[^A-Za-z0-9]/', '', $word);

        $word = str_split(strtolower($word));

        $number ='';
        $arr = [];

        foreach($word as $char){
            $number .= $char;
            $invalid = TRUE;

            if(array_key_exists($number, $this->numbers) || array_key_exists($number, $this->tenths) || $number === 'hundred' || $number === 'thousand' || $number === 'million' || $number === 'and'){
                if ($number === 'and'){
                    $number = '';
                    continue;
                }

                array_push($arr, $number);
                $number = '';
                $invalid = FALSE;
            }
        }

        if($invalid){
            $this->errMessage = 'Error: Invalid Input please enter a valid number!';
            return [];
        }else{
            $this->errMessage = '';
            return $arr;
        }
    }

    public function wordToNumber ($word = 'zero') {
        // * For loop
        $total = 0;
        $number = 0;
        // * For website
        $formTitle = 'Word 📝 to Number 🔢 Converter';
        $firstInputFieldType = 'text';
        $secondInputFieldType = 'number';
        $firstInputFieldPlaceholder = 'Input Word Here';
        $secondInputFieldPlaceholder = 'Equivalent Number Value';
        $change = 'Try Number to Word Converter 🔄';
        $this->default = 'wordToNumber';
        
        $words = $this->checkValidWord($word);

        foreach($words as $word){
            if(array_key_exists($word, $this->numbers)){
                $number += $this->numbers[$word];
            }elseif(array_key_exists($word, $this->tenths)){
                $number += $this->tenths[$word];
            }elseif($word === 'hundred'){
                $number *= 100;
            }elseif($word === 'thousand'){
                $total += $number * 1000;
                $number = 0;
            }elseif($word === 'million'){
                $total += $number * 1000000;
                $number = 0;
            }
        }

        $total += $number;
        $value = $total;

        $numberInUSD = $this->PHPToUSDConverter($total);
       
        require_once $_SERVER['DOCUMENT_ROOT'] . '/chanz/views/view.php';

        return;
    }
    
    public function numberToWord($number = 0) {
        $this->errMessage = '';
        $formTitle = 'Number 🔢 to Word 📝 Converter';
        $firstInputFieldType = 'number';
        $secondInputFieldType = 'text';
        $firstInputFieldPlaceholder = 'Input Number Here';
        $secondInputFieldPlaceholder = 'Equivalent Word Value';
        $change = 'Try Word to Number Converter 🔄';
        $this->default = 'numberToWord';

        $words = $this->secondaryNumberToWord($number).' pesos';

        // echo $words;

        $numberInUSD = $this->PHPToUSDConverter($number);

        $value = $words;
        $total = $number;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/chanz/views/view.php';

        return;
    }
}