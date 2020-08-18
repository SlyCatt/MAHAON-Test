<?php
    echo config("db.user", "./testfile.txt")

    function config($req, $filename, $default=NULL)
    {
        if(strripos($req, ".")!==false
        {
            $address = explode(".", trim($req));
        }
        else $address = array($req);

        $filecontent = file_get_contents($filename);
        $startingpoint = 0;
        foreach($address as &$point)
        {
            $reqpos = strpos($filecontent, $point, $startingpoint);
            if($reqpos === false)
            {
                if($default!=NULL)
                {
                    return $default;
                }
                else return false;
            }
            else
            {
                $resalutstring = substr($filecontent, $reqpos, strpos($filecontent, "\n", $reqpos) - $reqpos);
                if(strpos($resalutstring, "[", $reqpos)!==false) 
                {
                    $startingpoint = strpos($filecontent, "[", $reqpos);
                    continue;
                }
                else
                {
                    $resalut = trim(substr($resalutstring, strpos($filecontent, "=>", $reqpos) + 2, strpos($filecontent, "\n", $reqpos)-strpos($filecontent, "=>", $reqpos) + 2));
                    return str_replace("\"", "", $resalut);
                }
                
                
            }
        }
    }

?>