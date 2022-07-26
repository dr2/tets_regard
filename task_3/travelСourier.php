<?php

/**
 * перебор массива и поиск совпадений
 * @param array $loopArray массив прогоняемый в цыкле
 * @param int $weight максимальный вес посылки
 * @param array|null $checkArray массив по которому проводится поиск 2ой подходящей посылки
 * @return int
 */
function hitCount(array $loopArray, int $weight, array $checkArray = null) : int  {

    $total = 0;
    $checkArray = $checkArray ?? $loopArray;

    foreach ($loopArray as $key => $count){
        if($key === $weight){
            $total += $count;
            continue;
        }

        if(isset($checkArray[$weight - $key])) {
            $total += ($weight - $key) === $key ? floor($count / 2) : min($checkArray[$weight - $key], $count);
            unset($loopArray[$weight - $key], $loopArray[$key], $checkArray[$weight - $key], $checkArray[$key]);
        }
    }

    return $total;
}

/**
 * Расчёт максимального количества поездок курьера
 * @param array $boxes все виды посылок
 * @param int $weight максимальный вес посылки
 * @return int
 */
function getResult(array $boxes, int $weight) : int {

    //проверяем вес четность
    $isEven = !($weight % 2);
    //четные числа
    $even = [];
    //нечетные числа
    $odd = [];

    foreach ($boxes as $box) {
        if($box % 2) {
            $odd[$box] = isset($odd[$box]) ? $odd[$box] + 1 : 1;
        }else{
            $even[$box] = isset($even[$box]) ? $even[$box] + 1 : 1;
        }
    }

    $total = 0;

    if($isEven) {
        //Если сложить два четных числа, получится четное число
        $total += hitCount($even, $weight);
        //Если сложить два нечетных числа, получится четное число
        $total += hitCount($odd, $weight);
    } else {
        //Если сложить четное число с нечетным, получится нечетное
        $total += hitCount($odd, $weight, $even);
    }

    return $total;
}

// первые входные данные
$boxes = [1, 2, 1, 5, 1, 3, 5, 2, 5, 5];
$weight = 6;
$resultOne = getResult($boxes, $weight);
var_dump($resultOne);

// вторые входные данные
$boxes = [2,4,3,6,1];
$weight = 5;
$resultTwo = getResult($boxes, $weight);
var_dump($resultTwo);