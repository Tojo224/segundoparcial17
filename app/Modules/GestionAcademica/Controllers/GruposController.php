<?php

namespace App\Modules\GestionAcademica\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\GestionAcademica\Services\GruposService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GruposController extends Controller
{
    public function __construct(protected GruposService $service) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['codigo','estado','id_materia']);
        $items = $this->service->paginate($request->integer('per_page', 15), $filters);
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function show($id): JsonResponse
    {
        $item = $this->service->find($id);
        if (!$item) return response()->json(['success'=>false,'message'=>'Grupo no encontrado'],404);
        return response()->json(['success'=>true,'data'=>$item]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'codigo' => 'required|string|max:10',
            'estado' => 'boolean',
            'id_materia' => 'required|exists:materia,id_materia',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $data = $v->validated();
        $data['estado'] = array_key_exists('estado', $data) ? (bool) $data['estado'] : true;
        $item = $this->service->create($data);
        return response()->json(['success'=>true,'message'=>'Grupo creado','data'=>$item],201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $exists = $this->service->find($id);
        if (!$exists) return response()->json(['success'=>false,'message'=>'Grupo no encontrado'],404);
        $v = Validator::make($request->all(), [
            'codigo' => 'string|max:10',
            'estado' => 'boolean',
            'id_materia' => 'exists:materia,id_materia',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $item = $this->service->update($id, $v->validated());
        return response()->json(['success'=>true,'message'=>'Grupo actualizado','data'=>$item]);
    }

    public function destroy($id): JsonResponse
    {
        if (!$this->service->delete($id)) return response()->json(['success'=>false,'message'=>'Grupo no encontrado'],404);
        return response()->json(['success'=>true,'message'=>'Grupo eliminado']);
    }
}

