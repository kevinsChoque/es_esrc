<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;

class F2Controller extends Controller
{
    public function actF2($idFo2)
    {
        $marco = 1;
    	$smarco = 0;
        $t = 8.1;
        $t = 9;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        $pdf->Image(public_path('img/emusap_logo.png'), 10, 10, 35, 15);

        $pdf->Cell(190,20,'-',$marco,1,'C');
        // $pdf->Cell(80,20,'-',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->text(90,16,'FORMATO 2');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(81,22,'Presentacion del Reclamo');

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', 10.2);
        $pdf->Cell(120,6,utf8_decode('CODIGO DE RECLAMO N°'),$marco,0,'R');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,6,'2024 - 1193',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(40,6,utf8_decode('N° DE SUMINISTRO'),$marco,0,'R');
        $pdf->Cell(50,6,'70-1193',$marco,0,'C');
        $pdf->Cell(30,6,'Telefono',$marco,0,'R');
        $pdf->Cell(60,6,'987654321',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'salas',$marco,0,'C');
        $pdf->Cell(60,6,'cuaresma',$marco,0,'C');
        $pdf->Cell(60,6,'grimanesa',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Paterno',$marco,0,'C');
        $pdf->Cell(60,3,'Apellido Paterno',$marco,0,'C');
        $pdf->Cell(60,3,'Nombres',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->ln(2);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(5,6,'-',$marco,0,'c');
        $pdf->Cell(120,6,'NUMERO DE DOCUMENTO DE IDENTIDAD (DNI, LE,CI) RAZON SOCIAL',$marco,0,'L');
        $pdf->SetFont('Arial', 'B', $t);
        $pdf->Cell(60,6,'47692340',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'RAZON SOCIAL',$marco,0,'L');
        $pdf->Cell(120,6,'NINGUNO',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'UBICACION DEL PREDIO',$marco,0,'L');
        $pdf->Cell(125,6,'',$marco,1,'C');

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(120,6,'AV. cahuide',$marco,0,'C');
        $pdf->Cell(30,6,'s/n',$marco,0,'C');
        $pdf->Cell(15,6,'r',$marco,0,'C');
        $pdf->Cell(15,6,'45',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,'Nª',$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'Urb. casco urbano',$marco,0,'C');
        $pdf->Cell(60,6,'abancay',$marco,0,'C');
        $pdf->Cell(60,6,'abancay',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'DOMICILIO PROCESAL',$marco,0,'L');
        $pdf->Cell(125,6,'',$marco,1,'C');

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(120,6,'AV. cahuide',$marco,0,'C');
        $pdf->Cell(30,6,'s/n',$marco,0,'C');
        $pdf->Cell(15,6,'r',$marco,0,'C');
        $pdf->Cell(15,6,'45',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(120,3,'(Calle, Jiron, Avenida)',$marco,0,'C');
        $pdf->Cell(30,3,'Nª',$marco,0,'C');
        $pdf->Cell(15,3,'Mz',$marco,0,'C');
        $pdf->Cell(15,3,'Lote',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'Urb. casco urbano',$marco,0,'C');
        $pdf->Cell(60,6,'abancay',$marco,0,'C');
        $pdf->Cell(60,6,'abancay',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell(5,3,'-',$marco,0,'C');
        $pdf->Cell(60,3,'(Urbanizacion, barrio)',$marco,0,'C');
        $pdf->Cell(60,3,'Provincia',$marco,0,'C');
        $pdf->Cell(60,3,'Distrito',$marco,0,'C');
        $pdf->Cell(5,3,'-',$marco,1,'L');
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,6,'-',$marco,0,'C');
        $pdf->Cell(60,6,'03001',$marco,0,'C');
        $pdf->Cell(60,6,'987654321',$marco,0,'C');
        $pdf->Cell(60,6,'csacasc@gmail.com',$marco,0,'C');
        $pdf->Cell(5,6,'-',$marco,1,'L');

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
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->text(18,137.1,utf8_decode('Solicito que las notificaciones delos actos administrativos del presente procedimiento de reclamo se realicen en?'));
        $pdf->text(18,138.9,utf8_decode('la direccion de correo electronico consignado para lo cual brindo mi autorizacion expresa.'));
        $pdf->SetFont('Arial', 'B', $t);

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(180,6,'TIPO DE RECLAMO (Indique la letra del tipo de reclamo) Tipo de reclamo (ver lista en reverso)',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(70,9,'Tipo de reclamo (ver lisyta en reverso)',$marco,0,'C');
        $pdf->Cell(110,9,'Consumo medido (item ii)',$marco,0,'L');
        $pdf->Cell(5,9,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(180,6,'BREVE DESCRIPCION DEL RECLAMO (meses reclamados, montos, etc. En lo aplicable)',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,12,'-',$marco,0,'L');
        $pdf->Cell(180,12,'csacsac',$marco,0,'L');
        $pdf->Cell(5,12,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(60,6,'SUCURSAL/ZONAL',$marco,0,'C');
        $pdf->Cell(120,6,'Abancay',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(60,6,'ATENDIDO POR',$marco,0,'C');
        $pdf->Cell(60,6,'JAMILETH CRUZ',$marco,0,'L');
        $pdf->Cell(20,6,'FIRMA',$marco,0,'L');
        $pdf->Cell(40,6,'',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(1);

        // $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(180,6,'FUNDAMENTO DEL RECLAMO (En caso de ser necesario, se podran adjuntar paginas adicionales)',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,12,'-',$marco,0,'L');
        $pdf->Cell(180,12,'',$marco,0,'L');
        $pdf->Cell(5,12,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(180,6,'RELACION DE PRUEBAS QUE SE PRESENTAN ADJUNTAS',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->Cell(5,6,'-',$marco,0,'L');
        $pdf->Cell(60,6,'csa',$marco,0,'L');
        $pdf->Cell(120,6,'csa',$marco,0,'L');
        $pdf->Cell(5,6,'-',$marco,1,'L');

        $pdf->ln(2);

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(150,9,'-',$marco,0,'L');
        $pdf->Cell(15,4.5,'SI',$marco,0,'C');
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->text(18,231.9,utf8_decode('LA EMPRESA PRESTADORA ENTREGA CARTILLA INFORMATIVA.'));

        $pdf->ln(2);

        $pdf->Cell(5,9,'-',$marco,0,'L');
        $pdf->Cell(150,9,'-',$marco,0,'L');
        $pdf->Cell(15,4.5,'SI',$marco,0,'C');
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->Cell(155,4.5,'-',$smarco,0,'L');
        $pdf->Cell(15,4.5,'NO',$marco,0,'C');
        $pdf->Cell(15,4.5,'-',$marco,0,'L');
        $pdf->Cell(5,4.5,'-',$marco,1,'L');

        $pdf->text(18,252,utf8_decode('LA EMPRESA PRESTADORA ENTREGA CARTILLA INFORMATIVA.'));


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
