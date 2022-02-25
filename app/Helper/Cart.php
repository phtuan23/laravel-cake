<?php
    namespace App\Helper;

    class Cart{
        public $carts = [];
        public $total_quantity = 0;
        public $total_price = 0;

        public function __construct(){
            $this->carts = session('cart') ? session('cart') : [];
            $this->total_price = $this->total_price();
            $this->total_quantity = $this->total_quantity();
        }

        public function add($product,$quantity = 1){
            $cart = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => ($product->sale_price > 0) ? $product->sale_price :  $product->price,
                'quantity' => $quantity
            ];
            if(isset($this->carts[$product->id])){
                $this->carts[$product->id]['quantity'] += $quantity;
            }else{
                $this->carts[$product->id] = $cart;
            }
            session(['cart' => $this->carts]);
        }

        public function update($ids, $quantity){
            foreach($ids as $key => $id){
                if(isset($this->carts[$id])){
                    if(!is_numeric($quantity[$key])){
                        $quantity[$key] = 1;
                    }else if($quantity[$key] < 0){
                        $quantity[$key] = 1;
                    }
                    $this->carts[$id]['quantity'] = $quantity[$key] > 0 ? ceil($quantity[$key]) : 1;
                }
                session(['cart' => $this->carts]);
            }
        }

        public function updateOne($id, $quantity){
            if(isset($this->carts[$id])){
                $this->carts[$id]['quantity'] = $quantity > 0 ? ceil($quantity) : 1;
            }
            session(['cart' => $this->carts]);
        }

        public function delete($id){
            if(isset($this->carts[$id])){
                unset($this->carts[$id]);
            }
            session(['cart' => $this->carts]);
        }

        public function clear(){
            session(['cart' => []]);
        }

        public function total_price(){
            $price = 0;
            foreach ($this->carts as $cart){
                $price += $cart['price']*$cart['quantity'];
            }
            return $price;
        }

        public function total_quantity(){
            $quantity = 0;
            foreach ($this->carts as $cart){
                $quantity += $cart['quantity'];
            }
            return $quantity;
        }
    }
?>