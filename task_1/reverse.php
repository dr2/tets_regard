<?php

class Test {
    public $next;
}

$a = new Test();
$b = new Test();
$c = new Test();
$d = new Test();
$a->next = $b;
$b->next = $c;
$c->next = $d;
$d->next = null;

/**
 * функция  разворота списка
 * @param Test $a
 * @param object|null $result
 * @return object
 */
function reverse(Test $a, object $result = null) : object {

    $new = new Test();
    $new->next = $result;
    $result = $new;

    if ($a->next !== null) {
        $result = reverse($a->next, $result);
    }

    return $result;
}

$ob1 = reverse($a);
var_dump($ob1);
