<?php
declare(strict_types=1);

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Proposal;
use App\Models\Setting;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ApplicationOnRegistration implements ShouldQueue
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
            $site = Setting::first();
            $fpdf = new FPDF();
            $date = Carbon::parse($this->proposal->date_pick_up)->translatedFormat('d F Y');

            $fpdf->AddPage();
            $fpdf->AddFont('DejaVu', '', 'DejaVuSans.php', false);
            $fpdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.php', false);
            $fpdf->SetFont('DejaVu', '', 8);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Додаток 3');
            $fpdf->Cell(100, 20);
            $fpdf->Cell(160, 20, $text, 0, 0, 'L');
            $fpdf->Ln(4);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'до п.п. 3.12, 3.19, 4.3 Положення про');
            $fpdf->Cell(100, 20);
            $fpdf->Cell(160, 20, $text, 0, 0, 'L');
            $fpdf->Ln(4);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'забезпечення пропускного, внутрішньо об’єктового');
            $fpdf->Cell(100, 20);
            $fpdf->Cell(160, 20, $text, 0, 0, 'L');
            $fpdf->Ln(4);

            $text = iconv('UTF-8', 'cp1251//IGNORE', 'режиму на території ТОВ «Одіссея»');
            $fpdf->Cell(100, 20);
            $fpdf->Cell(160, 20, $text, 0, 0, 'L');
            $fpdf->Ln(16);

            $fpdf->SetFont('DejaVu', '', 14);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ТОВ «Одіссея»');
            $fpdf->Cell(210 - strlen($text), 20, $text, 0, 0, 'C');
            $fpdf->Ln(6);
            $fpdf->SetFont('DejaVu', '', 8);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ПОГОДЖЕНО');
            $fpdf->Cell(20, 20, $text);
            $fpdf->Cell(100, 20);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Начальник ВО ТОВ «Одіссея»');
            $fpdf->Cell(80, 20, $text, 0, 0, 'C');
            $fpdf->Ln(6);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Начальник ВО ТОВ «Одіссея»');
            $fpdf->Cell(20, 20, '________________________________________', 0, 0, 'L');
            $fpdf->Ln(4);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '(займана посада, прізвище і ініціали)');
            $fpdf->Cell(20, 20, $text, 0, 0, 'L');
            $fpdf->Ln(4);
            $text = iconv('UTF-8', 'cp1251//IGNORE', $date . 'р.');
            $fpdf->Cell(20, 20, $text, 0, 0, 'L');
            $fpdf->Ln(24);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '            Я, даю згоду на обробку таких персональних даних: прізвище, імя по батькові, найменування працедавця,  умови трудового договору в обсязі, визначеним нижченаведеним списком на оформлення перепусток, фотографію з метою оформлення перепустки на право входу на територію ТОВ «Одіссея». З правилами суб’єкту персональних даних, визначеними ст..8 Законом України «Про захист персональних даних» ознайомлений');
            $fpdf->MultiCell(180, 6, $text);
            $fpdf->Ln(8);
            $fpdf->SetFont('DejaVu', '', 14);
            $fpdf->SetXY(0, 110);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ЗАЯВКА');
            $fpdf->Cell(210 - strlen($text), 20, $text, 0, 0, 'C');
            $fpdf->Ln(8);

            $fpdf->SetFont('DejaVu', '', 12);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'на оформлення автотранспортних перепусток на територію ТОВ «Одіссея»');
            $fpdf->MultiCell(0, 20, $text, 0, 'C');

            //table
            $fpdf->SetFont('DejaVu', '', 8);

            $fpdf->SetLineWidth(0.1);
            $fpdf->Rect(10, 134, 190, 15, "D");
            $fpdf->SetXY(10, 134);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Найменування організації, в якій працює(ють) відвідувачі');
            $fpdf->MultiCell(50, 5, $text, 0, 'C');
            $fpdf->SetXY(60, 134);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '№/дата договору на виконання робіт Код ЄДРПОУ');
            $fpdf->MultiCell(40, 5, $text, 'LR', 'C');
            $fpdf->SetXY(100, 134);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Мета прибуття');
            $fpdf->MultiCell(50, 15, $text, 'R', 'C');
            $fpdf->SetXY(150, 134);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Термін, на який потрібна перепустка (з/по)');
            $fpdf->MultiCell(50, 5, $text, 0, 'C');
            //1.2.3.4

            $fpdf->Line(10, 149, 10, 154);
            $fpdf->Line(200, 149, 200, 154);
            $fpdf->Line(60, 149, 60, 154);
            $fpdf->Line(100, 149, 100, 154);
            $fpdf->Line(150, 149, 150, 154);

            $fpdf->SetXY(10, 149);
            $fpdf->MultiCell(50, 5, 1, 0, 'C');
            $fpdf->SetXY(60, 149);
            $fpdf->MultiCell(40, 5, 2, 0, 'C');
            $fpdf->SetXY(100, 149);
            $fpdf->MultiCell(50, 5, 3, 0, 'C');
            $fpdf->SetXY(150, 149);
            $fpdf->MultiCell(50, 5, 4, 0, 'C');
            //Data.
            $fpdf->SetFont('DejaVu', '', 10);
            $fpdf->Rect(10, 154, 190, 15, "D");
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'ТОВ «Ей Джі Термінал»');
            $fpdf->MultiCell(50, 5, $text, 0, 'C');
            $fpdf->SetXY(60, 154);
            $text = iconv('UTF-8', 'cp1251//IGNORE', __('application.doc_number'));
            $fpdf->MultiCell(40, 5, $text, 0, 'C');
            $fpdf->SetXY(100, 154);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Прийняття/видача та зберігання транспортних засобів');
            $fpdf->MultiCell(50, 5, $text, 0, 'C');
            $fpdf->SetXY(150, 154);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'З ' . $this->proposal->date_pick_up->format('d.m.Y') .' по '. $this->proposal->date_pick_up->format('d.m.Y'));

            $fpdf->MultiCell(50, 5, $text, 0, 'C');
            $fpdf->Line(150, 154, 150, 169);
            $fpdf->Line(100, 154, 100, 169);
            $fpdf->Line(60, 154, 60, 169);

            //Table2.
            $fpdf->Rect(10, 175, 190, 60, "D");
            //Headers.
            $fpdf->SetFont('DejaVu', '', 8);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '№ з/п');
            $fpdf->SetXY(10, 175);
            $fpdf->MultiCell(10, 5, $text, 0, 'C');
            $fpdf->SetXY(20, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Прізвище, ім.*я, по батькові працівника (відвідувача)');
            $fpdf->MultiCell(35, 5, $text, 0, 'C');
            $fpdf->SetXY(55, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Займана посада, № та серія документа, що засвідчує особу');
            $fpdf->MultiCell(30, 5, $text, 0, 'C');
            $fpdf->SetXY(85, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Режим роботи Зони доступу');
            $fpdf->MultiCell(25, 5, $text, 0, 'C');
            $fpdf->SetXY(110, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Державний номер транспортного засобу');
            $fpdf->MultiCell(25, 5, $text, 0, 'C');
            $fpdf->SetXY(135, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Марка та тип транспортного засобу (легковий, вантажний, вантажно-пасажирський)');
            $fpdf->MultiCell(35, 5, $text, 0, 'C');
            $fpdf->SetXY(170, 175);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Даю згоду на обробку моїх персональних даних згідно Закону України від 01.06.2010 №2297-vi (підпис)');
            $fpdf->MultiCell(30, 5, $text, 0, 'C');
            //1.2.3.4
            $fpdf->Line(10, 210, 200, 210);
            $fpdf->Line(20, 175, 20, 235);
            $fpdf->Line(55, 175, 55, 235);
            $fpdf->Line(85, 175, 85, 235);
            $fpdf->Line(110, 175, 110, 235);
            $fpdf->Line(135, 175, 135, 235);
            $fpdf->Line(170, 175, 170, 235);
            $fpdf->Line(10, 215, 200, 215);
            $fpdf->SetFont('DejaVu', '', 8);
            $fpdf->SetXY(10, 210);
            $fpdf->MultiCell(10, 5, 5, 0, 'C');
            $fpdf->SetXY(20, 210);
            $fpdf->MultiCell(35, 5, 6, 0, 'C');
            $fpdf->SetXY(55, 210);
            $fpdf->MultiCell(30, 5, 7, 0, 'C');
            $fpdf->SetXY(85, 210);
            $fpdf->MultiCell(25, 5, 8, 0, 'C');
            $fpdf->SetXY(110, 210);
            $fpdf->MultiCell(25, 5, 9, 0, 'C');
            $fpdf->SetXY(135, 210);
            $fpdf->MultiCell(35, 5, 10, 0, 'C');
            $fpdf->SetXY(170, 210);
            $fpdf->MultiCell(30, 5, 11, 0, 'C');
            //Data.
            $fpdf->SetFont('DejaVu', '', 10);
            $fpdf->MultiCell(10, 5, 1, 0, 'C');
            $fpdf->SetXY(20, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', $this->proposal->name_driver);
            $fpdf->MultiCell(35, 5, $text, 0, 'C');
            $fpdf->SetXY(55, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Водій, '. strtoupper($this->proposal->passport_driver));
            $fpdf->MultiCell(30, 5, $text, 0, 'C');
            $fpdf->SetXY(85, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Територія ТОВ «Одіссея»');
            $fpdf->MultiCell(25, 5, $text, 0, 'C');
            $fpdf->SetXY(110, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', strtoupper($this->proposal->number_tow_track));
            $fpdf->MultiCell(25, 5, $text, 0, 'C');
            $fpdf->SetXY(135, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', strtoupper($this->proposal->model_tow_track).' Вантажний');
            $fpdf->MultiCell(35, 5, $text, 0, 'C');
            $fpdf->SetXY(170, 215);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'так');
            $fpdf->MultiCell(30, 5, $text, 0, 'C');
            $fpdf->Ln(18);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'Виконавець Ей Джі Телефон ' . $site->phone_driver);
            $fpdf->MultiCell(55, 5, $text, 0, 'L');
            $fpdf->SetXY(130, 240);
            $fpdf->SetFont('DejaVu', '', 8);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '_________________________________________ посада особи, яка оформила заявку і найменування установи, в якій вона працює)');
            $fpdf->MultiCell(60, 5, $text, 0, 'C');

            $fpdf->SetXY(130, 260);
            $text = iconv('UTF-8', 'cp1251//IGNORE', 'М.П.  ________________    Захарчук А. М.');
            $fpdf->MultiCell(65, 5, $text, 0, 'C');
            $fpdf->SetXY(130, 265);
            $text = iconv('UTF-8', 'cp1251//IGNORE', '            (підпис)            (прізвище, ініціали)');
            $fpdf->MultiCell(65, 5, $text, 0, 'L');
            $fpdf->SetXY(130, 270);
            $text = iconv('UTF-8', 'cp1251//IGNORE', $date . 'р.');
            $fpdf->MultiCell(65, 5, $text, 0, 'L');
            $phone = Str::remove('+', $this->proposal->phone_driver);
            $phone = Str::remove(' ', $phone);
            $filepath = 'storage/' . $phone . '_' . $car->vin . '_ApplicationOnRegistration.pdf';
            $fpdf->Output('f', $filepath);
            $car->power_of_attorney_delivery = '/' . $filepath;
            $car->save();
        }
    }
}
