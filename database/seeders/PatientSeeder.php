<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DataType
        $dataType = $this->dataType('slug', 'patients');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'patients',
                'display_name_singular' => 'Paciente',
                'display_name_plural'   => 'Pacientes',
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\\Models\\Patient',
                'policy_name'           => '',
                'server_side'           => true,
                'controller'            => 'App\\Http\\Controllers\\PatientController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        // Menus
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Pacientes',
            'url'     => '',
            'route'   => 'voyager.patients.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 30,
            ])->save();
        }


        Permission::generateFor('patients');

        $order = 0;

        $genericDataType = DataType::where('slug', 'patients')->firstOrFail();

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

        $dataRow = $this->dataRow($genericDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Nombres',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => [
                    
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'last_name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Apellidos',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => [
                    
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'dni');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Cédula',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => [
                    
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'age');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'Edad',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      =>[

                ]
            ])->save();
        }

        $dataRow = $this->dataRow($genericDataType, 'gender');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => 'Género',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => $order++,
                'details'      => [
                    'default' => 'male',
                    'options' => [
                        'male' => 'Masculino',
                        'female' => 'Femenino'
                    ]
                ]
            ])->save();
        }

        Patient::factory()->count(1000)->create();
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
