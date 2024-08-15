<?php

namespace App\Livewire;

use App\Models\Region;
use App\Models\Scale;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageTournament extends Component
{
    use WithFileUploads;

    public $positionDocument;
    public $applicationDocument;
    public $name;
    public $region;
    public $age_from;
    public $age_to;
    public $date_commission;
    public $tatami;
    public $KY_up_to_8;
    public $KY_from_8;
    public $fight_for_third_place = false;
    public $price;
    public $address;
    public $date;
    public $scale;
    public $tournamentId;
    public $regulation_document;
    public $application_document;

    protected array $rules = [
        'name' => 'required|string|max:255',
        'region' => 'required|exists:regions,id',
        'scale' => 'required|exists:scales,id',
        'age_from' => 'required|integer|min:0',
        'age_to' => 'required|integer|min:0',
        'date_commission' => 'required|date',
        'tatami' => 'required|integer|min:1',
        'price' => 'required|integer|min:0',
        'address' => 'required|string|max:255',
        'date' => 'required|date',
    ];

    protected $messages = [
        'name.required' => 'Поле "Название турнира" обязательно для заполнения.',
        'name.string' => 'Поле "Название турнира" должно быть строкой.',
        'name.max' => 'Поле "Название турнира" не должно превышать 255 символов.',
        'region.required' => 'Поле "Регион" обязательно для заполнения.',
        'region.exists' => 'Выбранный регион недействителен.',
        'scale.required' => 'Поле "Масштаб" обязательно для заполнения.',
        'scale.exists' => 'Выбранный масштаб недействителен.',
        'age_from.required' => 'Поле "Возраст от" обязательно для заполнения.',
        'age_from.integer' => 'Поле "Возраст от" должно быть числом.',
        'age_from.min' => 'Поле "Возраст от" должно быть не меньше 0.',
        'age_to.required' => 'Поле "Возраст до" обязательно для заполнения.',
        'age_to.integer' => 'Поле "Возраст до" должно быть числом.',
        'age_to.min' => 'Поле "Возраст до" должно быть не меньше 0.',
        'date_commission.required' => 'Поле "Дата комиссии" обязательно для заполнения.',
        'date_commission.date' => 'Поле "Дата комиссии" должно быть датой.',
        'tatami.required' => 'Поле "Татами" обязательно для заполнения.',
        'tatami.integer' => 'Поле "Татами" должно быть числом.',
        'tatami.min' => 'Поле "Татами" должно быть не меньше 1.',
        'price.required' => 'Поле "Цена" обязательно для заполнения.',
        'price.integer' => 'Поле "Цена" должно быть числом.',
        'price.min' => 'Поле "Цена" должно быть не меньше 0.',
        'address.required' => 'Поле "Адрес" обязательно для заполнения.',
        'address.string' => 'Поле "Адрес" должно быть строкой.',
        'address.max' => 'Поле "Адрес" не должно превышать 255 символов.',
        'date.required' => 'Поле "Дата" обязательно для заполнения.',
        'date.date' => 'Поле "Дата" должно быть датой.',
    ];

    public function uploadPositionDocument()
    {
        $this->validate([
            'positionDocument' => 'required|mimes:pdf,doc,docx|max:10240', // ограничение на тип файла и размер
        ]);
        $this->positionDocument->store('documents'); // сохранение в папку "documents"

    }

    public function uploadApplicationDocument()
    {
        $this->validate([
            'applicationDocument' => 'required|mimes:pdf,doc,docx|max:10240', // ограничение на тип файла и размер
        ]);

        $this->applicationDocument->store('documents'); // сохранение в папку "documents"
    }

    public function editTournament($id)
    {
        $tournament = \App\Models\ManageTournament::find($id);

        $this->tournamentId = $tournament->id;
        $this->name = $tournament->name;
        $this->region = $tournament->region_id;
        $this->scale = $tournament->scale_id;
        $this->tatami = $tournament->tatami;

        $this->age_from = $tournament->age_from;
        $this->age_to = $tournament->age_to;
        $this->fight_for_third_place = (bool) $tournament->fight_for_third_place;
        $this->KY_up_to_8 = (bool) $tournament->KY_up_to_8;
        $this->KY_from_8 = (bool) $tournament->KY_from_8;

        $this->date_commission = $tournament->date_commission;
        $this->price = $tournament->price;
        $this->address = $tournament->address;
        $this->date = $tournament->date;
        $this->regulation_document = $tournament->regulation_document;
        $this->application_document = $tournament->application_document;

        $this->dispatch('openEditForm');
    }

    public function updateTournament()
    {
        $tournament = \App\Models\ManageTournament::find($this->tournamentId);

        $positionDocumentPath = $this->positionDocument ? $this->positionDocument->store('documents', 'public') : null;
        $applicationDocumentPath = $this->applicationDocument ? $this->applicationDocument->store('documents', 'public') : null;

        $tournament->update([
            'name' => $this->name,
            'region_id' => $this->region,
            'scale_id' => $this->scale,
            'tatami' => $this->tatami,
            'fight_for_third_place' => $this->fight_for_third_place,
            'age_from' => $this->age_from,
            'age_to' => $this->age_to,
            'KY_up_to_8' => $this->KY_up_to_8,
            'KY_from_8' => $this->KY_from_8,
            'date_commission' => $this->date_commission,
            'price' => $this->price,
            'address' => $this->address,
            'date' => $this->date,
            "regulation_document" => $positionDocumentPath,  // Сохраняем путь к положению
            "application_document" => $applicationDocumentPath  // Сохраняем путь к заявлению
        ]);

    }


    public function create()
    {
        $this->validate();

        // Загрузите документы и получите пути к ним
        $positionDocumentPath = $this->positionDocument ? $this->positionDocument->store('documents', 'public') : null;
        $applicationDocumentPath = $this->applicationDocument ? $this->applicationDocument->store('documents', 'public') : null;

        if ($this->tournamentId) {
            $this->updateTournament();
        } else {
            $tournament = \App\Models\ManageTournament::create([
                "name" => $this->name,
                "region_id" => $this->region,
                "scale_id" => $this->scale,
                "age_from" => $this->age_from,
                "age_to" => $this->age_to,
                "date_commission" => $this->date_commission,
                "tatami" => $this->tatami,
                "KY_up_to_8" => $this->KY_up_to_8,
                "KY_from_8" => $this->KY_from_8,
                "fight_for_third_place" => $this->fight_for_third_place,
                "price" => $this->price,
                "address" => $this->address,
                "date" => $this->date,
                "organization_id" => auth()->id(),
                "regulation_document" => $positionDocumentPath,  // Сохраняем путь к положению
                "application_document" => $applicationDocumentPath  // Сохраняем путь к заявлению
            ]);
        }

        // Извлечение списков из сессии
        $lists = session()->pull('lists', []);

        // Сохранение списков с привязкой к турниру
        foreach ($lists as $list) {
            $tournament->lists()->create($list);
        }

        // Очистка сессии от временных списков
        session()->forget('lists');

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->region = '';
        $this->age_from = '';
        $this->age_to = '';
        $this->date_commission = '';
        $this->tatami = '';
        $this->KY_up_to_8 = false;
        $this->KY_from_8 = false;
        $this->fight_for_third_place = false;
        $this->price = '';
        $this->address = '';
        $this->date = '';
        $this->scale = '';
    }

    public function deleteTournament($id)
    {
        $tournament = \App\Models\ManageTournament::find($id);
        $tournament->delete = true;
        $tournament->save();
    }

    public function render()
    {
        $scales = Scale::all();
        $regions = Region::all();
        $manageTournaments = \App\Models\ManageTournament::where('organization_id', auth()->id())->where('delete', false)->with('coaches')->get();
        return view('livewire.manage-tournament', compact('scales', 'regions', 'manageTournaments'));
    }
}
