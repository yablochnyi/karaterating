<?php

namespace App\Livewire;

use App\Models\Region;
use App\Models\Scale;
use Livewire\Component;

class ManageTournament extends Component
{
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

    public function create()
    {
        $this->validate();

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
            "organization_id" => auth()->id()
        ]);

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

    public function render()
    {
        $scales = Scale::all();
        $regions = Region::all();
        $manageTournaments = \App\Models\ManageTournament::where('organization_id', auth()->id())->with('coaches')->get();
        return view('livewire.manage-tournament', compact('scales', 'regions', 'manageTournaments'));
    }
}
