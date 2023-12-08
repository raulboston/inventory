<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Departamento;
use App\Models\Encargado;
use App\Models\Articulo;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class DatosController extends Controller
{
   

    public function obtenerDatosParaSpinner()
    {
        $aulas = Aula::obtenerAulas();
        $departamentos = Departamento::obtenerDepartamentos();

        return response()->json(['aulas' => $aulas, 'departamentos' => $departamentos], 200);
    }

    function mostrarAulas(){
        return Aula::obtenerAulas();
    }

    function mostrarDepartamentos(){
        return Departamento::obtenerDepartamentos();
    }

    function mostrarArticulos() 
    { 
        return Articulo::all(); 
    }

    public function obtenerArticulosConFiltros(Request $request)
    {
        $query = Articulo::query();

        // Filtro por fecha de agregado (más reciente o más antiguo)
        if ($request->has('orden') && in_array($request->orden, ['asc', 'desc'])) {
            $query->orderBy('fecha_agregado', $request->orden);
        }

        // Filtro por estado (activo o dado de baja)
        if ($request->has('estado') && in_array($request->estado, [1, 0])) {
            $query->where('estado', $request->estado);
        }

        // Obtener los resultados
        $resultados = $query->get();

        return response()->json(['articulos' => $resultados], 200);
    }

    public function obtenerNombreDepartamento($departamentoId)
    {
        $departamento = Departamento::find($departamentoId);

        if ($departamento) {
            return response()->json(['nombre' => $departamento->nombre]);
        } else {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }
    }
    public function obtenerNombreAula($aulaId)
    {
        $aula = Aula::find($aulaId);

        if ($aula) {
            return response()->json(['nombre' => $aula->nombre]);
        } else {
            return response()->json(['error' => 'Aula no encontrada'], 404);
        }
    }
    public function obtenerNombreEncargado($encargadoId)
    {
        $encargado = Encargado::find($encargadoId);

        if ($encargado) {
            $nombreCompleto = $encargado->nombre . ' ' . $encargado->apellido_paterno . ' ' . $encargado->apellido_materno;
            return response()->json(['nombre' => $nombreCompleto]);
        } else {
            return response()->json(['error' => 'Encargado no encontrado'], 404);
        }
    }
    public function consultarPorCodigoBarras($codigo_barras = null)
    {
    if (empty($codigo_barras)) {
        // Si no se proporciona un código de barras, devolver todos los artículos
        $articulo = Articulo::all();
    } else {
        // Si se proporciona un código de barras, buscar el artículo específico
        $articulo = Articulo::where('codigo_barras', $codigo_barras)->get();
    }

    return response()->json($articulo);
    }

    public function loginUsuario($CorreoElectronico)
    {
        // Verificar si el correo electrónico existe
        $usuario = Usuario::where('CorreoElectronico', $CorreoElectronico)->first();
    
        if ($usuario !== null) {
            // El correo electrónico existe, puedes devolver la información del usuario
            return response()->json(['usuario' => $usuario], 200);
        } else {
            // El correo electrónico no existe, devolver un error
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }
    public function registrarUsuario(Request $request)
    {
            $usuario = new Usuario();
            $usuario->Nombre = $request->Nombre;
            $usuario->Apellido = $request->Apellido;
            $usuario->CorreoElectronico = $request->CorreoElectronico;
            $usuario->Contraseña = $request->Contraseña;
            $usuario->Tipo = $request->Tipo;
            $usuario->save();

            return $usuario;
    }

    public function guardarArticulo(Request $request)
    {
        // Crear un nuevo modelo de Articulo
        $articulo = new Articulo();
        $articulo->codigo_barras = $request->codigo_barras;
        $articulo->descripcion = $request->descripcion;
        $articulo->encargado_id = $request->encargado_id;
        $articulo->clasificacion = $request->clasificacion;
        $articulo->aula_id = $request->aula_id;
        $articulo->departamento_id = $request->departamento_id;
        $articulo->estado = $request-> estado;
        $articulo->informacion_adicional = $request->informacion_adicional;
        $articulo->fecha_creacion = $request->fecha_creacion;
        $articulo->fecha_actualizacion = $request->fecha_actualizacion;

        // Guardar el nuevo artículo en la base de datos
        $articulo->save();
        // Retorna una respuesta exitosa
        return $request;
        // return response()->json(['mensaje' => 'Datos recibidos con éxito'], 200);
    }
}
