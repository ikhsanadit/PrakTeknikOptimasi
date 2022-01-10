<?php

class Catalogue //untuk membaca file txt produk
{

    function createProductColumn($columns, $listOfRawProduct){
        //membaca setiap kolom dari item produk dengan menggunakan key
        foreach (array_keys($listOfRawProduct) as $listOfRawProductKey){
            // mengganti index menjadi item dan price
            $listOfRawProduct[$columns[$listOfRawProductKey]] = $listOfRawProduct[$listOfRawProductKey];
            unset($listOfRawProduct[$listOfRawProductKey]); //mengosongkan kembali array yang sebelumnya
        }
        return $listOfRawProduct;//return value yang sudah berubah dari inex 0 1 menjadi item price
        //dan akan disimpan di array collectionOfListProduct[]
    }
    // fungsi untuk memanggil file txt
    function product($parameters){
        $collectionOfListProduct = [];

        $raw_data = file($parameters['file_name']);//memanggil nama file
        //membaca item tiap baris kemudian disimpan
        foreach ($raw_data as $listOfRawProduct){
             $collectionOfListProduct[] = $this->createProductColumn($parameters['columns'], explode(",", $listOfRawProduct));
        }
        // melihat katalog produk
        //foreach ($collectionOfListProduct as $listOfRawProduct){
        //    print_r($listOfRawProduct);
        //    echo '<br>';
        //}
        return [
        'product' => $collectionOfListProduct,
        'gen_length' => count($collectionOfListProduct)

        ];
    }
}

class PopulationGenerator
{
    function createIndividu($parameters){
        $catalogue = new Catalogue;
        $lengthOfGen =  $catalogue->product($parameters)['gen_length'];
        for ($i = 0; $i <= $lengthOfGen-1;$i++){
            $ret[] = rand(0, 1);
        }
        return $ret;
    }
    function createPopulation($parameters){
        for ($i = 0; $i <= $parameters['population_size']; $i++){
           $ret[] = $this -> createIndividu($parameters);
        }
        foreach ($ret as $key => $val){
            print_r($val);
            echo '<br>';
        }
    }
}

$parameters = [
    'file_name' => 'product.txt',
    'columns' => ['item', 'price'],
    'population_size' => 10
];

$katalog = new Catalogue;
$katalog -> product($parameters);

$initialPopulation = new PopulationGenerator;
$initialPopulation->createPopulation($parameters);