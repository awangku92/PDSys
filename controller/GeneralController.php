<?php

class GeneralController {

    public function getRegion ($state){

        switch ($state) {
            case "Perlis":
            case "Kedah":
            case "Penang":
            case "Perak":
                $region = "Northern";
                break;
            case "Kelantan":
            case "Terengganu":
            case "Pahang":
                $region = "East Coast";
                break;
            case "Wilayah Persekutuan Kuala Lumpur":
            case "Wilayah Persekutuan Putrajaya":
            case "Selangor":
                $region = "Central";
                break;
            case "Negeri Sembilan":
            case "Melaka":
            case "Johor":
                $region = "Southern";
                break;
            case "Sabah":
            case "Wilayah Persekutuan Labuan": //conformation for labuan region
                $region = "Sabah";
                break;
            case "Sarawak":
                $region = "Sarawak";
                break;
            default:
                //echo "Your favorite color is neither red, blue, nor green!";
        }
        return $region;
      }

    public function getDateTime (){
        $date = date('Y-m-d H:i:s');

        return $date;
      }

}

?>
