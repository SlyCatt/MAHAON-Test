<?php
    echo config("app.services.resizer.prefer_format", "./testfile.txt", "web");

    function config($req, $filename, $default=NULL)
    {
        if(strripos($req, ".")!==false)
        {
            $address = explode(".", trim($req));
        }
        else $address = array($req);

        $filecontent = file_get_contents($filename);
        $startingpoint = 0;
        foreach($address as &$point)
        {
            $reqpos = strpos($filecontent, "\"".$point."\"", $startingpoint);
            if($reqpos === false)
            {
                if($default!=NULL)
                {
                    return $default;
                }
                else{
                throw new Exception('Something went wrong');
                return false;
                }
            }
            else
            {
                $resalutstring = substr($filecontent, $reqpos, strpos($filecontent, "\n", $reqpos) - $reqpos);
                if(strpos($resalutstring, "[")!==false) 
                {
                    $startingpoint = strpos($filecontent, "[", $reqpos);
                    continue;
                }
                else
                {
                    $resalut = trim(substr($filecontent, strpos($filecontent, "=>", $reqpos) + 2, strpos($filecontent, "\n", $reqpos)-strpos($filecontent, "=>", $reqpos) + 2));
                    return str_replace(",", "", str_replace("\"", "", $resalut));
                }
                
                
            }
        }
    }

?>