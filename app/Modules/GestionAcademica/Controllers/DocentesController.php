<?php

namespace App\Modules\GestionAcademica\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\GestionAcademica\Services\DocentesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocentesController extends Controller
{
    public function __construct(protected DocentesService $service) {}

    public function index(Request $request): JsonResponse
    {
        $items = $this->service->paginate($request->integer('per_page', 15), $request->only(['cod_docente','carrera']));
        return response()->json(['success'=>true,'data'=>$items]);
    }

    public function show($id): JsonResponse
    {
        $item = $this->service->find($id);
        if (!$item) return response()->json(['success'=>false,'message'=>'Docente no encontrado'],404);
        return response()->json(['success'=>true,'data'=>$item]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'cod_docente' => 'required|string|max:20|unique:docente,cod_docente',
            'nit' => 'nullable|string|max:30',
            'maestria' => 'nullable|string|max:100',
            'carrera' => 'required|string|max:100',
            'id_usuario' => 'required|exists:usuario,id_usuario',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $item = $this->service->create($v->validated());
        return response()->json(['success'=>true,'message'=>'Docente registrado','data'=>$item],201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $exists = $this->service->find($id);
        if (!$exists) return response()->json(['success'=>false,'message'=>'Docente no encontrado'],404);
        $v = Validator::make($request->all(), [
            'cod_docente' => 'string|max:20|unique:docente,cod_docente,'.$id.',id_docente',
            'nit' => 'nullable|string|max:30',
            'maestria' => 'nullable|string|max:100',
            'carrera' => 'string|max:100',
            'id_usuario' => 'exists:usuario,id_usuario',
        ]);
        if ($v->fails()) return response()->json(['success'=>false,'errors'=>$v->errors()],422);
        $item = $this->service->update($id, $v->validated());
        return response()->json(['success'=>true,'message'=>'Docente actualizado','data'=>$item]);
    }

    public function destroy($id): JsonResponse
    {
        if (!$this->service->delete($id)) return response()->json(['success'=>false,'message'=>'Docente no encontrado'],404);
        return response()->json(['success'=>true,'message'=>'Docente eliminado']);
    }
}

