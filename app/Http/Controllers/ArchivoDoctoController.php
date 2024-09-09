<?php

namespace App\Http\Controllers;

use App\Models\ArchivoDocto;
use App\Models\Archivo;
use App\Models\Documento;
use App\Models\Trabajador;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class ArchivoDoctoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function Template(Request $request)
    {
        $trabajadorId = $request->trabajador_id;  // ID del trabajador pasado en la solicitud
        $idTemplate = $request->template_id;      // ID del template (puedes ajustar esto si es necesario)
        $periodoId = $request->periodo_id;        // ID del periodo pasado en la solicitud

    // Unir las tablas y aplicar el where por periodo_id
    $trabajador = Trabajador::where('trabajadors.id', $trabajadorId)
        ->join('t_periodo_trabajadores', function($join) use ($periodoId, $trabajadorId) {
            $join->on('trabajadors.id', '=', 't_periodo_trabajadores.trabajador_id')
                 ->where('t_periodo_trabajadores.t_periodo_id', '=', $periodoId)
                 ->where('t_periodo_trabajadores.trabajador_id', '=', $trabajadorId);
        })
        ->join('r_contratos', 't_periodo_trabajadores.r_contrato_id', '=', 'r_contratos.id')
        ->join('empresas', 'r_contratos.empresa_id', '=', 'empresas.id')
        ->join('t_representantes', 'empresas.id', '=', 't_representantes.empresa_id') // Se agrega el join con t_representantes
        ->join('pais as pais_empresa', 'empresas.pais_id', '=', 'pais_empresa.id') // Join entre trabajadores y paises
        ->join('pais as pais_representante', 't_representantes.pais_id', '=', 'pais_representante.id') // Join entre t_representantes y paises
        ->join('pais as pais_trabajador', 'trabajadors.pais_id', '=', 'pais_trabajador.id') // Join entre t_representantes y paises
        ->select('trabajadors.id','trabajadors.nombre',
        'trabajadors.a_paterno', 'trabajadors.a_materno',
        'trabajadors.rut', 'empresas.nombre as empresa_nombre',
        'r_contratos.f_inicio as f_incio_contrato',
        't_representantes.p_nombre as representante_p_nombre',
        't_representantes.p_nombre as representante_s_nombre',
        't_representantes.a_paterno as representante_a_paterno',
        't_representantes.a_materno as representante_a_materno',
        't_representantes.direccion as representante_direccion',
        'pais_empresa.nombre as pais_emperesa',   // Nombre del país del trabajador
        'pais_representante.nombre as pais_representante'  // Nombre del país del representante
        )
        ->first();
        
        // Si no existe el trabajador, retornar un error
        if (!$trabajador) {
            return response()->json(['error' => 'Trabajador no encontrado'], 404);
        }
        
        
        // Obtener el contenido del HTML desde la base de datos
        $template = Template::find($idTemplate); 
        $contenidoHtml = $template->contenido;

        function formatearRut($rut) {
            $rut = preg_replace('/[^k0-9]/i', '', $rut); // Elimina cualquier carácter que no sea numérico o 'k'
            $dv = substr($rut, -1); // Obtiene el dígito verificador (último carácter)
            $numero = substr($rut, 0, strlen($rut) - 1); // Obtiene el número del RUT
            
            // Formatea el número del RUT con puntos
            $formateado = number_format($numero, 0, '', '.') . '-' . $dv;
        
            return $formateado;
        }
        // Reemplazar los placeholders con los datos del trabajador
        $htmlConReemplazos = str_replace(
            ['{{nombre_trabajador}}',
             '{{a_paterno_trabajador}}',
             '{{a_materno_trabajador}}',
             '{{nombre_completo_trabajador}}',
             '{{rut_trabajador}}',
             '{{nombre_empresa}}',
             '{{f_inicio_contrato}}',
             '{{nombre_completo_representante}}',
             '{{representante_direccion}}',
             '{{empresa_pais}}',
             '{{representante_pais}}'
            ],
            [$trabajador->nombre,
             $trabajador->a_paterno,
             $trabajador->a_materno,
             $trabajador->nombre . ' ' . $trabajador->a_paterno . ' ' . $trabajador->a_materno,
              formatearRut($trabajador->rut),
              $trabajador->empresa_nombre, // Reemplaza el nombre de la empresa
              $trabajador->f_incio_contrato, //
              $trabajador->representante_p_nombre . ' ' . $trabajador->representante_s_nombre . ' ' . $trabajador->representante_a_paterno . ' ' . $trabajador->representante_a_materno,
              $trabajador->representante_direccion,
              $trabajador->pais_empresa,
              $trabajador->pais_representante,
            ],
            $contenidoHtml
        );
    
        // Convertir el contenido a HTML-ENTITIES y UTF-8 para asegurar la correcta codificación
        $htmlConReemplazos = mb_convert_encoding($htmlConReemplazos, 'HTML-ENTITIES', 'UTF-8');
    
        // Renderizar el HTML en un archivo PDF usando dompdf
        try {
            $pdf = Pdf::loadHTML($htmlConReemplazos);
    
            // Definir el nombre del archivo PDF
            $fileName = 'documento_' . $trabajador->nombre . '_' . $trabajador->rut . '.pdf';
            $filePath = 'public/documentos/' . $fileName;
    
            // Asegurarse de que el directorio 'documentos' existe, si no, crearlo
            if (!Storage::exists('public/documentos/')) {
                Storage::makeDirectory('public/documentos/', 0755, true);
            }
    
            // Verificar si el archivo ya existe y agregar un sufijo numérico si es necesario
            $counter = 1;
            $baseFileName = 'documento_' . $trabajador->nombre . '_' . $trabajador->rut;
            while (Storage::exists($filePath)) {
                // Si el archivo ya existe, agregar un número al nombre
                $fileName = $baseFileName . '_' . $counter . '.pdf';
                $filePath = 'public/documentos/' . $fileName;
                $counter++;
            }
    
            // Guardar el archivo PDF en el almacenamiento local
            Storage::put($filePath, $pdf->output());
    
            // Obtener la URL pública para acceder al archivo
            $publicUrl = Storage::url($filePath);
    
            // Guardar los datos relacionados con el archivo en la base de datos
            $archivo = new Archivo();
            $archivo->trabajador_id = $request->trabajador_id;
            $archivo->area_id = $request->area_id;
            $archivo->tipo_archivo_id = $request->tipo_archivo_id;
            $archivo->comentario = $request->comentario;
            $archivo->save();
    
            // Guardar la ruta del documento PDF generado
            $documento = new Documento();
            $documento->path = $publicUrl;
            $documento->save();
    
            // Relacionar el archivo PDF con el archivo actual en la tabla ArchivoDocto
            $ArchivoDocto = new ArchivoDocto();
            $ArchivoDocto->documento_id = $documento->id;
            $ArchivoDocto->archivo_id = $archivo->id;
            $ArchivoDocto->save();
    
            // Devolver la relación creada como respuesta
            return response()->json($ArchivoDocto, 200);
        } catch (\Exception $e) {
            // Capturar cualquier excepción durante el proceso de generación o guardado del PDF
            return response()->json(['error' => 'Error al generar o guardar el PDF: ' . $e->getMessage()], 500);
        }
    }
    
    
    public function store(Request $request, Archivo $archivo)
{
    // Llamar a la función Template para generar y guardar el PDF
    $pdfFileName = $this->Template(); // La función Template devuelve el nombre del archivo PDF

    // Crear una URL para el archivo PDF guardado
    $url = Storage::url('public/documentos/' . $pdfFileName);

    // Guardar el archivo PDF en la base de datos como un Documento
    $archivo = new Archivo();
    $archivo->trabajador_id = $request->trabajador_id;
    $archivo->area_id = $request->area_id;
    $archivo->tipo_archivo_id = $request->tipo_archivo_id;
    $archivo->comentario = $request->comentario;
    $archivo->save();
   
    $documento = new Documento();
    $documento->path = $publicUrl;
    $documento->save();

    // Relacionar el archivo PDF con el archivo actual en la tabla ArchivoDocto
    $ArchivoDocto = new ArchivoDocto();
    $ArchivoDocto->documento_id = $documento->id;
    $ArchivoDocto->archivo_id = $archivo->id;
    $ArchivoDocto->save();

    // Devolver la relación creada
    return $ArchivoDocto;
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        $archivo->archivo_docto = $archivo->ArchivoDoctos()->get()->each(function($i){
            $i->url = $i->documento->UrlDocumento();
        });
        return $archivo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArchivoDocto $archivoDocto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArchivoDocto  $archivoDocto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArchivoDocto $archivoDocto)
    {
        $liquidacionDocto->estado = 0;
        $liquidacionDocto->save();
    
    }
}
