<?php

namespace App\Http\Controllers;

use App\Proyecto;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ProyectoController extends Controller
{
    private function jsonResponse($code, $params)
    {
        $jsonResponse = response()->json($params);
        $jsonResponse->setStatusCode($code);
        return $jsonResponse;
    }

    private function createNewProjectValidator(Request $request)
    {
        $rules = [
            'anteproyecto' => ['required', 'mimes:pdf'],
            'txtNombreProyecto' => ['required'],
            'txtDescripcion' => ['required'],
            'txtImpactoSocial' => ['required'],
            'txtFactibilidad' => ['required'],
            'txtCronograma' => ['required'],
            'txtMetodologia' => ['required'],
            'txtResultados' => ['required'],
            'txtPlanNegocios' => ['required'],
            'selIntegrantes' => ['required']
        ];

        $messages = [
            'anteproyecto.required' => 'El anteproyecto es requerido',
            'anteproyecto.mimes' => 'El anteproyecto debe ser un archivo pdf',
            'selIntegrantes.required' => 'El número de integrantes del proyecto es requerido',
            'txtNombreProyecto.required' => 'El nombre del proyecto es requerido',
            'txtDescripcion.required' => 'La descripción del proyecto es requerida',
            'txtImpactoSocial.required' => 'El impacto social del proyecto es requerido',
            'txtFactibilidad.required' => 'El análisis de factibilidad del proyecto es requerido',
            'txtCronograma.required' => 'El cronograma de actividades del proyecto es requerido',
            'txtMetodologia.required' => 'La metodología del proyecto es requerido',
            'txtResultados.required' => 'Los resultados esperados del proyecto son requeridos',
            'txtPlanNegocios.required' => 'El plan de negocios del proyecto es requerido',
        ];

        $numIntegrantes = $request['selIntegrantes'];

        if ($numIntegrantes) {
            for ($i = 1; $i <= $numIntegrantes; $i++) {
                $rules['nombreIntegrante' . $i] = 'required';
                $messages['nombreIntegrante' . $i . '.required'] =
                    'El nombre del integrante ' . $i . ' es requerido';
                $rules['priApellido' . $i] = 'required';
                $messages['priApellido' . $i . '.required'] =
                    'El primer apellido del integrante ' . $i . ' es requerido';
                $rules['fechaNacimiento' . $i] = 'required';
                $messages['fechaNacimiento' . $i . '.required'] =
                    'La fecha de nacimiento del integrante ' . $i .
                    ' es requerida';
                $rules['nivelEstudios' . $i] = 'required';
                $messages['nivelEstudios' . $i . '.required'] =
                    'El nivel de estudios del integrante ' . $i .
                    ' es requerido';
                $rules['carrera' . $i] = 'required';
                $messages['carrera' . $i . '.required'] =
                    'La carrera del integrante ' . $i . ' es requerida';
                $rules['carrera' . $i] = 'required';
                $messages['carrera' . $i . '.required'] =
                    'La carrera del integrante ' . $i . ' es requerida';
                $rules['universidad' . $i] = 'required';
                $messages['universidad' . $i . '.required'] =
                    'La universidad del integrante ' . $i . ' es requerida';
                $rules['constanciaEstudios' . $i] = 'required';
                $messages['constanciaEstudios' . $i . '.required'] =
                    'La constancia de estudios del integrante ' . $i .
                    ' es requerida';
                $rules['constanciaObligaciones' . $i] = 'required';
                $messages['constanciaObligaciones' . $i . '.required'] =
                    'La constancia de obligaciones del integrante ' . $i .
                    ' es requerida';
                $rules['ine' . $i] = 'required';
                $messages['ine' . $i . '.required'] =
                    'La INE del integrante ' . $i . ' es requerida';
                $rules['curp' . $i] = 'required';
                $messages['curp' . $i . '.required'] =
                    'La CURP del integrante ' . $i . ' es requerida';
                $rules['oficioProtesta' . $i] = 'required';
                $messages['oficioProtesta' . $i . '.required'] =
                    'El oficio bajo protesta de decir verdad del integrante ' .
                    $i . ' es requerido';
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    public function registrarProyecto(Request $request)
    {
        $validator = $this->createNewProjectValidator($request);

        if ($validator->fails()) {
            return redirect('/registro')
                ->with(['errors' => $validator->errors()->all()])
                ->withInput();
        }

        $this->createProyecto($request);

        return $this->jsonResponse(200, $request->all());
    }

    private function createProyecto(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->titulo = $request['txtNombreProyecto'];
        $proyecto->descripcion = $request['txtDescripcion'];
        $proyecto->impactoSocial = $request['txtImpactoSocial'];
        $proyecto->factibilidad = $request['txtFactibilidad'];
        $proyecto->cronograma = $request['txtCronograma'];
        $proyecto->metodologia = $request['txtMetodologia'];
        $proyecto->resultados = $request['txtResultados'];
        $proyecto->plan_negocios = $request['txtPlanNegocios'];

        $proyecto->save();

        $anteproyecto = $request->file('anteproyecto');
        $anteproyectoName = 'anteproyecto_' . $proyecto->id . '.pdf';

        $this->saveFile($anteproyecto, 'solicitudes', $anteproyectoName);
    }

    private function saveFile($requestFile, $folder, $newName)
    {
        $requestFile->move(
            base_path() . '/public/' . $folder, $newName
        );
    }
}
