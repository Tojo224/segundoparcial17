<?php

namespace App\Modules\GestionAcademica\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\GestionAcademica\Services\MateriasService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MateriasController extends Controller
{
    public function __construct(protected MateriasService $service) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->service->paginate($request->integer('per_page', 15), $request->only(['sigla','nombre']));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function show($id): JsonResponse
    {
        $item = $this->service->find($id);
        if (!$item) return response()->json(['success'=>false,'message'=>'Materia no encontrada'],404);
        return response()->json(['success'=>true,'data'=>$item]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'sigla' => 'required|string|max:20|unique:materia,sigla',
            'nombre' => 'required|string|max:100',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $item = $this->service->create($v->validated());
        return response()->json(['success'=>true,'message'=>'Materia creada','data'=>$item],201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $exists = $this->service->find($id);
        if (!$exists) return response()->json(['success'=>false,'message'=>'Materia no encontrada'],404);
        $v = Validator::make($request->all(), [
            'sigla' => 'string|max:20|unique:materia,sigla,'.$id.',id_materia',
            'nombre' => 'string|max:100',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $item = $this->service->update($id, $v->validated());
        return response()->json(['success'=>true,'message'=>'Materia actualizada','data'=>$item]);
    }

    public function destroy($id): JsonResponse
    {
        if (!$this->service->delete($id)) return response()->json(['success'=>false,'message'=>'Materia no encontrada'],404);
        return response()->json(['success'=>true,'message'=>'Materia eliminada']);
    }
}

