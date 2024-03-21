<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_api extends CI_Controller {

 function index()
 {
  $this->load->view('api_view');
 }

 function action()
 {
  if($this->input->post('data_action'))
  {
   $data_action = $this->input->post('data_action');

   if($data_action == "Delete")
   {
	$api_url = "http://localhost/coderestapi/api/delete";
    $form_data = array(
     'id'  => $this->input->post('user_id')
    );

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_POST, true);

    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    curl_close($client);

    echo $response;




   }

   if($data_action == "Edit")
   {
	$api_url = "http://localhost/coderestapi/api/update";
    $form_data = array(
     'title'  => $this->input->post('title'),
     'details'  => $this->input->post('details'),
      'datetime'   => $this->input->post('datetime'),
     'id'    => $this->input->post('user_id')
    );

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_POST, true);

    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    curl_close($client);

    echo $response;


   }

   if($data_action == "fetch_single")
   {
	$api_url = "http://localhost/coderestapi/api/fetch_single";

    $form_data = array(
     'id'  => $this->input->post('user_id')
    );

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_POST, true);

    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    curl_close($client);

    echo $response;






   }

   if($data_action == "Insert")
   {
    $api_url = "http://localhost/coderestapi/api/insert";
   

    $form_data = array(
    'title'  => $this->input->post('title'),
    'details'  => $this->input->post('details'),
     'datetime'   => $this->input->post('datetime')

    );

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_POST, true);

    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    curl_close($client);

    echo $response;


   }





   if($data_action == "fetch_all")
   {
	$api_url = "http://localhost/coderestapi/api";

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    curl_close($client);

    $result = json_decode($response);

    $output = '';

    if(count($result) > 0)
    {
     foreach($result as $row)
     {
    
      $output .= '<div class="card" style="width: 18rem;">
  <div class="card-title">
  <span class="text-centre" >'.$row->title.'</span>
    </div>
    <div class="card-content">
    <span class="">'.$row->datetime.'</span>
    </div>
    <div class="card-text">
    <p class=" ">'.$row->details.'</p>
   <div class="btn-action">
    <a href="#" class="card-link"><butto type="button" name="edit" class="btn btn-info btn-md edit" id="'.$row->id.'"><i class="fa-regular fa-pen-to-square"></i> Edit</button></a>
    <a href="#" class="card-link"><button type="button" name="delete" class="btn btn-primary btn-md delete" id="'.$row->id.'"><i class="fa-regular fa-trash"></i>remove</button></a>
  </div>
    </div>
</div>
      


';
     }
    }
    else
    {
     $output .= '
     <tr>
      <td colspan="4" align="center">No Data Found</td>
     </tr>
     ';
    }

    echo $output;
   }
  }
 }
 
}

?>