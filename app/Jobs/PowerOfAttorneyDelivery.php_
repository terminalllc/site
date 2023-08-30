<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Models\Car;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Codedge\Fpdf\Fpdf\Fpdf;

class PowerOfAttorneyDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Proposal $proposal)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $car = Car::where('vin', $this->proposal->vin_car)->first();

        if ($car) {

            $fpdf = new FPDF();
            $fpdf->AddPage();
            $fpdf->AddFont('DejaVu', '', 'DejaVuSans.php', false);
            $fpdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.php', false);
            $fpdf->SetFont('DejaVu', '', 14);
            //Date
            $fpdf->Cell(145, 30, $this->proposal->date_pick_up);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ТОВ «Одіссея»');
            $fpdf->Cell(50, 30, $text, 0, 0, 'C');
            $fpdf->Ln(10);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Довіреність');
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Справжнім компанія ТОВ «ЕЙ ДЖІ ТЕРМІНАЛ»');
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'довіряє водію');
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(12);

            // Driver.
            $fpdf->SetFont('DejaVu', 'B', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', strtoupper($this->proposal->name_driver));
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->SetFont('DejaVu', '', 14);
            $fpdf->Ln(12);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'отримати в ТОВ «Одіссея» вантаж:');
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(12);
            // Car.
            $fpdf->SetFont('DejaVu', 'B', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', strtoupper($car->name));
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'VIN: ' . strtoupper($car->vin));
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(12);

            $fpdf->SetFont('DejaVu', '', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'для доставки по місту призначення.');
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(12);

            // Driver tow
            $tow = $this->proposal->model_tow_track . ' ' . $this->proposal->number_tow_track . ' ' . $this->proposal->number_trailer;
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'АМ ' . strtoupper($tow));
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            //Driver passport.
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Паспорт ' . strtoupper($this->proposal->passport_driver));
            $fpdf->Cell(190, 100, $text, 0, 0, 'C');
            $fpdf->Ln(50);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Директор ТОВ «ЕЙ ДЖІ ТЕРМІНАЛ»');
            $fpdf->Cell(190, 100, $text, 0, 0, 'L');
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', '___________________');
            $fpdf->Cell(190, 100, $text, 0, 0, 'L');
            $filepath= 'storage/'. $car->vin . '_AuthorizationForTransportation.pdf';
            $fpdf->Output('f', $filepath);
            $car->power_of_attorney_delivery = '/'.$filepath;
            $car->save();
        }
    }
}
