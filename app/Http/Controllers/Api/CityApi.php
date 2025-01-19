<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityApi extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function store(Request $request)
    {
        return City::create($request->all());
    }

    public function show(City $city)
    {
        return $city;
    }

    public function update(Request $request, City $city)
    {
        $city->fill($request->all())->save();
        return $city;
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(null, 204);
    }
}

// To get all items, use the GET method on the /api/cities endpoint.

// To create a new city, use the POST method on the /api/cities endpoint with the required parameters in the request body.

// To update an city, use the PUT method on the /api/cities/{id} endpoint, where {id} is the ID of the city you want to update.

// To delete an city, use the DELETE method on the /api/cities/{id} endpoint, where {id} is the ID of the city you want to delete.
