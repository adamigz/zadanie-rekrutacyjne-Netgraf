<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $pets = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->get("https://petstore.swagger.io/v2/pet/findByStatus", [
            'status' => $request->status
        ]);

        switch ($pets->status()) {
            case 200:
                return view('findByStatus', ["pets" => $pets->object()]);
            case 400:
                session()->flash('error', 'Niepoprawny status');
                return redirect()->back();
            default:
                break;
        }
    }

    public function find(Request $request) {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $pet = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->get("https://petstore.swagger.io/v2/pet/".$request->id);

        switch ($pet->status()) {
            case 200:
                return view('findById', ["pet" => $pet->object()]);
            case 400:
                session()->flash('error', 'Niepoprawne id');
                return redirect()->back();
            case 404:
                session()->flash('error', 'Nie znaleziono Pet o podanym ID');
                return redirect()->back();
            default:
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createPet');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "id" => "required|integer",
            "name" => "required|string",
            "category_id" => "required|integer",
            "category_name" => "required|string",
            "photo_url" => "required|string",
            "tags" => "required|string",
            "status" => "required|string"
        ]);

        $tags = explode(",", $request->tags);

        foreach($tags as $index => $tag) {
            $tags[$index] = [
                    "id" => $index,
                    "name" => $tag
                ];
        }

        $pet = [
            "id" => $request->id,
            "category" => [
                "id" => $request->category_id,
                "name" => $request->category_name,
            ],
            "name" => $request->name,
            "photoUrls" => [
                $request->photo_url
            ],
            "tags" => $tags,
            "status" => $request->status
        ];

        $response = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->withBody(json_encode($pet))->post("https://petstore.swagger.io/v2/pet");

        switch ($response->status()) {
            case 405:
                session()->flash('error', 'Nieprawidłowe dane');
                return redirect()->back();
            default:
                return redirect()->route('getByStatus', ['status' => $request->status]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        if ($id == null) {
            return view('findById');
        }

        $pet = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->get("https://petstore.swagger.io/v2/pet/".$id);

        switch ($pet->status()) {
            case 200:
                return view('findById', ["pet" => $pet->object()]);
            case 400:
                session()->flash('error', 'Niepoprawne id');
                return redirect()->back();
            case 404:
                session()->flash('error', 'Nie znaleziono Pet o podanym ID');
                return redirect()->back();
            default:
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->get("https://petstore.swagger.io/v2/pet/".$id);

        switch ($pet->status()) {
            case 200:
                return view('updatePet', ["pet" => $pet->object()]);
            case 400:
                session()->flash('error', 'Niepoprawne id');
                return redirect()->back();
            case 404:
                session()->flash('error', 'Nie znaleziono Pet o podanym ID');
                return redirect()->back();
            default:
                break;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "id" => "required|integer",
            "name" => "required|string",
            "category_id" => "required|integer",
            "category_name" => "required|string",
            "photo_url" => "required|string",
            "tags" => "required|string",
            "status" => "required|string"
        ]);

        $tags = explode(",", $request->tags);

        foreach($tags as $index => $tag) {
            if ($tags[$index]!='') {
                $tags[$index] = [
                    "id" => $index,
                    "name" => $tag
                ];
            }
        }

        $pet = [
            "id" => $id,
            "category" => [
                "id" => $request->category_id,
                "name" => $request->category_name,
            ],
            "name" => $request->name,
            "photoUrls" => [
                $request->photo_url
            ],
            "tags" => $tags,
            "status" => $request->status
        ];

        $response = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->withBody(json_encode($pet))->put("https://petstore.swagger.io/v2/pet");

        switch ($response->status()) {
            case 405:
                session()->flash('error', 'Błąd walidacji');
                return redirect()->back();
            case 404:
                session()->flash('error', 'Nie znaleziono Pet o podanym ID');
                return redirect()->back();
            case 400:
                session()->flash('error', 'Niepoprawne ID');
                return redirect()->back();
            default:
                return redirect()->route('getByStatus', ['status' => $request->status]);
        }
    }

    public function change(Request $request, $id) {
        $pet = Http::accept('application/json')
        ->withHeader('api_key', 'special-key')
        ->get("https://petstore.swagger.io/v2/pet/".$id);

        switch ($pet->status()) {
            case 200:
                return view('patchPet', ["pet" => $pet->object()]);
            case 400:
                session()->flash('error', 'Niepoprawne id');
                return redirect()->back();
            case 404:
                session()->flash('error', 'Nie znaleziono Pet o podanym ID');
                return redirect()->back();
            default:
                break;
        }
    }

    public function patch(Request $request, $id) {
        $request->validate([
            'name' => 'string',
            'status' => 'string'
        ]);

        $response = Http::asForm()
        ->withHeader('api_key', 'special-key')
        ->post("https://petstore.swagger.io/v2/pet/".$id, [
            "name" => $request->name,
            "status" => $request->status
        ]);

        switch ($response->status()) {
            case 200:
                return redirect()->back();
            case 405:
                session()->flash('error', 'Nieprawidłowe dane');
                return redirect()->back();
            default:
                break;
        }
    }

    public function upload() {
        return view('addPhotoUrl');
    }

    public function uploadPhoto(Request $request) {
        $request->validate([
            'id' => 'required|integer',
            'metadata' => 'string'
        ]);

        $response = Http::attach('file', $request->file('photo')->getContent())
            ->attach('additionalMetadata', $request->metadata)
            ->post("https://petstore.swagger.io/v2/pet/".$request->id.'/uploadImage');

        if($response->status() == 200) {
            return redirect()->route('getByStatus', ['status' => 'available']);
        } else {
            session()->flash('error', 'Błąd przy dodwaniu zdjęcia');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!isset($id) && !empty($id) && $id != null) {
            session()->flash('error', 'ID jest wymagane do usunięcia pet');
            return redirect()->back();
        } else {
            Http::withHeader('api_key', 'special-key')
            ->delete("https://petstore.swagger.io/v2/pet/".$id);
            return redirect()->back();
        }
    }
}
