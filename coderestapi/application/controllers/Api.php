<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('api_model');
  $this->load->library('form_validation');
 }

 function index()
 {
  $data = $this->api_model->fetch_all();
  echo json_encode($data->result_array());
 }
 
 function insert()
 {
    $this->form_validation->set_rules("title", "Title", "required");
    $this->form_validation->set_rules("details", "Details", "required");
  $this->form_validation->set_rules("datetime", "Date Time", "required");
  $array = array();
  if($this->form_validation->run())
  {
   $data = array(
    'title' => trim($this->input->post('title')),
    'details' => trim($this->input->post('details')),
    'datetime'  => trim($this->input->post('datetime'))
   );
   $this->api_model->insert_api($data);
   $array = array(
    'success'  => true
   );
  }
  else
  {
   $array = array(
    'error'    => true,
    'title_error'=> form_error('title'),
    'details_error'=> form_error('details'),
    'datetime_error' => form_error('datetime')

   );
  }
  echo json_encode($array, true);
 }

 function fetch_single()
 {
  if($this->input->post('id'))
  {
   $data = $this->api_model->fetch_single_user($this->input->post('id'));
   foreach($data as $row)
   {
    $output['title'] = $row["title"];
    $output['details'] = $row["details"];
    $output['datetime'] = $row["datetime"];
   }
   echo json_encode($output);
  }
 }

 function update()
 {
    $this->form_validation->set_rules("title", "Title", "required");
    $this->form_validation->set_rules("details", "Details", "required");
  $this->form_validation->set_rules("datetime", "Date Time", "required");
  $array = array();
  if($this->form_validation->run())
  {
   $data = array(
    'title' => trim($this->input->post('title')),
    'details' => trim($this->input->post('details')),
    'datetime'  => trim($this->input->post('datetime'))
   );
   $this->api_model->update_api($this->input->post('id'), $data);
   $array = array(
    'success'  => true
   );
  }
  else
  {
   $array = array(
    'error'    => true,
    'title_error' => form_error('title'),
    'details_error' => form_error('details'),
    'datetime_error' => form_error('datetime'),
   );
  }
  echo json_encode($array, true);
 }

 function delete()
 {
  if($this->input->post('id'))
  {
   if($this->api_model->delete_single_user($this->input->post('id')))
   {
    $array = array(
     'success' => true
    );
   }
   else
   {
    $array = array(
     'error' => true
    );
   }
   echo json_encode($array);
  }
 }
 
}