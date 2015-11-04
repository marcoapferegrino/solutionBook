<?php namespace SolutionBook\Components;

use Collective\Html\HtmlBuilder as CollectiveHtmlBuilder;

class HtmlBuilder extends CollectiveHtmlBuilder
{
    /**
     * Build an HTML class attribute dynamically
     * Usage:
     * {!! HTML::classes(['home'=>true,'main','dont use'=>false])!!}
     * @param array $classes
     * returns:
     * class="home main".
     * @return string
     */
    public function classes(array $classes)
    {
        $html = '';

        foreach ($classes as $name=>$bool )
        {
            if(is_int($name)){
                $name = $bool;
                $bool = true;
            }
            if($bool){
                $html .= $name.' ';
            }

        }
        if(!empty($html)){
            return ' class="'.trim($html).'"';
        }
        return '';

    }

    public static function icon( $type){

        if($type=='imagenEjemplo'||$type=='imagenApoyo'){

            return 'fa-file-image-o';

        }elseif($type=='notaVoz'){

            return 'fa-music';

        }elseif($type=='pdf'){

            return 'fa-file-pdf-o';
        }elseif($type=='word'){

            return 'fa-file-word-o';

        }

        return 'fa-file';
    }

    public static function dateEspañol($date){

        $date=str_replace('Jan','Enero',$date);
        $date=str_replace('Feb','Febrero',$date);
        $date=str_replace('Mar','Marzo',$date);
        $date=str_replace('Apr','Abril',$date);
        $date=str_replace('May','Mayo',$date);

        $date=str_replace('Jun','Junio',$date);

        $date=str_replace('Jul','Julio',$date);

        $date=str_replace('Aug','Agosto',$date);

        $date=str_replace('Sep','Septiembre',$date);
        $date=str_replace('Oct','Octubre',$date);

        $date=str_replace('Nov','Noviembre',$date);

        $date=str_replace('Dec','Diciembre',$date);




        return $date;
    }
    public static function obfuscater($value)
    {
        $safe = '';

        foreach (str_split($value) as $letter)
        {
            if (ord($letter) > 128) return $letter;

            // To properly obfuscate the value, we will randomly convert each letter to
            // its entity or hexadecimal representation, keeping a bot from sniffing
            // the randomly obfuscated letters out of the string on the responses.
            switch (rand(1, 3))
            {
                case 1:
                    $safe .= '&#'.ord($letter).';'; break;

                case 2:
                    $safe .= '&#x'.dechex(ord($letter)).';'; break;

                case 3:
                    $safe .= $letter;
            }
        }
        print_r($safe);
        return $safe;
    }
}