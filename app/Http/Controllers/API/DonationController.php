<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $query = Donation::query();

            // Optional filters by date
            if ($request->has('start_date') && $request->input('start_date') !== '') {
                $query->whereDate('date_don', '>=', $request->input('start_date'));
            }

            if ($request->has('end_date') && $request->input('end_date') !== '') {
                $query->whereDate('date_don', '<=', $request->input('end_date'));
            }

            $donations = $query->orderBy('date_don', 'desc')->get();

            // Calculate total donations (aggregate on all matches or overall, let's do matching total)
            $total = $query->sum('montant');

            return response()->json([
                'success' => true,
                'data' => $donations,
                'total' => round($total, 2),
                'count' => $donations->count()
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des dons.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0.01',
            'message' => 'nullable|string',
            'date_don' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Données de validation incorrectes.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();
            
            // Set date_don to now if not provided
            if (empty($data['date_don'])) {
                $data['date_don'] = Carbon::now();
            }

            $donation = Donation::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Don enregistré avec succès !',
                'data' => $donation
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible d\'enregistrer le don.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $donation = Donation::find($id);

            if (!$donation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Don non trouvé.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $donation
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération du don.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $donation = Donation::find($id);

            if (!$donation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Don non trouvé.'
                ], 404);
            }

            $donation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Don supprimé avec succès !'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Impossible de supprimer le don.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
