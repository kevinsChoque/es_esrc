<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;

class F6Controller extends Controller
{
    public function actF6($idFo2)
    {
        $f2 = TFormat2::find($idFo2);
        // dd($f2->idFo2);
        $marco = 1;
    	$smarco = 0;
        $t = 8.1;
        $t = 9;
        $s = 5.4;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        $pdf->Image(public_path('img/emusap_logo.png'), 10, 10, 35, 15);

        $pdf->Cell(190,15,'-',$marco,1,'C');
        // $pdf->Cell(80,20,'-',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->text(90,18,'FORMATO 6');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(72,22,'Resumen del Acta de Inspeccion Externa');

        $pdf->Rect(10, 24.69, 195, 16, 'D');
        $pdf->Rect(10, 40.69, 195, 134, 'D');
        $pdf->Rect(10, 177.69, 195, 31, 'D');
        $pdf->Rect(10, 211.69, 195, 41.5, 'D');
        $pdf->Rect(10, 253.1, 195, 24, 'D');

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', 10.2);
        $pdf->Cell(120,$s,utf8_decode('CODIGO DE RECLAMO N°'),$marco,0,'R');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,$s,$f2->codRec,$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,$s-1.32,'-',$marco,0,'C');
        $pdf->Cell(40,$s-1.32,utf8_decode('N° DE SUMINISTRO'),$marco,0,'R');
        $pdf->Cell(50,$s-1.32,$f2->numSum,$marco,0,'C');
        $pdf->Cell(90,$s-1.32,'-',$marco,0,'R');
        $pdf->Cell(5,$s-1.32,'-',$marco,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s-1.32,'-',$marco,0,'C');
        $pdf->Cell(90,$s-1.32,'INFORME SOBRE EL SUMINISTRO',$marco,0,'L');
        $pdf->Cell(95,$s-1.32,'',$marco,1,'C');

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(35,$s,'',$marco,0,'C');
        $pdf->Cell(35,$s,'',$marco,0,'C');
        $pdf->Cell(35,$s,'',$marco,0,'C');
        $pdf->Cell(35,$s,'',$marco,0,'C');
        $pdf->Cell(35,$s,'',$marco,0,'C');
        $pdf->Cell(5,$s,'',$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,$s-1.32,'-',$marco,0,'C');
        $pdf->Cell(35,$s-1.32,'Medidor Nª',$marco,0,'C');
        $pdf->Cell(35,$s-1.32,'Diametro Nª',$marco,0,'C');
        $pdf->Cell(35,$s-1.32,'Lectura',$marco,0,'C');
        $pdf->Cell(35,$s-1.32,'Funciona',$marco,0,'C');
        $pdf->Cell(35,$s-1.32,'No funciona',$marco,0,'C');
        $pdf->Cell(5,$s-1.32,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.32,'-',$marco,1,'L');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$marco,0,'C');
        $pdf->Cell(35,$s,'FUGA EN CAJA',$marco,0,'L');
        $pdf->Cell(10,$s,'',$marco,0,'C');
        $pdf->Cell(90,$s,'(EN CASO DE HABER FUGA EN LA CAJA)',$marco,0,'C');
        $pdf->Cell(10,$s,'',$marco,0,'C');
        $x = $pdf->GetX(); // Posición X después de la primera celda
        $y = $pdf->GetY(); // Posición Y actual
        $pdf->SetFont('Arial', 'B', $t-2.7);
        $pdf->MultiCell(35, $s* 0.51, utf8_decode("OBSERVACIONES SOBRE EL MEDIDOR"), $marco, 'C');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->SetXY($x + 35, $y);
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s, 'SI', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(10, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(55, $s, '', $marco, 0, 'C');
        $pdf->Cell(10, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s, 'NO', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(10, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, 'Antes del medidor', $marco, 0, 'C');
        $pdf->Cell(55, $s, 'Despues del medidor', $marco, 0, 'C');
        $pdf->Cell(10, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'UBICACION DE LA CAJA DE MEDIDOR', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(90, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s-1.32, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Interior', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Vereda', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Frente', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Lateral', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Pista', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Distante', $marco, 0, 'C');
        $pdf->Cell(90, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'ESTADO DEL SUMINISTRO', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(15, $s, '', $marco, 0, 'C');
        $pdf->Cell(75, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s-1.32, '-', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Vigente', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Cerrado', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Tapado', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Directo', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Retirado', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'No ubicado', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Niple', $marco, 0, 'C');
        $pdf->Cell(75, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'TIPO DE ABASTECIMIENTO', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(120, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s-1.32, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, 'Continuo', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, 'Discontinuo', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, utf8_decode('Nª de horas'), $marco, 0, 'C');
        $pdf->Cell(120, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'OBSERVACIONES SOBRE EL SUMINISTRO', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        for ($i=0; $i < 9; $i++)
        {
            $pdf->Cell(5, $s, '-', $marco, 0, 'C');
            $pdf->Cell(180, $s, '_____________________________________________________________________________________________________', $marco, 0, 'C');
            $pdf->Cell(5, $s, '-', $marco, 1, 'C');
        }

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'CIERRES Y REAPERTURAS  / INSPECCION DE SERVICIOS CERRADOS', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, '', $marco, 0, 'C');
        $pdf->Cell(30, $s, 'Codigo de acceso', $marco, 0, 'C');
        $pdf->Cell(25, $s, 'Fecha', $marco, 0, 'C');
        $pdf->Cell(35, $s, 'Lectura', $marco, 0, 'C');
        $pdf->Cell(25, $s, 'Operario', $marco, 0, 'C');
        $pdf->Cell(40, $s, 'Comentarios', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, 'Actividad', $marco, 0, 'C');
        $pdf->Cell(30, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(40, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, 'Cierre', $marco, 0, 'C');
        $pdf->Cell(30, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(40, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, 'Reapertura', $marco, 0, 'C');
        $pdf->Cell(30, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(40, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 1, 'C');

        $pdf->Cell(5, $s, '-', $marco, 0, 'C');
        $pdf->Cell(20, $s, 'Supervision', $marco, 0, 'C');
        $pdf->Cell(30, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(35, $s, '', $marco, 0, 'C');
        $pdf->Cell(25, $s, '', $marco, 0, 'C');
        $pdf->Cell(40, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 0, 'C');
        $pdf->Cell(5, $s, '', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'DATOS DE PERSONA PRESENTE EN LA INSPECCION', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        $pdf->ln(2.1);

        $pdf->SetFont('Arial', 'B', $t-2.7);
        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'L');
        $pdf->Cell(60, $s-1.32, 'Nombre de la persona presente en la inspeccion: ', $marco, 0, 'L');
        $pdf->Cell(45, $s-1.32, '__________________________________', $marco, 0, 'L');
        $pdf->Cell(20, $s-1.32, 'Reclamante: Si:', $marco, 0, 'C');
        $pdf->Cell(10, $s-1.32, '______', $marco, 0, 'C');
        $pdf->Cell(10, $s-1.32, 'No:', $marco, 0, 'C');
        $pdf->Cell(10, $s-1.32, '______', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 1, 'C');

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Propietario: ', $marco, 0, 'C');
        $pdf->Cell(25, $s-1.32, '_________________', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Inquilino: ', $marco, 0, 'C');
        $pdf->Cell(25, $s-1.32, '_________________', $marco, 0, 'C');
        $pdf->Cell(15, $s-1.32, 'Residente: ', $marco, 0, 'C');
        $pdf->Cell(25, $s-1.32, '_________________', $marco, 0, 'C');
        $pdf->Cell(10, $s-1.32, 'Otro: ', $marco, 0, 'C');
        $pdf->Cell(25, $s-1.32, '_________________', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 1, 'C');

        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(65, $s-1.32, 'NUMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE, CI): ', $marco, 0, 'C');
        $pdf->Cell(90, $s-1.32, '_________________________________________________________________________', $marco, 0, 'C');
        $pdf->Cell(20, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(5, $s-1.32, '', $marco, 1, 'C');

        $pdf->ln(3);

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5, $s-1.32, '', $marco, 0, 'C');
        $pdf->Cell(180, $s-1.32, 'OBSERVACIONES:', $marco, 0, 'L');
        $pdf->Cell(5, $s-1.32, '-', $marco, 1, 'C');

        for ($i=0; $i < 3; $i++)
        {
            $pdf->Cell(5, $s, '-', $marco, 0, 'C');
            $pdf->Cell(180, $s, '_____________________________________________________________________________________________________', $marco, 0, 'C');
            $pdf->Cell(5, $s, '-', $marco, 1, 'C');
        }

        $pdf->Cell(5,$s+7.2,'-',$marco,0,'C');
        $pdf->Cell(85,$s+7.2,'',$marco,0,'l');
        $pdf->Cell(10,$s+7.2,'',$marco,0,'l');
        $pdf->Cell(85,$s+7.2,'',$marco,0,'l');
        $pdf->Cell(5,$s+7.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,$s-3,'',$marco,0,'C');
        $pdf->Cell(85,$s-3,'Firma del reclamante o persona presente en la inspeccion',$marco,0,'C');
        $pdf->Cell(10,$s-3,'',$marco,0,'l');
        $pdf->Cell(85,$s-3,'Persona autorizada por la Empresa Prestadora para la inspeccion',$marco,0,'C');
        $pdf->Cell(5,$s-3,'',$marco,1,'C');

        $pdf->ln(3);

        $pdf->Cell(5,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(15,$s-1.2,'',$marco,0,'l');
        $pdf->Cell(10,$s-1.2,'Fecha:',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'/',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'/',$marco,0,'l');
        $pdf->Cell(20,$s-1.2,'',$marco,0,'l');
        $pdf->Cell(20,$s-1.2,'HORA INICIO:',$marco,0,'l');
        $pdf->Cell(25,$s-1.2,'____________',$marco,0,'l');
        $pdf->Cell(20,$s-1.2,'HORA FINAL:',$marco,0,'l');
        $pdf->Cell(25,$s-1.2,'____________',$marco,0,'l');
        $pdf->Cell(25,$s-1.2,'',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->text(57,280,'(Texto segun el formato 6 de la Resolucion de Consejo Directivo Nª 015-2024-SUNASS-CD)');

        // ---------------------------
        // ---------------------------
        // ---------------------------


        $pdf->Output();

        exit;
    }
}
