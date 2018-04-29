<?php

function parseMarkdown($markdown)
{
    //separates multiple line markdown string into separate lines
    $lineArray=explode("\n", $markdown);

    $markdownArray=[];
    foreach($lineArray as &$line) {
        
        //test each word for bold and italics
        $wordArray=explode(' ',$line);
        foreach($wordArray as &$word) {
            if(substr($word,0,2)=='__' && substr($word,strlen($word)-2,2)=='__') {
                $word= '<em>'.str_replace('__','',$word).'</em>';
            }
            elseif(substr($word,0,1)=='_' && substr($word,-1,1)=='_') {
                $word='<i>'.str_replace('_','',$word).'</i>';
            }
        }
        $line=implode(' ',$wordArray);
        
        //test line for bold in entire string
        //NEED ADD CHECK IF FIRST CHARACTER IS * OR #
        if( (substr($line,0,2)=='__' && substr($line,strlen($line)-2,2)=='__') || 
            ( (substr($line,0,1)=='#' || substr($line,0,1)=='*') && substr($line,2,2)=='__' && substr($line,strlen($line)-2,2)=='__' )) {
            $line='<em>'.str_replace('__','',$line).'</em>';
        }    
        
        //test line for italics in entire string
        elseif( (substr($line,0,1)=='_' && substr($line,strlen($line)-1,1)=='_') || 
            ( (substr($line,0,1)=='#' || substr($line,0,1)=='*') && substr($line,2,1)=='_' && substr($line,strlen($line)-1,1)=='_' )) {
            $line='<i>'.str_replace('_','',$line).'</i>';
        }
        
        //determines if header tag and counts header size
        if (preg_match('/^[#]+/',$line,$match[0])) {
            $line= str_replace((string)$match[0][0].' ','',$line);
            $line='<h'.(string)strlen($match[0][0]).'>'.$line.'</h'.(string)strlen($match[0][0]).'>';
        }
        else {
            $line='<p>'.$line.'</p>';
        }

        //determines if line is part of a list
        if(is_int(strpos($line,'*'))) {
            $line=str_replace('* ','',$line);
            $line='<li>'.$line.'</li>';
        }
        array_push($markdownArray, $line);
    }//end of forloop

    //returns final string
    $markdownString=implode('',$markdownArray);
    if(is_int(strpos($markdownString,'<li>'))) {
        $markdownString=substr($markdownString,0,strpos($markdownString,'<li>')).'<ul>'.substr($markdownString,strpos($markdownString,'<li>')).'</ul>';
        if(substr($markdownString,0,4)=='<h1>') {
            $markdownString=str_replace('<p>','',$markdownString);
            $markdownString=str_replace('</p>','',$markdownString);
        }
        return $markdownString;
    }
    else {
        return $markdownString;
    }
}