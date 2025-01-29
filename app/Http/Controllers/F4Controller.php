<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;
use App\Models\TProcess;

class F4Controller extends Controller
{
    public function actF4($idPro)
    {
        // $f2 = TFormat2::find($idPro);
        $f2 = TProcess::where('process.idPro', '=', $idPro)
            ->leftjoin('format2', 'format2.idFo2', '=', 'process.idFo2')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','inspections.*','process.*')
            ->first();
        // dd($f2->idPro);
        $m = 1;
        $ssm = 1;
    	$sm = 0;
        $t = 8.1;
        $t = 9;
        $s = 5.4;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        $pdf->Image(public_path('img/emusap_logo.png'), 10, 10, 35, 15);

        $pdf->Cell(190,15,'-',$m,1,'C');
        // $pdf->Cell(80,20,'-',$m,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->text(90,18,'FORMATO 4');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(78,22,utf8_decode('Acta de Reuniòn de Conciliaciòn'));

        // $pdf->Rect(10, 24.69, 195, 200, 'D');
        // $pdf->Rect(10, 40.69, 195, 134, 'D');
        // $pdf->Rect(10, 177.69, 195, 31, 'D');
        // $pdf->Rect(10, 211.69, 195, 41.5, 'D');
        // $pdf->Rect(10, 253.1, 195, 24, 'D');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(120,$s,utf8_decode('CODIGO DE RECLAMO N°'),$sm,0,'R');
        $pdf->Cell(60,$s,$f2->codRec,$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'NOMBRE DEL RECLAMANTE O SU REPRESENTANTE',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(60,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->SetFont('Arial', 'B', $t-1.2);
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(55,$s-1.2,'Apellido Paterno',$m,0,'C');
        $pdf->Cell(55,$s-1.2,'Apellido Materno',$m,0,'C');
        $pdf->Cell(60,$s-1.2,'Nombres',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(110,$s-1.2,utf8_decode('NÙMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE, CI)'),$m,0,'L');
        $pdf->Cell(60,$s-1.2,'',$ssm,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(55,$s-1.2,utf8_decode('RAZÒN SOCIAL'),$m,0,'L');
        $pdf->Cell(115,$s-1.2,'',$ssm,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(6);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'NOMBRE DEL REPRESENTANTE DE LA EMPRESA PRESTADORA',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(60,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->SetFont('Arial', 'B', $t-1.2);
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(55,$s-1.2,'Apellido Paterno',$m,0,'C');
        $pdf->Cell(55,$s-1.2,'Apellido Materno',$m,0,'C');
        $pdf->Cell(60,$s-1.2,'Nombres',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(110,$s-1.2,utf8_decode('NÙMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE, CI)'),$m,0,'L');
        $pdf->Cell(60,$s-1.2,'',$ssm,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(110,$s-1.2,utf8_decode('FACULTADO POR: (documento, cargo, etc. Segùn sea el caso)'),$m,0,'L');
        $pdf->Cell(60,$s-1.2,'',$ssm,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,0,'L');
        $pdf->Cell(5,$s-1.2,'',$m,1,'L');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'Hora de Inicio',$m,0,'L');
        $pdf->Cell(25,$s,'',$m,0,'L');
        $pdf->Cell(30,$s,utf8_decode('Hora de tèrmino'),$m,0,'R');
        $pdf->Cell(25,$s,'',$m,0,'L');
        $pdf->Cell(35,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->ln(6);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'MATERIA DEL RECLAMO',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s+2.1,'',$m,0,'L');
        $pdf->Cell(5,$s+2.1,'',$m,0,'L');
        $pdf->Cell(10,$s+2.1,utf8_decode('Nª'),$m,0,'L');
        $pdf->Cell(5,$s+2.1,'',$m,0,'L');
        $pdf->Cell(50,$s+2.1,'Tipo de reclamo*',$m,0,'L');
        $pdf->Cell(10,$s+2.1,'',$m,0,'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', $t-2.4);
        $pdf->MultiCell(95, $s-2.9, utf8_decode("Descripcion del reclamo \n (mes reclamado, monto, incumplimiento de la Empresa Prestadora, etc, segùn el caso)"), $m, 'C');
        $pdf->SetFont('Arial', 'B', $t);
        // $pdf->Cell(75,$s,'Descripcion del reclamo',$m,0,'L');
        $pdf->SetXY($x + 95, $y);
        $pdf->Cell(5,$s+2.1,'',$m,0,'L');
        $pdf->Cell(5,$s+2.1,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(95,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(95,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(95,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'L');
        $pdf->Cell(10,$s,'',$m,0,'L');
        $pdf->Cell(95,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,$s-2.1,'',$m,0,'L');
        $pdf->Cell(5,$s-2.1,'',$m,0,'L');
        $pdf->Cell(170,$s-2.1,'* Pueden colocarse los numerales indicados como "Tipo de Reclamo" en el formato Nª 1',$m,0,'L');
        $pdf->Cell(5,$s-2.1,'',$m,0,'L');
        $pdf->Cell(5,$s-2.1,'',$m,1,'L');

        $pdf->ln(3);

        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'PROPUESTA DE LA EMPRESA PRESTADORA',$m,0,'C');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(170, $s-1.8, utf8_decode("Lorem ipsum dolor sit amet elit. Incidunt blanditiis, nulla, molestias autem aperiam eos quisquam dolor, similique nisi perspiciatis animi aut corporis eligendi tempora hic placeat accusantium eveniet. Provident.que nisi perspiciatis animi aut corporis eligendi tempora hic placeaque nisi perspiciatis animi aut corpori placeaque nisi perspiciatis animi aut corporis eligendi tempora hic placeat accusantium eveniet. Provident."), $m, 'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->SetXY($x + 170, $y);
        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $pdf->Cell(5,$s+9,'',$m,1,'L');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'PROPUESTA DEL RECLAMANTE',$m,0,'C');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(180, $s, utf8_decode("eaque nisi perspiciatis animi aut corporis eligendi tempora hic placeat accusantium eveniet. Provident."), $m, 'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->SetXY($x + 180, $y);
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->ln(1.2);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(87,$s,'PUNTOS DE ACUERDO',$m,0,'C');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(88,$s,'PUNTOS DE DESACUERDO',$m,0,'C');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(87,$s,'NINGUNO',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(88,$s,'NINGUNO',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->ln(3.9);

        // $pdf->Cell(5,$s,'',$m,0,'L');
        // $pdf->Cell(92,$s,'VSDVSD',$m,0,'L');
        // $pdf->Cell(10,$s,'SI',$m,0,'R');
        // $pdf->Cell(20,$s,'X',$m,0,'C');
        // $pdf->Cell(10,$s,'NO',$m,0,'R');
        // $pdf->Cell(20,$s,'',$m,0,'C');
        // $pdf->Cell(28,$s,'',$m,0,'L');
        // $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s+4.8,'',$m,0,'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont('Arial', 'B', $t-2.1);
        $pdf->MultiCell(92, $s-2.1, utf8_decode('¡SUBSISTE EL RECLAMO?\nSi el reclamo marca la casilla "NO" implica el desistimiento del reclamo, bajo las\ncondiciones expresadas en el presente documento.'), $m, 'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->SetXY($x + 92, $y);
        $pdf->Cell(10,$s+4.8,'SI',$m,0,'R');
        $pdf->Cell(20,$s+4.8,'X',$m,0,'C');
        $pdf->Cell(10,$s+4.8,'NO',$m,0,'R');
        $pdf->Cell(20,$s+4.8,'',$m,0,'C');
        $pdf->Cell(28,$s+4.8,'',$m,0,'L');
        $pdf->Cell(5,$s+4.8,'',$m,1,'L');

        $pdf->ln(3.9);

        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(170,$s,'OBSERVACIONES DEL RECLAMANTE O DE LA EMPRESA PRESTADORA',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$m,1,'L');

        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(170, $s-1.8, utf8_decode("eos quisquam dolor, sim ipsum dolor sit amet elit. Incidunt, nulla, autem aperiam eos quisquam dolor, similique nisi perspiciatis animi aut corporis eligendi tempora hic placeat accusantium eveniet. Provident.que nisi perspiciatis animi aut corporis eligendi tempora hic placeaque nisi perspiciatis animi aut corpori placeaque nisi perspiciatis animi aut corporis eligendi tempora hic placeat accusantium eveniet. Provident."), $m, 'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->SetXY($x + 170, $y);
        $pdf->Cell(5,$s+9,'',$m,0,'L');
        $pdf->Cell(5,$s+9,'',$m,1,'L');

        $pdf->ln(3);

        $pdf->Cell(5, $s+9, '', $m, 0, 'C');
        $pdf->Cell(60, $s+9, '', $m, 0, 'C');
        $pdf->Cell(15, $s+9, '', $m, 0, 'C');
        $pdf->Cell(30, $s+9, '', $m, 0, 'C');
        $pdf->Cell(15, $s+9, '', $m, 0, 'C');
        $pdf->Cell(60, $s+9, '', $m, 0, 'C');
        $pdf->Cell(5, $s+9, '', $m, 1, 'C');

        $pdf->Cell(5, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(60, $s*0.5, 'Firma', $m, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(30, $s*0.5, 'Huella Digital', $m, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(60, $s*0.5, 'Fecha', $m, 0, 'C');
        $pdf->Cell(5, $s*0.5, '', $m, 1, 'C');

        $pdf->Cell(5, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(60, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(30, $s*0.5, '(Indice derecho)', $m, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(60, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(5, $s*0.5, '', $m, 1, 'C');

        $pdf->ln(1.2);

        $pdf->SetFont('Arial', 'B', $t-2.1);
        $pdf->Cell(5, $s*0.5, '', $m, 0, 'C');
        $pdf->Cell(120, $s*0.5, utf8_decode('*En caso de no saber firmar o estar impedido, bastará con la huella digital.'), $m, 0, 'L');
        $pdf->Cell(60, $s*0.5, 'Fecha: Abancay, 06 de junio 1992', $m, 0, 'C');
        $pdf->Cell(5, $s*0.5, '', $m, 1, 'C');

        $pdf->Output();

        exit;
    }
}
