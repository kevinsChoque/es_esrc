<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;

class F9Controller extends Controller
{
    public function actF9($idFo2)
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
        $pdf->text(81,22,'Solicitud de contrastacion de medidor de agua potable');

        $pdf->Rect(10, 24.69, 195, 230.1, 'D');
        $pdf->Rect(10, 254.7, 195, 20, 'D');

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', 10.2);
        $pdf->Cell(120,6,utf8_decode('CODIGO DE RECLAMO N°'),$marco,0,'R');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,6,$f2->codRec,$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(40,$s,utf8_decode('N° DE SUMINISTRO'),$marco,0,'R');
        $pdf->Cell(50,$s,$f2->numSum,$marco,0,'C');
        $pdf->Cell(30,$s,'Telefono',$marco,0,'R');
        $pdf->Cell(60,$s,$f2->dptelefono,$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->app),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->apm),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->nombres),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Paterno',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Materno',$marco,0,'C');
        $pdf->Cell(60,3,'Nombres',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->ln(2);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(5,$s,'-',$marco,0,'c');
        $pdf->Cell(120,$s,'NUMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE,CI) RAZON SOCIAL',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,$s,$f2->numIde,$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,'RAZON SOCIAL',$marco,0,'L');
        $pdf->Cell(120,$s,$f2->razonSocial==''?'NINGUNO':utf8_decode($f2->razonSocial),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,'UBICACION DEL PREDIO',$marco,0,'L');
        $pdf->Cell(125,$s,'',$marco,1,'C');

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(120,$s,utf8_decode($f2->upcjb),$marco,0,'C');
        $pdf->Cell(30,$s,utf8_decode($f2->upn),$marco,0,'C');
        $pdf->Cell(15,$s,utf8_decode($f2->upmz),$marco,0,'C');
        $pdf->Cell(15,$s,utf8_decode($f2->uplote),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,utf8_decode('N°'),$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->upub),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->upp),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->upd),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,'DOMICILIO PROCESAL',$marco,0,'L');
        $pdf->Cell(125,$s,'',$marco,1,'C');

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(120,$s,utf8_decode($f2->dpcja),$marco,0,'C');
        $pdf->Cell(30,$s,utf8_decode($f2->dpn),$marco,0,'C');
        $pdf->Cell(15,$s,utf8_decode($f2->dpmz),$marco,0,'C');
        $pdf->Cell(15,$s,utf8_decode($f2->dplote),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,'Nª',$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dpub),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dpp),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dpd),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'-',$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dpcp),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dptelefono),$marco,0,'C');
        $pdf->Cell(60,$s,utf8_decode($f2->dpcorreo),$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'Codigo Postal',$marco,0,'C');
        $pdf->Cell(60,3,'Telefono / Celular',$marco,0,'C');
        $pdf->Cell(60,3,'Correo electronico',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'L');
        $pdf->Cell(180,3,'DECLARACION DEL RECLAMANTE (Fijacion del correo electronico como domicilio procesal):',$marco,0,'L');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(150,9,'-',$marco,0,'L');
        $pdf->Cell(15,4.5,'SI',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->declaracionReclamo=='1'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->declaracionReclamo=='0'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7.5);
        $pdf->text(18,125.1,utf8_decode('Solicito que las notificaciones delos actos administrativos del presente procedimiento de reclamo se realicen en?'));
        $pdf->text(18,127.5,utf8_decode('la direccion de correo electronico consignado para lo cual brindo mi autorizacion expresa.'));
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(180,$s,'TIPO DE RECLAMO (Indique la letra del tipo de reclamo) Tipo de reclamo (ver lista en reverso)',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(70,9,'Tipo de reclamo (ver lisyta en reverso)',$marco,0,'C');
        // $pdf->Cell(110,9,'Consumo medido (item ii)'.$f2->tipoReclamo,$marco,0,'L');
        $pdf->Cell(110,9,$f2->tipoReclamo,$marco,0,'L');
        $pdf->Cell(5,9,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(180,$s,'BREVE DESCRIPCION DEL RECLAMO (meses reclamados, montos, etc. En lo aplicable)',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,12,'-',$marco,0,'L');
        $pdf->Cell(180,12,$f2->descripcion,$marco,0,'L');
        $pdf->Cell(5,12,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(60,$s,'SUCURSAL/ZONAL',$marco,0,'C');
        $pdf->Cell(120,$s,$f2->sucursal,$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(60,$s,'ATENDIDO POR',$marco,0,'C');
        $pdf->Cell(60,$s, $f2->atendido,$marco,0,'L');
        $pdf->Cell(20,$s,'FIRMA',$marco,0,'L');
        $pdf->Cell(40,$s,'',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->ln(1);

        // $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(180,$s,'FUNDAMENTO DEL RECLAMO (En caso de ser necesario, se podran adjuntar paginas adicionales)',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,12,'-',$marco,0,'L');
        $pdf->Cell(180,12, $f2->fundamento,$marco,0,'L');
        $pdf->Cell(5,12,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(180,$s,'RELACION DE PRUEBAS QUE SE PRESENTAN ADJUNTAS',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(60,$s,'copia de recibo y dni',$marco,0,'L');
        $pdf->Cell(120,$s,'csa',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(150,9,'-',$marco,0,'L');
        $pdf->Cell(15,4.5,'SI',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->cartilla=='1'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->cartilla=='0'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->text(18,216,utf8_decode('LA EMPRESA PRESTADORA ENTREGA CARTILLA INFORMATIVA.'));

        $pdf->ln(2);

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(150,9,'-',$marco,0,'L');
        $pdf->Cell(15,4.5,'SI',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->declaracion=='1'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,$f2->declaracion=='0'?'X':'',$marco,0,'C');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->text(18,225,utf8_decode('DECLARACION DEL RECLAMANTE (aplicable a reclamos por consumo medido). Solicito la realizacion de prueba'));
        $pdf->text(18,227.7,utf8_decode('verificacion posterior y acepto asumir su costo, si el resultado de la prueba indica que el medidor no sobreregistra'));
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(180,$s,'INFORMACION A SER COMPLETADA POR LA EMPRESA PRESTADORA',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(60,$s,'INSPECCION INTERNA Y EXTERNA',$marco,0,'L');
        $pdf->Cell(20,$s,'FECHA',$marco,0,'C');
        $pdf->Cell(30,$s,'12/23/2024',$marco,0,'C');
        $pdf->Cell(40,$s,'HORA (RANGO DE 2 HORAS)',$marco,0,'C');
        $pdf->Cell(30,$s,'CSACSA',$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,$s,'-',$marco,0,'L');
        $pdf->Cell(60,$s,'CITACION A REUNION DE CONCILIACION',$marco,0,'L');
        $pdf->Cell(20,$s,'FECHA',$marco,0,'C');
        $pdf->Cell(30,$s,$f2->reunion,$marco,0,'C');
        $pdf->Cell(40,$s,'HORA',$marco,0,'C');
        $pdf->Cell(30,$s,$f2->horaReunion,$marco,0,'L');
        $pdf->Cell(5,$s,'-',$marco,1,'C');

        $pdf->Cell(5,$s,'-',$marco,0,'c');
        $pdf->Cell(100,$s,'FECHA MAXIMA DE NOTIFICACION DE LA RESOLUCION',$marco,0,'L');
        $pdf->Cell(30,$s,'(DD/MM//AA)',$marco,0,'C');
        $pdf->Cell(50,$s,$f2->notificacion,$marco,0,'C');
        $pdf->Cell(5,$s,'-',$marco,1,'C');

        $pdf->ln(2);

        $pdf->Cell(5,12,'-',$marco,0,'C');
        $pdf->Cell(50,12,'cas',$marco,0,'C');
        $pdf->Cell(15,12,'-',$marco,0,'C');
        $pdf->Cell(50,12,'casc',$marco,0,'C');
        $pdf->Cell(15,12,'-',$marco,0,'C');
        $pdf->Cell(50,12,$f2->dateReg,$marco,0,'C');
        $pdf->Cell(5,12,'-',$marco,1,'C');

        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(50,3,'Firma del reclamante',$marco,0,'C');
        $pdf->Cell(15,3,'-',$marco,0,'C');
        $pdf->Cell(50,3,'Huella digital',$marco,0,'C');
        $pdf->Cell(15,3,'-',$marco,0,'C');
        $pdf->Cell(50,3,'Fecha',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'C');

        $pdf->ln(1);

        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(185,3,'*En caso de no saber firmar o estar impedido, bastara con la huella digital.',$marco,1,'L');





        // $pdf->Rect(120 , 10, 80, 20, 'D');
        // $pdf->SetFont('Arial', 'B', 12);
        // $pdf->text(123,15,utf8_decode('Nª Reclamo:'));
        // $pdf->text(177,15,'codRec');
        // $pdf->SetFont('Arial', 'B', 9);
        // $pdf->text(123,20,utf8_decode('INSCRIPCION:'));
        // $pdf->text(153,20,'pnumIns');
        // $pdf->text(123,24,utf8_decode('COD.CAT.'));
        // $pdf->text(153,24,'codCat');
        // $pdf->text(123,28,utf8_decode('FECHA'));
        // $pdf->text(153,28,'dateReg');

// cliente
        // $pdf->Rect(10 , 30, 190, 6, 'D');
        // $pdf->SetFont('Arial', 'B', 9);
        // $pdf->Cell(5,6,'',$marco,0,'C');
        // $pdf->Cell(25,6,'Cliente',$marco,0,'L');
        // $pdf->Cell(80,6,'Clinomx',$marco,0,'L');
        // $pdf->Cell(10,6,'D.N.I',$marco,0,'C');
        // $pdf->Cell(25,6,'aaaa',$marco,0,'C');
        // $pdf->Cell(10,6,'R.U.C',$marco,0,'C');


        $pdf->Output();

        exit;
    }
}
