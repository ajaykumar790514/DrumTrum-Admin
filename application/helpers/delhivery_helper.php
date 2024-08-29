<?php

if (!function_exists('proAPICancelShipment')) {
    function proAPICancelShipment($wbns)
    {
        $url='https://track.delhivery.com/api/p/edit';
        $arr=array(
            "waybill"=>$wbns,
            "cancellation"=>"true"
            );
        $res=json_encode($arr);   
        $out=curlExecution($url,$res);
        if($out)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

if (!function_exists('proAPIServiceAvailibility')) {
    function proAPIServiceAvailibility($pincode=null)
    {
        $url='https://track.delhivery.com/c/api/pin-codes/json/?filter_codes='.$pincode;
        $out=curlExecution($url);
        if($out)
        {
            $arr=json_decode($out);
            $cnt=count($arr->delivery_codes);
            if($cnt>0)
                return TRUE;
            else
                return FALSE;
        }
        else
        {
            return FALSE;
        }
    }
}

if (!function_exists('proAPIDeliveryCharges')) {
    function proAPIDeliveryCharges($md,$ss,$origin,$destination,$weight)
    {
        $url='https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md='.$md.'&ss='.$ss.'&d_pin='.$destination.'&o_pin='.$origin.'&cgm='.$weight;
        $out=curlExecution($url);
        if($out)
        {
            $arr=json_decode($out);
            if(count($arr)>0)
                return $arr[0]->total_amount;
            else
                return FALSE;
        }
        else
        {
            return FALSE;
        }
    }
}
    
if (!function_exists('proAPICreateShipment')) {    
   function proAPICreateShipment($data)
    {
        $url='https://track.delhivery.com/api/cmu/create.json';
        $raw='format=json&data='.json_encode($data);
        $out=curlExecution($url,$raw);
        if($out)
        {
            //echo $out;
            $arr=json_decode($out);
            $arr=$arr->packages;
            if($arr[0]->status=='Success')
            {
                return $arr[0]->waybill;
            }
            else
            {
                return FALSE;
            }
        }   
        else
        {
            return false;
        }
    }
}
    
if (!function_exists('proAPIPrintLabel')) {     
function proAPIPrintLabel($wbns)
{
        $url='https://track.delhivery.com/api/p/packing_slip?wbns='.$wbns.'&pdf=true';
        $out=curlExecution($url);
        if($out)
        {
        $arr=json_decode($out);
        $arr=$arr->packages;
        return $arr[0]->pdf_download_link;
        }
        else
        {
            return FALSE;
        }
}
}

if (!function_exists('proAPITrackShipment')) {     
function proAPITrackShipment($wbns)
{
        $url='https://track.delhivery.com/api/v1/packages/json?waybill='.$wbns;
        $out=curlExecution($url);
        if($out)
        {
        // $arr=json_decode($out);
        // $arr=$arr->packages;
        // return $arr[0]->pdf_download_link;
        }
        else
        {
            return FALSE;
        }
}
}

if (!function_exists('curlExecution')) {
function curlExecution($url,$payLoad=null)
{
    $ch = curl_init();
    if($payLoad==null)
    {
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER=>array('Content-Type: application/json','Authorization: Token '.DELHIVERY_TOKEN),
            //CURLOPT_POST=>'0',
            //CURLOPT_POSTFIELDS=>''
    ));
    }
    else
    {
     curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER=>array('Content-Type: application/json','Authorization: Token '.DELHIVERY_TOKEN),
            CURLOPT_POST=>'1',
            CURLOPT_POSTFIELDS=>$payLoad
    ));
  }
    //get response
    $output = curl_exec($ch);
    //Print error if any
    if(!$output) {
        //trigger_error(curl_error($ch));
        $output=false;
    } 
    curl_close($ch);
    return $output;
}
}


if (!function_exists('round_price')) {
    function round_price($price) {
        $rounded_price = round($price);

        return $rounded_price;
    }
}

?>