<?php

namespace App\Http\Controllers;
use BaconQrCode\Common\ErrorCorrectionLevel;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use App\Models\Curso;
class RegistroController extends Controller

{
    public function index()
    {
        $registros = Curso::all();
        return view('registros.index', compact('registros'));
    }

    public function show(string $id)
    {
        $datos = Curso::findOrFail($id);
        return view('registros.show', compact('datos'));
    }

    public function generarQR()
    {
        $codigoAleatorio = rand(10000, 99999);
        $nuevoCodigo = $codigoAleatorio;

        return response()->json(['codigo' => $nuevoCodigo]);
    }


    public function scanner()
    {
        return view('registros.scanner');
    }
    
    public function guardarRegistro(Request $request)
    {
        // Obtener el código del formulario
        $codigoQR = $request->input('qr_value');

        // Guardar el nuevo registro en la base de datos
        $Registro = new Curso;
        $Registro->codigo = $codigoQR;
        $Registro->save();

        return redirect()->route('registros.scanner');
    } 
}
