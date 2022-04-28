<?php

namespace Database\Seeders;

use App\Models\MedicalReport;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;

class MedicalReportSeeder extends Seeder
{
    public function run()
    {

        // DataType
        $dataType = $this->dataType('slug', 'medical_reports');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'medical_reports',
                'display_name_singular' => 'Historia Clínica',
                'display_name_plural'   => 'Historias Clínicas',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\\Models\\MedicalReport',
                'policy_name'           => '',
                'server_side'           => false,
                'controller'            => 'App\\Http\\Controllers\\MedicalReportController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        // Menus
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Historias Clínicas',
            'url'     => '',
            'route'   => 'voyager.medical_reports.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 31,
            ])->save();
        }


        Permission::generateFor('medical_reports');

        $order = 0;

        $genericDataType = DataType::where('slug', 'medical_reports')->firstOrFail();

        $dataRow = $this->dataRow($genericDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'id',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => $order++,
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'code');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Código',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 1,
                'delete'       => 0,
                'order'        => $order++,
                'details'      => [
                    'display' => [
                        'id' => 'code_field',
                    ],
                    
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'date_start');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'date',
                'display_name' => 'Fecha Ingreso',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'reason');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => 'Motivo de Consulta',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => []
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'patient_id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'patient_id',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => []
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'patient_relationship');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'relationship',
                'display_name' => 'Paciente',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => [
                    'model'       => 'App\\Models\\Patient',
                    'table'       => 'patients',
                    'type'        => 'belongsTo',
                    'column'      => 'patient_id',
                    'key'         => 'id',
                    'label'       => 'full_name_patient',
                ]
            ])->save();
        }
    }

    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }

    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
