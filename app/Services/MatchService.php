<?php

namespace App\Services;

use App\Models\Property;
use App\Models\SearchProfile;

class MatchService
{
    public function matchProperty(Property $property): array
    {
        $propertyFields = json_decode($property->fields, true);

        $searchProfiles = SearchProfile::byPropertyType($property->propertyType)->get(['id', 'search_fields']);

        // Return empty if there are no search profiles with same property type
        if ($searchProfiles->isEmpty()) {
            return [];
        }

        foreach ($searchProfiles as $searchProfile) {
            $responseData[] = $this->matchedData($searchProfile, $propertyFields);
        }

        $responseData = collect($responseData);

        return $responseData->sortByDesc('score')->values()->all();
    }

    private function matchedData(SearchProfile $searchProfile, array $propertyFields): array
    {
        $data = [];
        $data['searchProfileId'] = $searchProfile->id;
        $data['score'] = 0;
        $data['strictMatchesCount'] = 0;
        $data['looseMatchesCount'] = 0;

        // Convert the search_fields field to array
        $searchFields = json_decode($searchProfile->search_fields, true);

        // Get fields that are present in both the property fields and search fields
        $validFields = array_keys(array_intersect_key($searchFields, $propertyFields));

        foreach ($validFields as $key => $field) {
            // Case 1: If the values in search and property are equal
            if ($searchFields[$field] == $propertyFields[$field]) {
                $data['strictMatchesCount'] += 1;
                $data['score'] += 1;
            } elseif (is_array(json_decode($searchFields[$field], true))) { // Case 2: If search value is a range
                $searchRange = json_decode($searchFields[$field], true);

                // Case 3: Check if property value is within search range
                if (count($searchRange) == 2 && $propertyFields[$field] >= $searchRange[0] && (is_null($searchRange[1]) ||  $propertyFields[$field] <= $searchRange[1])) {
                    $data['strictMatchesCount'] += 1;
                    $data['score'] += 1;

                    // Case 4: Apply 25% deviation
                } elseif (count($searchRange) == 2 && $propertyFields[$field] >= 0.75 * (float)$searchRange[0] && (is_null($searchRange[1]) ||  $propertyFields[$field] <= (0.25 * $searchRange[1]) + $searchRange[1])) {
                    $data['looseMatchesCount'] += 1;
                    $data['score'] += 1;
                }
            }
        }

        return $data;
    }
}
