<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Models\Car;
use App\Models\Proposal;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PowerOfAttorneyImport implements ShouldQueue
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
            $fpdf->SetFont('DejaVu', 'B', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Товариство з обмеженою');
            $fpdf->Cell(190, 30, $text, 0, 0, 'C');

            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'відповідальністю «Ей Джі Термінал»');
            $fpdf->Cell(190, 30, $text, 0, 0, 'C');
            $fpdf->SetFont('DejaVu', '', 12);
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', '65082, м. Одеса, вул. Приморська 18, оф. 47');
            $fpdf->Cell(190, 30, $text, 0, 0, 'C');
            $fpdf->Ln(24);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Вих.№ ' . substr(strtoupper($car->vin), -6) );
            $fpdf->Cell(145, 30, $text);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ТОВ «Одіссея»');
            $fpdf->Cell(50, 30, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            $fpdf->Cell(145, 30, $this->proposal->date_pick_up->format('d.m.Y'));
            $fpdf->Ln(8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Довіреність');
            $fpdf->Cell(190, 60, $text, 0, 0, 'C');
            $fpdf->Ln(40);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Справжнім компанія ТОВ «Ей Джі Термінал» довіряє водію '. $this->proposal->name_driver. ' отримати в ТОВ «Одіссея» вантаж:');
            $fpdf->MultiCell(180, 10, $text, 0, 'C');

            $fpdf->SetFont('DejaVu', 'B', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', strtoupper($car->name) . ' ' . strtoupper($car->vin));
            $fpdf->MultiCell(180, 10, $text, 0, 'C');
            $fpdf->SetFont('DejaVu', '', 12);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'для доставки за місцем призначення.');
            $fpdf->MultiCell(180, 10, $text, 0, 'C');
            $fpdf->SetFont('DejaVu', 'B', 14);
            $tow = $this->proposal->model_tow_track . ' ' . $this->proposal->number_tow_track . ' ' . $this->proposal->number_trailer;
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'АМ ' . strtoupper($tow));
            $fpdf->MultiCell(180, 10, $text, 0, 'C');
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Паспорт ' . strtoupper($this->proposal->passport_driver));
            $fpdf->MultiCell(180, 10, $text, 0, 'C');
            $fpdf->Ln(30);
            $fpdf->SetFont('DejaVu', '', 12);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Директор');
            $fpdf->Cell(50, 10, $text);
            $fpdf->Ln(8);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ТОВ «ЕЙ ДЖІ ТЕРМІНАЛ»');
            $fpdf->Cell(100, 10, $text);

            $text = iconv('UTF-8', 'cp1251//IGNORE', '___________________ Сівец В. В.');
            $fpdf->MultiCell(90, 10, $text, 0, 'R');
            $phone = Str::remove('+',$this->proposal->phone_driver);
            $phone = Str::remove(' ', $phone);
            $phone = Str::remove(')', $phone);
            $phone = Str::remove('(', $phone);
            $filepath = 'storage/PowerOfAttorney_'. $phone . '_'. $car->vin . '.pdf';
            $fpdf->Output('f', $filepath);
            $car->power_of_attorney_import = '/' . $filepath;
            $car->save();
        }
    }
}
