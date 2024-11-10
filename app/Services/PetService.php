<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class PetService
{
  protected $baseUrl = 'https://petstore.swagger.io/v2/pet';

  public function getPets($status){
    try {
      $response = Http::get($this->baseUrl . '/findByStatus', ['status' => $status]);
      if($response->successful()){
        return $response->json();
      }
      return ['error' => 'Error ' . $response->status()];
    } catch (Exception $e) {
      return ['error' => 'Error ' . $e->getMessage()];
    }
  }

  public function getPet($id){
    try {
      $response = Http::get($this->baseUrl . '/' . $id);
      if($response->successful()){
        return $response->json();
      }
      return ['error' => 'Error '. $response->status()];
    } catch (Exception $e) {
      return ['error' => 'Error ' . $e->getMessage()];
    }
  }

  public function createPet($data){
    try {
      $response = Http::post($this->baseUrl, $data);
      if($response->successful()){
        return $response->json();
      }
      return ['error' => 'Error ' . $response->status()];
    } catch (Exception $e) {
      return ['error' => 'Error ' . $e->getMessage()];
    }
  }

  public function updatePet($data){
    try {
      $response = Http::put($this->baseUrl, $data);
      if($response->successful()){
          return $response->json();
      }
      return ['error' => 'Error ' . $response->status()];
    } catch (Exception $e) {
      return ['error' => 'Error ' . $e->getMessage()];
    }
  }

  public function deletePet($id){
    try {
      $response = Http::delete($this->baseUrl . '/' . $id);
      if($response->successful()){
        return $response->json();
      }
      return ['error' => 'Error ' . $response->status()];
    } catch (Exception $e) {
      return ['error' => 'Error ' . $e->getMessage()];
    }
  }
}
