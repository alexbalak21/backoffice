<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EchantillonAnalyse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EchantillonAnalyseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a new echantillon analyse from JSON data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Validate the request contains JSON
        if (!$request->isJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Request must be JSON',
            ], 400);
        }

        $data = $request->json()->all();

        // If data is a single object, convert it to an array with one item
        if (!isset($data[0]) && !empty($data)) {
            $data = [$data];
        }

        $created = [];
        $errors = [];

        foreach ($data as $index => $item) {
            $validator = Validator::make($item, [
                'date_heure_prelevement' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/^\d{2}\/\d{2}\/\d{2,4}(?: \d{1,2}:\d{2})?$/', $value)) {
                            $fail("The $attribute field must be in the format dd/mm/yy[yy] [HH:MM].");
                        }
                    }
                ],
                'date_heure_reception' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/^\d{2}\/\d{2}\/\d{2,4}(?: \d{1,2}:\d{2})?$/', $value)) {
                            $fail("The $attribute field must be in the format dd/mm/yy[yy] [HH:MM].");
                        }
                    }
                ],
                'temperature_reception' => 'nullable|numeric',
                'date_mise_en_analyse' => [
                    'nullable',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/^\d{2}\/\d{2}\/\d{2,4}(?: \d{1,2}:\d{2})?$/', $value)) {
                            $fail("The $attribute field must be in the format dd/mm/yy[yy] [HH:MM].");
                        }
                    }
                ],
                'date_emballage' => 'nullable|date',
                'a_consommer_jusqu_au' => 'nullable|date',
                'rapport_genere' => 'nullable|boolean',
                'note_nucleotide' => 'nullable|string',
                // Add other validation rules as needed
            ]);

            if ($validator->fails()) {
                $errorMessages = [];
                foreach ($validator->errors()->toArray() as $field => $messages) {
                    $errorMessages[] = "$field: " . implode(', ', $messages);
                }
                $errors[] = [
                    'index' => $index,
                    'errors' => $validator->errors()->toArray(),
                    'message' => 'Validation failed: ' . implode('; ', $errorMessages)
                ];
                \Log::warning('Validation failed', [
                    'data' => $item,
                    'errors' => $validator->errors()->toArray()
                ]);
                continue;
            }

            try {
                // Parse date fields from various formats to 'Y-m-d H:i:s'
                $dateFields = [
                    'date_heure_prelevement',
                    'date_heure_reception',
                    'date_mise_en_analyse'
                ];

                foreach ($dateFields as $field) {
                    if (!empty($item[$field])) {
                        try {
                            $dateString = $item[$field];
                            $date = null;
                            
                            // Try different date formats
                            $formats = [
                                'd/m/y H:i',  // 28/08/25 14:30
                                'd/m/Y H:i',  // 28/08/2025 14:30
                                'd/m/y',      // 28/08/25
                                'd/m/Y'       // 28/08/2025
                            ];
                            
                            foreach ($formats as $format) {
                                $date = \DateTime::createFromFormat('!'.$format, $dateString);
                                if ($date) {
                                    // If time wasn't in the format, set it to 00:00:00
                                    if (strpos($format, 'H:i') === false) {
                                        $date->setTime(0, 0, 0);
                                    }
                                    $item[$field] = $date->format('Y-m-d H:i:s');
                                    break;
                                }
                            }
                            
                            // If no format matched, try PHP's strtotime as fallback
                            if (!$date && ($timestamp = strtotime($dateString)) !== false) {
                                $date = new \DateTime();
                                $date->setTimestamp($timestamp);
                                $item[$field] = $date->format('Y-m-d H:i:s');
                            }
                            
                        } catch (\Exception $e) {
                            // If parsing fails, keep the original value
                            \Log::warning("Failed to parse date '{$item[$field]}' for field {$field}: " . $e->getMessage());
                        }
                    }
                }

                $echantillon = EchantillonAnalyse::create($item);
                $created[] = $echantillon;
            } catch (\Exception $e) {
                $errors[] = [
                    'index' => $index,
                    'message' => 'Failed to save record: ' . $e->getMessage()
                ];
            }
        }

        $response = [
            'success' => count($created) > 0,
            'created_count' => count($created),
            'created_ids' => array_map(fn($item) => $item->id, $created),
            'error_count' => count($errors),
        ];

        if (count($errors) > 0) {
            $response['errors'] = $errors;
        }

        $status = count($created) > 0 ? 201 : (count($errors) > 0 ? 422 : 400);

        return response()->json($response, $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
