<?php

namespace App\Livewire\Forms;

use Aaran\Crm\Models\Logbook;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CommonForm extends Form
{
    #[Validate]
    public $vname = '';
    public bool $active_id = false;
    public $vid = '';

    public function rules(): array
    {
        return [
            'vname' => 'required|unique:commons,vname',
        ];
    }

    public function messages()
    {
        return [
            'vname.required' => 'The :attribute are missing.',
            'vname.unique' => 'The :attribute is already created.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'vname' => 'name',
        ];
    }

    public function save($model, $extraFields = [])
    {
        $this->validate();
        $model->vname = $this->vname;
        $model->active_id = $this->active_id;
        foreach ($extraFields as $key => $value) {
            $model->$key = $value;
        }
        if ($model->save()) {

            return true;
        }

        return false;
    }

    public function edit($model, $extraFields = [])
    {
        $model->vname = $this->vname;
        $model->active_id = $this->active_id;

        foreach ($extraFields as $key => $value) {
            $model->$key = $value;
        }

        if ($model->save()) {
            return true;
        }

        return false;
    }


    public function logEntry($vname, $action = null, $desc = null): void
    {
        if (!empty($vname)) {
            Logbook::create([
                'vname' => $vname,
                'action' => $action,
                'description' => $desc,
                'user_id' => auth()->id(),
                'active_id' => '1',
            ]);
        }
    }

}
