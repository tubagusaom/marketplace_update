<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Rajaongkir_model extends MY_Model {

  private function _api_ongkir_post($origin,$des,$qty,$cour)
 {

   // var_dump($cour); die();

    $curl = curl_init();
    curl_setopt_array($curl , array(
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$des."&weight=".$qty."&courier=".$cour,
    CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    /* masukan api key disini*/
    // "key: 2211ef2ed169124a1ebc6f4a502073cf"
    // "key: 8a6d401055ec5f0df6e31aad625a2e41"
    "key: 413f3069e69eb48279c31d3a2ca55200"
    // "key: d16c153b1f9cb2d662e1b872c6da9042"
    // "key: 863d42799c01fe60f3cbeb06735b849f"
    // "key: e314668b23cc7563c789b7d0f9eca598"
    // "key: 05e209faf8bc57773b22b00e60004ed0"

    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  // var_dump($err); die();

  // curl_close($curl);

  if ($err) {
    return $err;
  } else {
    return $response;
  }

 }

 function _api_ongkir($data)
 {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    //CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
    //CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
    CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      /* masukan api key disini*/
      // "key: 2211ef2ed169124a1ebc6f4a502073cf"
      // "key: 8a6d401055ec5f0df6e31aad625a2e41"
      "key: 413f3069e69eb48279c31d3a2ca55200"
      // "key: d16c153b1f9cb2d662e1b872c6da9042"
      // "key: 863d42799c01fe60f3cbeb06735b849f"
      // "key: e314668b23cc7563c789b7d0f9eca598"
      // "key: 05e209faf8bc57773b22b00e60004ed0"
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);
  if ($err) {
    return  $err;
  } else {
    return $response;
  }
 }


 public function tarif_ro($origin,$des,$qty,$cour)
 {
   $berat = $qty*1000;
   $tarif = $this->_api_ongkir_post($origin,$des,$berat,$cour);
   $data = json_decode($tarif, true);
   // return json_encode($data['rajaongkir']['results']);

   // var_dump($berat); die();

   return json_encode($data['rajaongkir']['results']);

   // $xxx = ($data['rajaongkir']['results']);

   // var_dump(json_encode($data['rajaongkir']['results'])); die();

 }

}
