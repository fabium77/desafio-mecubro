<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Adn;

class AnalizadorController extends Controller
{

    public function index()
    {

    	return "hola, no era por aqui tiene que mandar una peticion post a las direcciones habilitadas. igual gracias por visitarme";

    }

    public function analizar(Request $Request)
    {

        function aciertosColumnas($secuencia){

            $col = [];
    
            $iCol = 0;
    
            $c=0;
    
            $aciertos = 0;

            for ($f=0; $f < count($secuencia) ; $f++) {

                for ($c=0; $c < count($secuencia[$f]); $c++) {
    
                    $letra = $secuencia[$f][$c];
     
    
                        if ($c == 0) {
    
                            $col[$iCol] = $letra;
    
                        }else{
    
    
                            if ($col[$iCol] == $letra) {
    
                                $iCol++;
    
                                $col[$iCol] = $letra;
    
                                if (count($col) == 4) {
    
    
                                    $aciertos++;
    
                                    if ($aciertos == 2) {
    
                                        $c = 6;
    
                                    }
                                    
                                }
    
                            } else {
    
                                unset($col);
    
                                $col = [];
    
                                $iCol = 0;
    
                                $col[$iCol] = $letra;
    
                            }
    
                        }
    
        
                    }
    
    
            }

            return $aciertos;

        }


        function aciertosFilas($dna){

            $fil = [];
    
            $iFil = 0;
    
            $aciertos = 0;

            for ($f=0; $f < 6; $f++) {

                for ($c=0; $c < 6; $c++) {
    
                    $letra = $dna[$c][$f];
     
    
                        if ($c == 0) {
    
                            $fil[$iFil] = $letra;
    
                        }else{
    
    
                            if ($fil[$iFil] == $letra) {
    
                                $iFil++;
    
                                $fil[$iFil] = $letra;
    
                                if (count($fil) == 4) {
    
                                    $aciertos++;
    
                                    if ($aciertos == 2) {
    
                                        $c = 6;
    
                                    }
                                    
                                }
    
                            } else {
    
                                unset($fil);
    
                                $fil = [];
    
                                $iFil = 0;
    
                                $fil[$iFil] = $letra;
    
                            }
    
                        }
    
        
                    }
    
            }

            return $aciertos;

        }


        function aciertosDiagonal($dna){


            $f = 0;

            $fAnterior = 0;


            // 5 Diagonales

            // 1°


            for ($i=0; $i < 4; $i++) {


                $diagonales[0][$i] = $dna[$i + 2][$i];

            }



            // 2°

            for ($i=0; $i < 5; $i++) { 

                $diagonales[1][$i] = $dna[$i + 1][$i];

            }

            // 3°

            for ($i=0; $i < 6; $i++) { 

                $diagonales[2][$i] = $dna[$i][$i];

            }

            // 4°

            for ($i=0; $i < 5; $i++) { 

                $diagonales[3][$i] = $dna[$i][$i + 1];

            }

            // 5°

            for ($i=0; $i < 4; $i++) { 

                $diagonales[4][$i] = $dna[$i][$i + 2];

            }


            return (aciertosColumnas($diagonales));


        }


        $dna =  json_encode($Request->dna);

        // Verificacion de cadena correcta //

        $error = "Error 400 Bad Request";

        if (strlen($dna) <> 55) {

            return $error;

        }

        $iDna = 0;

        $secuencia = "";

        if ($dna[$iDna] == '[') {


            for ($f=0; $f < 6; $f++) { 

                $iDna++;

                if ($dna[$iDna] == '"') {

                    for ($c=0; $c < 6; $c++) { 

                        $iDna++;

                        if ($dna[$iDna] == "A" or $dna[$iDna] == "T" or $dna[$iDna] == "C" or $dna[$iDna] == "G") {
                            # code...
                        }else {

                            return $error;

                        }  

                    }

                    $iDna++;


                    if ($iDna == 53) {

                        if ($dna[$iDna] <> '"') {

                            return $error;
    
                        }

                        $iDna++;


                        if ($dna[$iDna] <> ']') {

                            return $error;
    
                        }
    

                    }else{

                        if ($dna[$iDna] <> '"') {

                            return $error;

                        }
    
                        $iDna++;
    
                        if ($dna[$iDna] <> ',') {
    
                            return $error;
    
                        }
                        
                    }

                }else{

                    return $error;

                }


            }
            

        }else{

            return $error;

        }


        // Fin Verificacion de cadena correcta //




        $dna = $Request->dna;


        /* $dna = ["ATGCGA",
                "CAGTGC",
                "TTATGT",
                "AGAAGG",
                "CCCCTA",
                "TCACTG"];

        */

        for ($i=0; $i < 6; $i++) {
            
            $dna[$i] = str_split($dna[$i], 1);

        }


        $aciertosAcum = aciertosColumnas($dna);


        if ( $aciertosAcum >= 2) {

            $adn = new Adn();

            $adn->adn = json_encode($dna);
    
            $adn->force = 1;

            $adn->save();
            
            return 'HTTP 200-OK';

        }


        $aciertosAcum = $aciertosAcum + aciertosFilas($dna);

        if ( $aciertosAcum >= 2) {

            $adn = new Adn();

            $adn->adn = json_encode($dna);
    
            $adn->force = 1;

            $adn->save();
            
            return 'HTTP 200-OK';

        }


        $aciertosAcum = $aciertosAcum + aciertosDiagonal($dna);

        
        if ( $aciertosAcum >= 2) {
            
            $adn = new Adn();

            $adn->adn = json_encode($dna);
    
            $adn->force = 1;

            $adn->save();

            return 'HTTP 200-OK';

        }

        $adn = new Adn();

        $adn->adn = json_encode($dna);

        $adn->force = 0;

        $adn->save();

        return '403-Forbidden';

    }

    public function stats()
    {

        $sencibles = Adn::where('force','=',1)->count();

        $noSencibles = Adn::where('force','=',0)->count();



        if ($noSencibles == 0 and $sencibles == 0) {

            $ratio = "0";

        } else {

            if ($noSencibles == 0) {

                $ratio = "NaN";

            }else {

                $ratio = $sencibles / $noSencibles;

            }





        }
        
        $json = '[{"force_user_dna": "'.$sencibles.'", "non_force_user_dna": "'.$noSencibles.'", "ratio": "'.$ratio.'"}]';

    	return json_decode($json);

    }

    public function reset()
    {

        $adn = Adn::truncate();

    	return 'Todos los registros de DNA fueron borrados';

    }

}
