<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;

class F7Controller extends Controller
{
    public function actF7($idFo2)
    {
        $f2 = TFormat2::find($idFo2);
        // dd($f2->idFo2);
        $m = 1;
    	$sm = 0;
        $ssm = 1;
        $t = 8.1;
        $t = 9-2;
        $s = 5.4;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        $pdf->Image(public_path('img/emusap_logo.png'), 10, 8, 35, 15);

        $pdf->Cell(190,15,'',$sm,1,'C');
        // $pdf->Cell(80,20,'-',$m,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->text(90,17,'FORMATO 7');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(63,21,'Solicitud de contrastacion de medidor de agua potable');

        $pdf->Rect(10, 24, 190, 254, 'D');
        $pdf->Rect(14, 40, 182, 12, 'D');
        $pdf->Rect(14, 53, 182, 70, 'D');
        $pdf->Rect(14, 131, 182, 30, 'D');
        $pdf->Rect(14, 169, 182, 65, 'D');

        // $pdf->Rect(10, 254.7, 195, 20, 'D');

        $pdf->SetFont('Arial', 'B', $t+1.2);
        $pdf->Cell(5,6,'',$sm,0,'L');
        $pdf->Cell(120,6,utf8_decode('CODIGO DE RECLAMO N°'),$sm,0,'R');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,6,$f2->codRec,$m,0,'C');
        $pdf->Cell(5,6,'',$sm,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(40,$s,utf8_decode('N° DE SUMINISTRO'),$sm,0,'L');
        $pdf->Cell(50,$s,$f2->numSum,$m,0,'C');
        $pdf->Cell(90,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(70,$s,'NOMBRE DE LA EMPRESA PRESTADORA',$sm,0,'L');
        $pdf->Cell(110,$s,'',$m,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(70,$s,'LOCALIDAD O CENTRO DE SERVICIO',$sm,0,'L');
        $pdf->Cell(110,$s,'',$m,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(65,$s,'NOMBRE DEL RECLAMANTE O REPRESENTANTE',$sm,0,'L');
        $pdf->Cell(105,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(55,$s,'',$m,0,'L');
        $pdf->Cell(60,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s-1.2,'',$sm,0,'R');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'L');
        $pdf->Cell(55,$s-1.2,'Apellido Paterno',$m,0,'C');
        $pdf->Cell(55,$s-1.2,'Apellido Materno',$m,0,'C');
        $pdf->Cell(60,$s-1.2,'Nombres',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'R');
        $pdf->Cell(5,$s-1.2,'',$sm,1,'L');

        $pdf->ln(.9);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(75,$s,'NUMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE, CI)',$sm,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'L');
        $pdf->Cell(45,$s,'',$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(.9);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(40,$s,'RAZON SOCIAL',$sm,0,'L');
        $pdf->Cell(130,$s,'',$m,0,'L');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(170,$s,'UBICACION DEL PREDIO',$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(110,$s,'',$m,0,'L');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s-1.2,'',$sm,0,'R');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(110,$s-1.2,'(Calle, Jiron, Avenida)',$m,0,'C');
        $pdf->Cell(20,$s-1.2,utf8_decode('Nª'),$m,0,'C');
        $pdf->Cell(20,$s-1.2,'Mz',$m,0,'C');
        $pdf->Cell(20,$s-1.2,'Lote',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(70,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s-1.2,'',$sm,0,'R');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(70,$s-1.2,'(Urbanizacion, barrio)',$m,0,'C');
        $pdf->Cell(50,$s-1.2,'Provincia',$m,0,'C');
        $pdf->Cell(50,$s-1.2,'Distrito',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(70,$s,'',$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s-1.2,'',$sm,0,'R');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(50,$s-1.2,utf8_decode('Medidor Nª'),$m,0,'C');
        $pdf->Cell(50,$s-1.2,'Diametro',$m,0,'C');
        $pdf->Cell(70,$s-1.2,'Diametro de la conexion (mm)',$m,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,0,'C');
        $pdf->Cell(5,$s-1.2,'',$sm,1,'L');

        $pdf->ln(6);

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(180,$s,'DEFINICIONES',$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(160, $s* 0.72, utf8_decode("1. Contrastacion Procedimiento. que determina el grado de precisiòn del medidor de agua potable, de acuerdo a las normas metrlògicas vigentes y las recomendaciones de la SUNASS, por comparaciòn con un patròn certificado por el INDECOPI."), $sm, 'L');
        $pdf->SetXY($x + 160, $y);
        $pdf->Cell(15, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(160, $s* 0.72, utf8_decode("2. Contrastaciòn en campo Contrastaciòn realizada sin retirar el medidor de agua potable de la conexiòn domiciliada, bajo las condiciones hidràulicas correspondiente al servicio que recibe el usuario."), $sm, 'L');
        $pdf->SetXY($x + 160, $y);
        $pdf->Cell(15, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(160, $s* 0.72, utf8_decode("3. Contrastaciòn de laboratorio: Contrastaciòn realizada en un laboratorio, bajo condiciones hidràulicas concretas que pueden diferir de las condiciones del servicio que recibe el usuario, para lo cual se retirarà el medidor de la conexiòn domiciliada. El laboratorio puede ser una instalaciòn permanente o mòvil, que cumpla con los requisitos establecidos por el INDECOPI."), $sm, 'L');
        $pdf->SetXY($x + 160, $y);
        $pdf->Cell(15, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->ln(9);

        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(180,$s,utf8_decode('SELECCIÒN'),$sm,0,'L');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, 'TIPO DE CONTRASTACION (marcar)', $sm, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(45, $s, '1. CONTRASTACION EN CAMPO', $sm, 0, 'L');
        $pdf->Cell(30, $s, '', $m, 0, 'C');
        $pdf->Cell(15, $s, '', $sm, 0, 'C');
        $pdf->Cell(50, $s, '2. CONTRASTACION EN LABORATORIO', $sm, 0, 'L');
        $pdf->Cell(30, $s, '', $m, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, 'ENTIDAD CONTRASTADORA', $sm, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, 'Escribir el nombre de la Entidad Contrastadora seleccionada por el usuario detallado proporcionado por la empresa Prestadora', $sm, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, '', $m, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->ln(2.1);

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, 'DIRECCION DE LA ENTIDAD CONTRASTADORA', $sm, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'L');
        $pdf->Cell(110,$s,'',$m,0,'L');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(20,$s,'',$m,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(110,$s,'(Calle, Jiron, Avenida)',$m,0,'C');
        $pdf->Cell(20,$s,utf8_decode('Nª'),$m,0,'C');
        $pdf->Cell(20,$s,'Mz',$m,0,'C');
        $pdf->Cell(20,$s,'Lote',$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(70,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(70,$s,'(Urbanizacion, barrio)',$m,0,'C');
        $pdf->Cell(50,$s,'Provincia',$m,0,'C');
        $pdf->Cell(50,$s,'Distrito',$m,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(2.1);

        $pdf->Cell(5,$s,'',$sm,0,'R');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(50,$s,'COSTO DE LA CONTRASTACION',$sm,0,'L');
        $pdf->Cell(50,$s,'',$m,0,'C');
        $pdf->Cell(50,$s,'nuevos soles',$sm,0,'L');
        $pdf->Cell(20,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,0,'C');
        $pdf->Cell(5,$s,'',$sm,1,'L');

        $pdf->ln(6);

        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(170, $s, utf8_decode('DECLARACÒN RESPECTO AL COSTO DE LA CONTRATACIÒN'), $sm, 0, 'L');
        $pdf->Cell(5, $s, '', $sm, 0, 'C');
        $pdf->Cell(5, $s, '', $sm, 1, 'C');

        $pdf->Cell(5, $s+1.2, '', $sm, 0, 'C');
        $pdf->Cell(5, $s+1.2, '', $sm, 0, 'C');
        $pdf->Cell(170, $s+1.2, utf8_decode('Me comprometo a asumir el costo de la contrastacion si se comprobara que el medidor no sobreregistra'), $m, 0, 'L');
        $pdf->Cell(5, $s+1.2, '', $sm, 0, 'C');
        $pdf->Cell(5, $s+1.2, '', $sm, 1, 'C');

        $pdf->ln(3);

        $pdf->Cell(5, $s+9, '', $sm, 0, 'C');
        $pdf->Cell(60, $s+9, '', $m, 0, 'C');
        $pdf->Cell(15, $s+9, '', $sm, 0, 'C');
        $pdf->Cell(30, $s+9, '', $m, 0, 'C');
        $pdf->Cell(15, $s+9, '', $sm, 0, 'C');
        $pdf->Cell(60, $s+9, '', $m, 0, 'C');
        $pdf->Cell(5, $s+9, '', $sm, 1, 'C');

        $pdf->Cell(5, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(60, $s*0.5, 'Firma', $sm, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(30, $s*0.5, 'Huella Digital', $sm, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(60, $s*0.5, 'Fecha', $sm, 0, 'C');
        $pdf->Cell(5, $s*0.5, '', $sm, 1, 'C');

        $pdf->Cell(5, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(60, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(30, $s*0.5, '(Indice derecho)', $sm, 0, 'C');
        $pdf->Cell(15, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(60, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(5, $s*0.5, '', $sm, 1, 'C');

        $pdf->ln(1.2);

        $pdf->SetFont('Arial', 'B', $t-0.6);
        $pdf->Cell(5, $s*0.5, '', $sm, 0, 'C');
        $pdf->Cell(180, $s*0.5, '*En caso de saber firmar o estar impedido bastara con la huella digital.', $sm, 0, 'L');
        $pdf->Cell(5, $s*0.5, '', $sm, 1, 'C');

        // $pdf->ln(9);

        $pdf->Output();

        exit;
    }
}
