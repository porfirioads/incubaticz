<?php

namespace App\Http\Controllers;

use App\Integrante;
use App\IntegranteProyecto;
use App\Proyecto;
use App\ProyectoHasIntegrante;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\View;
use ZipArchive;

class ProyectoController extends Controller
{
    private function jsonResponse($code, $params)
    {
        $jsonResponse = response()->json($params);
        $jsonResponse->setStatusCode($code);
        return $jsonResponse;
    }

    public function registerProject(Request $request)
    {
        $validator = $this->createProjectValidator($request);

        if ($validator->fails()) {
            return $this->jsonResponse(400, [
                'errors' => $validator->errors()->all(),
                'request' => $request->all()]);
        }

        try {
            $idProyecto = $this->saveProyectoInstance($request);

            return $this->jsonResponse(200, [
                'proyecto_id' => $idProyecto
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse(400, ['errors' => var_dump($e)]);
        }
    }

    private function createProjectValidator(Request $request)
    {
        $rules = [
            'anteproyecto' => ['required', 'mimes:pdf'],
            'abstract' => ['required', 'mimes:pdf'],
            'txtNombreProyecto' => ['required', 'unique:proyecto,titulo'],
            'txtDescripcion' => ['required'],
            'txtImpactoSocial' => ['required'],
            'txtFactibilidad' => ['required'],
            'txtCronograma' => ['required'],
            'txtMetodologia' => ['required'],
            'txtResultados' => ['required'],
            'txtPlanNegocios' => ['required'],
            'numIntegrantes' => ['required']
        ];

        $messages = [
            'anteproyecto.required' => 'El anteproyecto es requerido',
            'anteproyecto.mimes' => 'El anteproyecto debe ser un archivo pdf',
            'abstract.required' => 'El abstract es requerido',
            'abstract.mimes' => 'El abstract debe ser un archivo pdf',
            'numIntegrantes.required' => 'El número de integrantes del proyecto es requerido',
            'txtNombreProyecto.required' => 'El nombre del proyecto es requerido',
            'txtNombreProyecto.unique' => 'El título del proyecto ya existe',
            'txtDescripcion.required' => 'La descripción del proyecto es requerida',
            'txtImpactoSocial.required' => 'El impacto social del proyecto es requerido',
            'txtFactibilidad.required' => 'El análisis de factibilidad del proyecto es requerido',
            'txtCronograma.required' => 'El cronograma de actividades del proyecto es requerido',
            'txtMetodologia.required' => 'La metodología del proyecto es requerido',
            'txtResultados.required' => 'Los resultados esperados del proyecto son requeridos',
            'txtPlanNegocios.required' => 'El plan de negocios del proyecto es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    private function saveProyectoInstance(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->titulo = $request['txtNombreProyecto'];
        $proyecto->descripcion = $request['txtDescripcion'];
        $proyecto->impacto = $request['txtImpactoSocial'];
        $proyecto->factibilidad = $request['txtFactibilidad'];
        $proyecto->cronograma = $request['txtCronograma'];
        $proyecto->metodologia = $request['txtMetodologia'];
        $proyecto->resultados = $request['txtResultados'];
        $proyecto->plan_negocios = $request['txtPlanNegocios'];

        $proyecto->save();

        $anteproyecto = $request->file('anteproyecto');
        $anteproyectoName = 'anteproyecto_' . $proyecto->id . '.pdf';
        $this->saveFile($anteproyecto, 'solicitudes', $anteproyectoName);
        $proyecto->anteproyecto = $anteproyectoName;

        $abstract = $request->file('abstract');
        $abstractName = 'abstract_' . $proyecto->id . '.pdf';
        $this->saveFile($abstract, 'solicitudes', $abstractName);

        $proyecto->abstract = $abstractName;
        $proyecto->save();

        return $proyecto->id;
    }

    public function deleteProject(Request $request)
    {
        $rules = [
            'proyecto_id' => ['required']
        ];

        $messages = [
            'proyecto_id.required' => 'El id del proyecto es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return $this->jsonResponse(400, [
                'errors' => $validator->errors()->all(),
                'request' => $request->all()]);
        }

        try {
            $proyecto = Proyecto::find($request['proyecto_id']);

            if ($proyecto) {
                $phis = ProyectoHasIntegrante::where('proyecto_id', '=',
                    $proyecto->id)->get();

                $integranteIds = [];

                foreach ($phis as $phi) {
                    array_push($integranteIds, $phi->integrante_id);
                }

                ProyectoHasIntegrante::where('proyecto_id', '=',
                    $proyecto->id)->delete();


                Integrante::whereIn('id', $integranteIds)
                    ->delete();

                $proyecto->delete();

                return $this->jsonResponse(200, [
                    'message' => 'Proyecto eliminado correctamente'
                ]);
            }

            return $this->jsonResponse(200, [
                'message' => 'El proyecto ya no existe'
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse(400, ['errors' => var_dump($e)]);
        }
    }

    public function registerIntegrante(Request $request)
    {
        $numIntegrante = $request['numIntegrante'];
        $validator = $this->createIntegranteValidator($request, $numIntegrante);

        if ($validator->fails()) {
            return $this->jsonResponse(400, [
                'errors' => $validator->errors()->all(),
                'request' => $request->all()]);
        }

        $idProyecto = $request['proyectoId'];

        try {
            $idIntegrante = $this->saveIntegranteInstance($request,
                $numIntegrante, $idProyecto);

            return $this->jsonResponse(200, [
                'integrante_id' => $idIntegrante
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse(400, ['errors' => var_dump($e)]);
        }
    }

    private function createIntegranteValidator(Request $request, $numIntegrante)
    {
        $rules = [
            'numIntegrante' => ['required'],
            'proyectoId' => ['required'],
            'nombreIntegrante' => 'required',
            'priApellido' => 'required',
            'fechaNacimiento' => 'required',
            'nivelEstudios' => 'required',
            'email' => ['required', 'email', 'unique:integrante,email'],
            'carrera' => 'required',
            'universidad' => 'required',
            'titulo' => ['required', 'mimes:pdf'],
            'constanciaEstudios' => ['required', 'mimes:pdf'],
            'constanciaObligaciones' => ['required', 'mimes:pdf'],
            'ine' => ['required', 'mimes:pdf'],
            'curp' => ['required', 'mimes:pdf'],
            'oficioProtesta' => ['required', 'mimes:pdf'],
            'rfc' => ['required', 'mimes:pdf'],
            'cartaSat' => ['required', 'mimes:pdf']
        ];

        $messages = [
            'nombreIntegrante.required' => 'El nombre del integrante ' .
                $numIntegrante . ' es requerido',
            'priApellido.required' => 'El primer apellido del integrante ' .
                $numIntegrante . ' es requerido',
            'fechaNacimiento.required' => 'La fecha de nacimiento del ' .
                'integrante ' . $numIntegrante . ' es requerida',
            'nivelEstudios.required' => 'El nivel de estudios del integrante ' .
                $numIntegrante . ' es requerido',
            'email.required' => 'El email del integrante ' . $numIntegrante .
                ' es requerido',
            'email.email' => 'El email del integrante ' . $numIntegrante .
                ' tiene un formato incorrecto',
            'email.unique' => 'El email del integrante ' . $numIntegrante .
                ' ya está siendo usado',
            'carrera.required' => 'La carrera del integrante ' .
                $numIntegrante . ' es requerida',
            'universidad.required' => 'La universidad del integrante ' .
                $numIntegrante . ' es requerida',
            'titulo.required' => 'El título profesional del integrante ' .
                $numIntegrante . ' es requerido',
            'titulo.mimes' => 'El título profesional del integrante ' .
                $numIntegrante . ' debe ser un archivo pdf',
            'constanciaEstudios.required' => 'La constancia de estudios ' .
                'del integrante ' . $numIntegrante . ' es requerida',
            'constanciaEstudios.mimes' => 'La constancia de estudios ' .
                'del integrante ' . $numIntegrante . ' debe ser un archivo pdf',
            'constanciaObligaciones.required' => 'La constancia de ' .
                'obligaciones del integrante ' . $numIntegrante .
                ' es requerida',
            'constanciaObligaciones.mimes' => 'La constancia de ' .
                'obligaciones del integrante ' . $numIntegrante .
                ' debe ser un archivo pdf',
            'ine.required' => 'La INE del integrante ' . $numIntegrante .
                ' es requerida',
            'ine.mimes' => 'La INE del integrante ' . $numIntegrante .
                ' debe ser un archivo pdf',
            'curp.required' => 'La CURP del integrante ' . $numIntegrante .
                ' es requerida',
            'curp.mimes' => 'La CURP del integrante ' . $numIntegrante .
                ' debe ser un archivo pdf',
            'oficioProtesta.required' => 'El oficio bajo protesta de decir ' .
                'verdad del integrante ' . $numIntegrante . ' es requerido',
            'oficioProtesta.mimes' => 'El oficio bajo protesta de decir ' .
                'verdad del integrante ' . $numIntegrante .
                ' debe ser un archivo pdf',
            'rfc.required' => 'El rfc del integrante ' . $numIntegrante .
                ' es requerido',
            'rfc.mimes' => 'El rfc del integrante ' . $numIntegrante .
                ' debe ser un archivo pdf',
            'cartaSat.required' => 'La carta de opinión positiva del SAT ' .
                'del integrante ' . $numIntegrante . ' es requerida',
            'cartaSat.mimes' => 'La carta de opinión positiva del SAT ' .
                'del integrante ' . $numIntegrante . ' debe ser un archivo pdf'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    private function saveIntegranteInstance(Request $request, $numIntegrante,
                                            $idProyecto)
    {
        $integrante = new Integrante();
        $integrante->nombre = $request['nombreIntegrante'];
        $integrante->pri_apellido = $request['priApellido'];
        $integrante->seg_apellido = $request['segApellido'];
        $integrante->email = $request['email'];
        $integrante->nacimiento = $request['fechaNacimiento'];
        $integrante->nivel_estudio = $request['nivelEstudios'];
        $integrante->carrera = $request['carrera'];
        $integrante->universidad = $request['universidad'];

        $integrante->save();

        $titulo = $request->file('titulo');
        $tituloName = 'titulo_' . $integrante->id . '.pdf';
        $constanciaEstudios = $request->file('constanciaEstudios');
        $constanciaEstudiosName = 'constanciaEstudios_' . $integrante->id . '.pdf';
        $constanciaObligaciones = $request->file('constanciaObligaciones');
        $constanciaObligacionesName = 'constanciaObligaciones_' .
            $integrante->id . '.pdf';
        $ine = $request->file('ine');
        $ineName = 'ine_' . $integrante->id . '.pdf';
        $curp = $request->file('curp');
        $curpName = 'curp_' . $integrante->id . '.pdf';
        $oficioProtesta = $request->file('oficioProtesta');
        $oficioProtestaName = 'oficioProtesta_' . $integrante->id . '.pdf';
        $rfc = $request->file('rfc');
        $rfcName = 'rfc_' . $integrante->id . '.pdf';
        $cartaSat = $request->file('cartaSat');
        $cartaSatName = 'cartaSat_' . $integrante->id . '.pdf';
        $this->saveFile($titulo, 'solicitudes', $tituloName);
        $this->saveFile($constanciaEstudios, 'solicitudes',
            $constanciaEstudiosName);
        $this->saveFile($constanciaObligaciones, 'solicitudes',
            $constanciaObligacionesName);
        $this->saveFile($ine, 'solicitudes', $ineName);
        $this->saveFile($curp, 'solicitudes', $curpName);
        $this->saveFile($oficioProtesta, 'solicitudes', $oficioProtestaName);
        $this->saveFile($rfc, 'solicitudes', $rfcName);
        $this->saveFile($cartaSat, 'solicitudes', $cartaSatName);

        $integrante->titulo_profesional = $tituloName;
        $integrante->constancia_estudios = $constanciaEstudiosName;
        $integrante->constancia_obligaciones = $constanciaObligacionesName;
        $integrante->ine = $ineName;
        $integrante->curp = $curpName;
        $integrante->protesta_verdad = $oficioProtestaName;
        $integrante->rfc = $rfcName;
        $integrante->carta_sat = $cartaSatName;

        $integrante->save();

        $integranteProyecto = new IntegranteProyecto();
        $integranteProyecto->proyecto_id = $idProyecto;
        $integranteProyecto->integrante_id = $integrante->id;

        $integranteProyecto->rol = $numIntegrante == 1 ? 'Encargado' : 'Miembro';

        $integranteProyecto->save();

        return $integrante->id;
    }

    private function saveFile($requestFile, $folder, $newName)
    {
        $requestFile->move(
            base_path() . '/public/' . $folder, $newName
        );
    }

    public function showProyectosPage(Request $request)
    {
        $proyectos = DB::table('proyecto as p')
            ->join('proyecto_has_integrante as pi', 'p.id', '=',
                'pi.proyecto_id')
            ->join('integrante as i', 'i.id', '=', 'pi.integrante_id')
            ->where('pi.rol', '=', 'Encargado')
            ->select(['p.titulo', 'i.nombre', 'i.pri_apellido',
                'i.seg_apellido', 'i.email', 'pi.rol', 'p.id as proyecto_id'])
            ->get();

        return View::make('proyectos')->with(['proyectos' => $proyectos]);
    }

    private function getProjectFileNames($projectId)
    {
        $projectFiles = [];
        $proyecto = Proyecto::find($projectId);
        array_push($projectFiles, $proyecto->anteproyecto);
        array_push($projectFiles, $proyecto->abstract);

        $integrantes = DB::table('integrante as i')
            ->join('proyecto_has_integrante as pi',
                'i.id', '=', 'pi.integrante_id')
            ->where('pi.proyecto_id', '=', $projectId)
            ->select(['i.titulo_profesional', 'i.constancia_estudios',
                'i.constancia_obligaciones', 'i.ine', 'i.curp',
                'i.protesta_verdad', 'i.rfc', 'i.carta_sat'])
            ->get();

        foreach ($integrantes as $integrante) {
            array_push($projectFiles, $integrante->titulo_profesional);
            array_push($projectFiles, $integrante->constancia_estudios);
            array_push($projectFiles, $integrante->constancia_obligaciones);
            array_push($projectFiles, $integrante->ine);
            array_push($projectFiles, $integrante->curp);
            array_push($projectFiles, $integrante->protesta_verdad);
            array_push($projectFiles, $integrante->rfc);
            array_push($projectFiles, $integrante->carta_sat);
        }

        return $projectFiles;
    }

    public function downloadProjectFiles(Request $request, $projectId)
    {
        $dir = base_path() . '/public/solicitudes';
        $zip = new ZipArchive();
        $zipFileName = 'Proyecto_' . $projectId . '.zip';
        $zipFullPath = $dir . '/' . $zipFileName;

        if (file_exists($zipFullPath)) {
            unlink($zipFullPath);
        }

        if ($zip->open($zipFullPath, ZipArchive::CREATE) === TRUE) {
            $projectFiles = $this->getProjectFileNames($projectId);

            foreach ($projectFiles as $projectFile) {
                $zip->addFile($dir . '/' . $projectFile, $projectFile);
            }

            $zip->close();
        }

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        if (file_exists($zipFullPath)) {
            return response()->download($zipFullPath, $zipFileName, $headers);
        }

        return $this->jsonResponse(400, [
            'errors' => ['Error al crear el zip']
        ]);
    }

    public function getProponentesList(Request $request)
    {
        $proponentes = DB::table('proyecto as p')
            ->join('proyecto_has_integrante as pi', 'p.id', '=', 'pi.proyecto_id')
            ->join('integrante as i', 'i.id', '=', 'pi.integrante_id')
            ->select(['i.id as integrante_id', 'i.nombre', 'i.pri_apellido',
                'i.seg_apellido', 'i.email', 'i.nacimiento', 'i.nivel_estudio',
                'i.carrera', 'i.universidad', 'p.titulo as proyecto'])
            ->get();

        return $this->jsonResponse(200, $proponentes);
    }
}
