<?php

class Series
{
    //variable
    public $input;

    //constructor
    public function __construct($input)
    {
        $this->input=$input;
    }

    public function largestProduct($n)
    {
        $inputToString=(string)$this->input;
        
        if ($inputToString=="" and $n!=0) || preg_match("/[a-zA-Z]/", $inputToString)==1 || $n<0)
        {
            throw new InvalidArgumentException('Invalid Submission');
        }

        if ($n>strlen($inputToString))
        {
            throw new InvalidArgumentException('Span exceeds string length');
        }

        if ($inputToString!="" and $n==0)
        {
            return 1;
        }

        if ($inputToString=="" and $n==0)
        {
            return 1;
        }

        $largestProduct=NULL;
        for($x=0;$x<=strlen($inputToString)-$n;$x++)
        {
            $product=NULL;
            for($y=0;$y<$n;$y++)
            {
                if($product===NULL)
                {
                    $product=(int)$inputToString[$x+$y];
                }
                else
                {
                    $product= $product*(int)$inputToString[$x+$y];
                }
            }

            if($largestProduct===NULL || $product>$largestProduct)
            {
                $largestProduct=$product;
            }
        }
        return $largestProduct;
    }
}