<?php

namespace App\Livewire\Crm\Lead;

use Aaran\Common\Models\Common;
use Aaran\Crm\Models\Enquiry;
use Aaran\Crm\Models\Lead;

//use App\Livewire\Trait\CommonTraitNew;
use App\Livewire\Forms\CommonForm;
use App\Livewire\Forms\GetListForm;
use App\Livewire\Trait\CommonTraitNew;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Upsert extends Component
{
//    use CommonTraitNew;

    public CommonForm $common;


    #region[property]
    public $vid;
    public $title;
    public $body = '';
    public $lead_id;
    public $enquiry_id;
    public $enquiry_data;
    public $verified_by;
    public $active_id;

//    public $status_id;
    public bool $showAttemptModal = false;

    public $questions = [
        'question1' => '',
        'question2' => '',
        'question3' => '',
        'question4' => '',
        'question5' => '',
        'question6' => '',
        'question7' => '',
    ];

    #endregion

    #region[Rules]
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required|min:5',
            'questions.question1' => 'nullable|string',
            'questions.question2' => 'nullable|string',
            'questions.question3' => 'nullable|string',
            'questions.question4' => 'nullable|string',
            'questions.question5' => 'nullable|string',
            'questions.question6' => 'nullable|string',
            'questions.question7' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ' Mention The :attribute',
            'body.required' => ' :attribute is required. ',

        ];
    }

    public function validationAttributes()
    {
        return [
            'title' => 'Lead',
            'body' => 'Description',
        ];
    }
    #endregion

    #region[Mount]
    public function mount($id)
    {
        if ($id != 0) {
            $obj = Lead::find($id);
            $this->vid = $obj->id;
            $this->enquiry_id = $obj->enquiry_id;
            $this->title = $obj->title;
            $this->lead_id = $obj->lead_id;
            $this->body = $obj->body;
            $this->softwareType_id = $obj->softwareType_id;
            $this->questions = $obj->questions;
            $this->verified_by = $obj->verified_by;
            $this->active_id = $obj->active_id;
        }
    }
    #endregion

    #region[getSave]
    public function save()
    {
        if ($this->vid == '') {
            $this->validate($this->rules());
            $lead = Lead::create([
                'enquiry_id' => $this->enquiry_id?:1,
                'title' => $this->title,
                'lead_id' => $this->lead_id ?: 1,
                'body' => $this->body,
                'softwareType_id' => $this->softwareType_id ?: 1,
                'questions' => json_encode($this->questions),
                'verified_by' => $this->verified_by ?: 1,
                'active_id' => 1
            ]);
            $message = "Saved";
//            $this->getRoute();
            return redirect()->route('leads.fresh', ['id' => $lead->enquiry_id]);
        } else {

            $obj = Lead::find($this->vid);
            $obj->enquiry_id = $this->enquiry_id;
            $obj->title = $this->title;
            $obj->lead_id = $this->lead_id;
            $obj->body = $this->body;
            $obj->softwareType_id = $this->softwareType_id;
            $obj->questions = json_encode($this->questions);
            $obj->verified_by = $this->verified_by ?: 1;
            $obj->save();
            $this->clearFields();
            $message = "Updated";

        }
        $this->dispatch('notify', ...['type' => 'success', 'content' => $message . ' Successfully']);
//        $this->getBack();
//        return redirect()->route('leads', ['id' => $this->enquiry_id]);
        return redirect()->route('leads.fresh', ['id' => $obj->enquiry_id]);


    }
    #endregion

//    #region[getObj]
    public function getObj($id)
    {
        if ($id) {
            $obj = Lead::find($id);
            $this->vid = $obj->id;
            $this->title = $obj->title;
            $this->lead_id = $obj->lead_id;
            $this->body = $obj->body;
            $this->enquiry_id = $obj->enquiry_id ?: 1;
            $this->softwareType_id = $obj->softwareType_id;
            $this->softwareType_name = Common::find($obj->softwareType_id)->vname;
//            $this->status_id = $obj->status_id;
            $this->questions = json_decode($obj->questions, true) ?? $this->questions;
            $this->verified_by = $obj->verified_by;
            $this->active_id = $obj->active_id;
            return $obj;
        }
        return null;
    }
    #endregion

    #region[Clear Fields]
    public function clearFields(): void
    {
        $this->common->vid = '';
        $this->common->vname = '';
        $this->common->active_id = '1';
        $this->lead_id = '';
        $this->body = '';
        $this->enquiry_id = '';
        $this->softwareType_id = '';
        $this->softwareType_name = '';
//        $this->status_id = '';
        $this->questions = [
            'question1' => null,
            'question2' => null,
            'question3' => null,
            'question4' => null,
            'question5' => null,
            'question6' => null,
            'question7' => null,
        ];
        $this->verified_by = '';

    }
#endregion
    #region[softwareType]
    public $softwareType_id = '';
    public $softwareType_name = '';
    public Collection $softwareTypeCollection;
    public $highlightSoftwareType = 0;
    public $softwareTypeTyped = false;

    public function decrementSoftwareType(): void
    {
        if ($this->highlightSoftwareType === 0) {
            $this->highlightSoftwareType = count($this->softwareTypeCollection) - 1;
            return;
        }
        $this->highlightSoftwareType--;
    }

    public function incrementSoftwareType(): void
    {
        if ($this->highlightSoftwareType === count($this->softwareTypeCollection) - 1) {
            $this->highlightSoftwareType = 0;
            return;
        }
        $this->highlightSoftwareType++;
    }

    public function setSoftwareType($name, $id): void
    {
        $this->softwareType_name = $name;
        $this->softwareType_id = $id;
        $this->getSoftwareTypeList();
    }

    public function enterSoftwareType(): void
    {
        $obj = $this->softwareTypeCollection[$this->highlightSoftwareType] ?? null;

        $this->softwareType_name = '';
        $this->softwareTypeCollection = Collection::empty();
        $this->highlightSoftwareType = 0;

        $this->softwareType_name = $obj['vname'] ?? '';
        $this->softwareType_id = $obj['id'] ?? '';
    }

    public function refreshSoftwareType($v): void
    {
        $this->softwareType_id = $v['id'];
        $this->softwareType_name = $v['name'];
        $this->softwareTypeTyped = false;
    }

    public function softwareTypeSave($name)
    {
        $obj = Common::create([
            'label_id' => 26,
            'vname' => $name,
            'active_id' => '1'
        ]);
        $v = ['name' => $name, 'id' => $obj->id];
        $this->refreshSoftwareType($v);
    }

    public function getSoftwareTypeList(): void
    {
        $this->softwareTypeCollection = $this->softwareType_name ?
            Common::search(trim($this->softwareType_name))->where('label_id', '=', '26')->get() :
            Common::where('label_id', '=', '26')->orWhere('label_id', '=', '1')->get();
    }

#endregion


    #region[Render]
    public function render()
    {
        $this->getSoftwareTypeList();
        return view('livewire.crm.lead.upsert');
    }
    #endregion

    #region[Route]
    public function getRoute(): void
    {
        $this->redirect(route('leads'));
    }
    #endregion

    #region[route]
    public function getBack()
    {
        return redirect()->route('leads.fresh', [$this->enquiry_id]);
    }
    #endregion


}
