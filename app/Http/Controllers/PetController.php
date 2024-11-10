<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetService;

class PetController extends Controller
{
  protected $petService;

  public function __construct(PetService $petService){
    $this->petService = $petService;
  }

  public function index($status = "available"){
    $pets = $this->petService->getPets($status);

    if(isset($pets['error'])){
      session()->flash('error', $pets['error']);
      return view('pets.index', ['pets' => []]);
    }

    return view('pets.index', ['pets' => $pets]);
  }

  public function show($id){
    $pet = $this->petService->getPet($id);

    if(isset($pet['error'])){
      return redirect()->back()->with('error', $pet['error']);
    }

    return view('pets.show', ['pet' => $pet]);
  }

  public function create(){
    return view('pets.create');
  }

  public function store(Request $request){
    $request->validate([
      'name' => 'required|string|max:255',
      'status' => 'required|in:available,pending,sold',
      'category.id' => 'nullable|integer',
      'category.name' => 'nullable|string|max:255',
      'tags.*.id' => 'nullable|integer',
      'tags.*.name' => 'nullable|string|max:255',
    ]);

    if(empty($request['tags'][0]['id']) || empty($request['tags'][0]['name'])){
      unset($request['tags']);
    }

    $response = $this->petService->createPet($request->all());

    if(isset($response['error'])){
      return redirect()->back()->with('error', $response['error']);
    }

    return redirect()->route('pets.index')->with('success', 'Succesfully created pet.');
  }

  public function edit($id){
    $pet = $this->petService->getPet($id);

    if(isset($pet['error'])){
      return redirect()->back()->with('error', $pet['error']);
    }

    return view('pets.edit', ['pet' => $pet]);
  }

  public function update(Request $request, $id){
    $request->validate([
      'name' => 'required|string|max:255',
      'status' => 'required|in:available,pending,sold',
      'category.id' => 'nullable|integer',
      'category.name' => 'nullable|string|max:255',
      'tags.*.id' => 'nullable|integer',
      'tags.*.name' => 'nullable|string|max:255',
    ]);

    $data = $request->all();
    $data['id'] = $id;

    if(isset($data['tags'])){
      $data['tags'] = array_filter($data['tags'], function($tag){
        return !empty($tag['id']) && !empty($tag['name']);
      });
      $data['tags'] = array_values($data['tags']);
    }

    $response = $this->petService->updatePet($data);
    if(isset($response['error'])){
      return redirect()->back()->with('error', $response['error']);
    }

    return redirect()->route('pets.show', ['pet'=>$id])->with('success', 'Succesfully updated pet.');
  }

  public function destroy($id){
    $response = $this->petService->deletePet($id);
    if(isset($response['error'])){
      return redirect()->back()->with('error', $response['error']);
    }

    return redirect()->route('pets.index', ['status'=>'available'])->with('success', 'Succesfully deleted pet.');
  }
}
