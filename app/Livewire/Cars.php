<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Illuminate\Support\Str;
use ZanySoft\Zip\Facades\Zip;

class Cars extends Component
{

    public $car;

    protected $listeners = ['searchResult'];

    public function render()
    {
        return view('livewire.cars');
    }

    #[On('searchResult')]
    public function searchResult($car=null)
    {
        $this->car= $car;
    }

    public function download(Car $car, $field)
    {
        $zip_file = $car->vin . '_' . $field . '.zip';
        $zip = Zip::create($zip_file);

        $images = $car->$field;
        foreach ($images as $image) {

            if (Str::startsWith($image, '/')) {
                $image = Str::replaceFirst('/', '', $image);
            }
            if ($image) {
                $zip->add($image);
            }
        }

        $zip->close();

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        if (file_exists($zip_file)) {
            return response()->download($zip_file, $zip_file, $headers);
        }
    }
}
