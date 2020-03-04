<?php
function priceCalculate($a,$b,$c,$density,$product_type_id, $material,$price){
    switch ($product_type_id) {
        case 2:
            $subTotalPrice = $a*$b*$c*$density*$price/1000000;
            if (session()->get('totalPrice')){
                $totalPrice = session()->get('totalPrice')+$subTotalPrice;
                session()->put('totalPrice', $totalPrice);
            }
            else{
                session()->put('totalPrice', $subTotalPrice);
            }
            session()->put('subtotalPrice', $subTotalPrice);
            return $subTotalPrice;
            break;

        default:
        if (session()->get('totalPrice')){
            $totalPrice = session()->get('totalPrice')+$price;
            session()->put('totalPrice', $price);
        }
        else{
            session()->put('totalPrice', $price);
        }
        session()->put('subtotalPrice', $price);
        return $price;
    }

}


?>
