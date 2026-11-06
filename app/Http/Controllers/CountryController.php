<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Search countries for select2 dropdowns.
     */
    public function search(Request $request)
    {
        $term = (string) $request->get('q', '');

        $countries = Country::query()
            ->when($term !== '', function ($query) use ($term) {
                $query->where(function ($countryQuery) use ($term) {
                    $countryQuery->where('name', 'like', '%' . $term . '%')
                        ->orWhere('code', 'like', '%' . $term . '%')
                        ->orWhere('dial_code', 'like', '%' . $term . '%');
                });
            })
            ->orderBy('name')
            ->limit(20)
            ->get()
            ->map(function (Country $country) {
                $labelParts = array_filter([
                    $country->name,
                    $country->code ? '(' . $country->code . ')' : null,
                    $country->dial_code ? $country->dial_code : null,
                ]);

                return [
                    'id' => $country->name,
                    'text' => implode(' ', $labelParts),
                    'dial_code' => $country->dial_code,
                    'flag' => $country->flag,
                    'code' => $country->code,
                ];
            });

        return response()->json([
            'results' => $countries,
        ]);
    }
}

