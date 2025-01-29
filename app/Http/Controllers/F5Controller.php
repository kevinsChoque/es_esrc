<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;
use App\Models\TProcess;

class F5Controller extends Controller
{
    public function actF5($idPro)
    {
        // $f2 = TFormat2::find($idPro);
        $f2 = TProcess::where('process.idPro', '=', $idPro)
            ->leftjoin('format2', 'format2.idFo2', '=', 'process.idFo2')
            ->leftjoin('inspections', 'inspections.idFo2', '=', 'format2.idFo2')
            ->select('format2.*','inspections.*','process.*')
            ->first();
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
        $pdf->text(90,18,'FORMATO 5');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(72,22,'Resumen del Acta de Inspeccion Interna');

        $pdf->Rect(10, 24.69, 195, 230.1, 'D');
        $pdf->Rect(10, 254.7, 195, 30, 'D');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', 10.2);
        $pdf->Cell(120,$s-1.2,utf8_decode('CODIGO DE RECLAMO N°'),$marco,0,'R');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,$s-1.2,$f2->codRec,$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(40,$s-1.2,utf8_decode('N° DE SUMINISTRO'),$marco,0,'R');
        $pdf->Cell(50,$s-1.2,$f2->numSum,$marco,0,'C');
        $pdf->Cell(90,$s-1.2,'-',$marco,0,'R');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(90,$s-1.2,'NOMBRE DEL RECLAMANTE O SU REPRESENTANTE',$marco,0,'L');
        $pdf->Cell(95,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->app),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->apm),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->nombres),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Paterno',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Materno',$marco,0,'C');
        $pdf->Cell(60,3,'Nombres',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        // $pdf->SetFont('Arial', 'B', $t);

        // $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'c');
        $pdf->Cell(120,$s-1.2,'NUMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE,CI) RAZON SOCIAL',$marco,0,'L');
        // $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,$s-1.2,$f2->numIde,$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(60,$s-1.2,'RAZON SOCIAL',$marco,0,'L');
        $pdf->Cell(120,$s-1.2,$f2->razonSocial==''?'NINGUNO':utf8_decode($f2->razonSocial),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'DATOS REGISTRADOS',$marco,0,'L');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'UBICACION DEL PREDIO',$marco,0,'L');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(120,$s-1.2,utf8_decode($f2->dpcja),$marco,0,'C');
        $pdf->Cell(30,$s-1.2,utf8_decode($f2->dpn),$marco,0,'C');
        $pdf->Cell(15,$s-1.2,utf8_decode($f2->dpmz),$marco,0,'C');
        $pdf->Cell(15,$s-1.2,utf8_decode($f2->dplote),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,'Nª',$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dpub),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dpp),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dpd),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dpcp),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dptelefono),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->dpcorreo),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'Medidor Nª',$marco,0,'C');
        $pdf->Cell(60,3,'Diametro',$marco,0,'C');
        $pdf->Cell(60,3,'Ultima lectura(fecha y registro)',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');


        $pdf->ln(2.1);

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(70,$s-1.2,'TIPOS DE UNIDADES DE USO',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(20,$s-1.2,'Social',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Domestico',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Com',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Ind',$marco,0,'C');
        $pdf->Cell(30,$s-1.2,'Estatal',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(70,$s-1.2,utf8_decode('Nª de conexiones asociadas'),$marco,0,'L');
        $pdf->Cell(20,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(30,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s+5.4,'',$marco,0,'C');
        $pdf->Cell(180,$s+5.4,'',$marco,0,'C');
        $pdf->Cell(5,$s+5.4,'',$marco,1,'C');
        $pdf->text(17.1,97.2,utf8_decode('(Croquis a la espalda del presente formato, en caso de ser aplicable)'));
        $pdf->text(17.1,103.2,utf8_decode('ACTUALIZACION DE LOS DATOS DEL PREDIO (llenar si solo hay variacion)'));

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'UBICACION DEL PREDIO',$marco,0,'L');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(120,$s-1.2,utf8_decode($f2->upcjb),$marco,0,'C');
        $pdf->Cell(30,$s-1.2,utf8_decode($f2->upn),$marco,0,'C');
        $pdf->Cell(15,$s-1.2,utf8_decode($f2->upmz),$marco,0,'C');
        $pdf->Cell(15,$s-1.2,utf8_decode($f2->uplote),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,utf8_decode('N°'),$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->upub),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->upp),$marco,0,'C');
        $pdf->Cell(60,$s-1.2,utf8_decode($f2->upd),$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', $t-3);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');

        // $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(190, $s+2.7, '-', $marco, 1, 'C');
        $pdf->text(156,127,utf8_decode('Estado del abastecimiento durante la'));
        $pdf->text(169.2,131,utf8_decode('Inspeccion'));

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(50,$s-1.2,'TIPOS DE UNIDADES DE USO',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(16,$s-1.2,'Social',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Domestico',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Com',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Ind',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Estatal',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(21,$s-1.2,'Normal',$marco,0,'C');
        $pdf->Cell(24,$s-1.2,'Sin abastecimiento',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(50,$s-1.2,'',$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(21,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(24,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');


        $pdf->Cell(5,$s-1.2,'',$marco,0,'R');
        $pdf->Cell(50,$s-1.2,utf8_decode('Nº de conexiones asociadas'),$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(45,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'DETALLE DE LA INSPECCION DE LAS INSTALACIONES SANITARIAS  INTERIORES',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'-',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-2.1);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(36,$s-1.2,'Estado',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Inodoro',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Lavado',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Ducha',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Urinario',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Bidet',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Grifo',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Cisterna',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Tanque',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'Piscina',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(36,$s-1.2,'Con fuga',$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(36,$s-1.2,'Reparado',$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(36,$s-1.2,'Clausurado',$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(36,$s-1.2,'Totales',$marco,0,'L');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(16,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');


        $pdf->Cell(5, $s+30, '-', $marco, 0, 'C');
        // Guardar la posición actual
        $x = $pdf->GetX(); // Posición X después de la primera celda
        $y = $pdf->GetY(); // Posición Y actual
        $pdf->MultiCell(180, $s, utf8_decode("Observaciones:\nsalto voluptate aliquid beatae sequi maxime temporibus facilis esse iusto sed eligendi?"), 1, 'L');
        // Regresar a la posición después del MultiCell
        $pdf->SetXY($x + 180, $y);
        $pdf->Cell(5, $s+30, '-', $marco, 1, 'C');

        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'DATOS DE PERSONA PRESENTE EN LA INSPECCION',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', $t-1.8);
        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(70,$s-1.2,'Nombre de la persona presente en la inspeccion:',$marco,0,'l');
        $pdf->Cell(110,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Reclamante:',$marco,0,'l');
        $pdf->Cell(80,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'SI:',$marco,0,'C');
        $pdf->Cell(15,$s-1.2,'_____',$marco,0,'C');
        $pdf->Cell(10,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'NO:',$marco,0,'C');
        $pdf->Cell(15,$s-1.2,'_____',$marco,0,'C');
        $pdf->Cell(30,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Propietario:',$marco,0,'l');
        $pdf->Cell(25,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Inquilino:',$marco,0,'R');
        $pdf->Cell(25,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(20,$s-1.2,'Residente:',$marco,0,'R');
        $pdf->Cell(25,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(15,$s-1.2,'Otros:',$marco,0,'R');
        $pdf->Cell(30,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(70,$s-1.2,'Numero de Documento de Identidad: (DNI, LE, CI)',$marco,0,'l');
        $pdf->Cell(110,$s-1.2,'',$marco,0,'C');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5,$s-1.2,'-',$marco,0,'C');
        $pdf->Cell(180,$s-1.2,'Observaciones:',$marco,0,'l');
        $pdf->Cell(5,$s-1.2,'',$marco,1,'C');

        $pdf->Cell(5, $s+9.6, '-', $marco, 0, 'C');
        // Guardar la posición actual
        $x = $pdf->GetX(); // Posición X después de la primera celda
        $y = $pdf->GetY(); // Posición Y actual
        $pdf->MultiCell(180, $s, utf8_decode("Observaciones:\nsalto voluptate aliquid beatae sequi maxime temporibus facilis esse iusto sed eligendi? s:\nsalt"), 1, 'L');
        // Regresar a la posición después del MultiCell
        $pdf->SetXY($x + 180, $y);
        $pdf->Cell(5, $s+9.6, '-', $marco, 1, 'C');

        // $pdf->ln(6);
        $pdf->Cell(5,$s+9,'-',$marco,0,'C');
        $pdf->Cell(85,$s+9,'',$marco,0,'l');
        $pdf->Cell(10,$s+9,'',$marco,0,'l');
        $pdf->Cell(85,$s+9,'',$marco,0,'l');
        $pdf->Cell(5,$s+9,'',$marco,1,'C');

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

        // ---------------------------
        // ---------------------------
        // ---------------------------


        $pdf->Output();

        exit;
    }
}
