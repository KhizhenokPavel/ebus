<?php

namespace App\Http\Requests;

use App\Rules\CoordinateLatitudeRule;
use App\Rules\CoordinateLongitudeRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchAreaRequest extends FormRequest
{
    public const AREA_TYPES = [
        'circle' => 0,
        'rectangle' => 1,
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        $request = request();

        $rules = [
            'areaType' => 'required|in:' . implode(',', self::AREA_TYPES),
        ];

        if (!isset($request['areaType'])) {
            return $rules;
        }

        if ($request['areaType'] == static::AREA_TYPES['circle']) {
            return array_merge($rules,
                [
                    'radius' => 'required', 'numeric',
                    'centralPointLongitude' => ['required', 'numeric', new CoordinateLongitudeRule()],
                    'centralPointLatitude' => ['required', 'numeric', new CoordinateLatitudeRule()],
                ]
            );
        }

        return array_merge($rules,
            [
                'firstPointLongitude' => ['required', 'numeric', new CoordinateLongitudeRule()],
                'firstPointLatitude' => ['required', 'numeric', new CoordinateLatitudeRule()],
                'secondPointLongitude' => ['required', 'numeric', new CoordinateLongitudeRule()],
                'secondPointLatitude' => ['required', 'numeric', new CoordinateLatitudeRule()],
            ]
        );
    }
}
