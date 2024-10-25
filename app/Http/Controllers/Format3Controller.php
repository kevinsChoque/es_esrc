<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\TFormat2;

class Format3Controller extends Controller
{
    // actShow
    public function actShow($ins)
    {
        // dd($ins);
        $fo2 = TFormat2::where('pnumIns',$ins)->first();
        // dd($this->getMonthBig($fo2->pmeses,'2024'));
        $conSql = $this->connectionSql();
        if($conSql)
        {
// datos
            $script = "select top 1 uni.Tarifa,CONCAT(uni.PreRegion, ' ', uni.PreZona, ' ', uni.PreSector, ' ', uni.PreMzn, ' ', con.PreLote, ' ', con.PreSubLote) AS codCat, con.Clinomx,
                rzc.CalTip + ' ' + rzc.CalDes as direccion,rlu.UrbTip+' '+rlu.UrbDes as urbanizacion, uni.PreMzn,uni.PreLote
                from CONEXION con
                inner join RZCALLE rzc on con.precalle=rzc.calcod
                inner join UNIDUSO uni on con.PreLote=uni.PreLote and con.PreMzn=uni.PreMzn
                inner join RLURBA rlu on con.PreUrba=rlu.UrbCod
            where con.InscriNro='".$fo2->pnumIns."'";
            $stmt = sqlsrv_query($conSql, $script);
            $rec = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            // dd($rec);
// unidades de uso
            $script = "select * from UNIDUSO where PreMzn='".$rec['PreMzn']."' and PreLote='".$rec['PreLote']."'";
            $stmt = sqlsrv_query($conSql, $script);
            $listUni = array();
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
            {   $listUni[] = $row['Tarifa'];}
            $tarifas = implode('-', $listUni);
// mese de reclamo
            $months = $this->getDatesByMonth($fo2->pmeses);
            $script = "SELECT FORMAT(CONVERT(DATE, t.FacFecFac, 105), 'MMMM') AS monthClaim,
                CAST(YEAR(CONVERT(DATE, t.FacFecFac, 105)) AS VARCHAR(4)) AS anioClaim,
                t.FacVenFec,t.FacTotal,t.FConsumo
                FROM CONEXION c
                INNER JOIN TOTFAC t ON c.InscriNro = t.InscriNrx
                WHERE c.InscriNro = '".$fo2->pnumIns."'
                AND t.FacFecFac in (".$months.") order by t.FacFecFac desc";
            $stmt = sqlsrv_query($conSql, $script);
            $claimed = array();
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
            {   $claimed[] = $row;}
            // dd($script,$claimed[0]['FacVenFec']->format('d-m-Y'));
            // ----------------------------------------
            // $month = $claimed[0]['FacVenFec']->format('d-m-Y');
// ultimos 12
            $month = $this->getMonthBig($fo2->pmeses,'2024');
            $script = "SELECT top 12 FORMAT(CONVERT(DATE, t.FacFecFac, 105), 'MMMM') AS monthClaim,
                CAST(YEAR(CONVERT(DATE, t.FacFecFac, 105)) AS VARCHAR(4)) AS anioClaim,
                t.FacVenFec,
                t.FacTotal,
                t.FConsumo,
	            t.FecPago
            FROM
                CONEXION c
            INNER JOIN
                TOTFAC t ON c.InscriNro = t.InscriNrx
            WHERE
                c.InscriNro = '".$fo2->pnumIns."'
                AND CONVERT(DATE, t.FacFecFac, 105) BETWEEN DATEADD(MONTH, -11, '".$month."')
                AND '".$month."'
            ORDER BY
                t.FacFecFac DESC";

            $stmt = sqlsrv_query($conSql, $script);
            $last12 = array();
            while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
            {   $last12[] = $row;}
            // dd($script,$last12);
        }
        // dd($this->getDatesByMonth($fo2->pmeses));
        // dd('ccnajnsd josdvnosnd ovdson');
        $marco = 0;
    	$smarco = 0;
        $pdf = new Fpdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 9);
// cabezera
        $pdf->Image(public_path('img/emusap_logo.png'), 10, 10, 35, 20);

        $pdf->Cell(110,20,'-',$marco,0,'C');
        $pdf->Cell(80,20,'-',$marco,1,'C');

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->text(48,16,'EMUSAP S.A.C');
        $pdf->text(48,22,'RESUMEN HISTORICO DE');
        $pdf->text(48,28,'FACTURACION');

        $pdf->Rect(120 , 10, 80, 20, 'D');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->text(123,15,utf8_decode('Nª Reclamo:'));
        $pdf->text(177,15,$fo2->codRec);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(123,20,utf8_decode('INSCRIPCION:'));
        $pdf->text(153,20,$fo2->pnumIns);
        $pdf->text(123,24,utf8_decode('COD.CAT.'));
        $pdf->text(153,24,$rec['codCat']);
        $pdf->text(123,28,utf8_decode('FECHA'));
        $pdf->text(153,28,$fo2->dateReg);

// cliente
        $pdf->Rect(10 , 30, 190, 6, 'D');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(5,6,'',$marco,0,'C');
        $pdf->Cell(25,6,'Cliente',$marco,0,'L');
        $pdf->Cell(80,6,$rec['Clinomx'],$marco,0,'L');
        $pdf->Cell(10,6,'D.N.I',$marco,0,'C');
        $pdf->Cell(25,6,'aaaa',$marco,0,'C');
        $pdf->Cell(10,6,'R.U.C',$marco,0,'C');
        $pdf->Cell(35,6,'aaaa',$marco,1,'C');
// direccion
        $pdf->Rect(10 , 36, 190, 12, 'D');
        $pdf->Cell(5,6,'',$marco,0,'L');
        $pdf->Cell(25,6,'Direccion',$marco,0,'L');
        $pdf->Cell(115,6,utf8_decode($rec['direccion']),$marco,0,'L');
        $pdf->Cell(15,6,'Telefono',$marco,0,'L');
        $pdf->Cell(30,6,'csac',$marco,1,'C');

        $pdf->Cell(5,6,'',$marco,0,'C');
        $pdf->Cell(25,6,'Urb.:',$marco,0,'L');
        $pdf->Cell(80,6,utf8_decode($rec['urbanizacion']),$marco,0,'L');
        $pdf->Cell(20,6,'Provincia:',$marco,0,'C');
        $pdf->Cell(20,6,'Abancay',$marco,0,'C');
        $pdf->Cell(20,6,'Distrito:',$marco,0,'C');
        $pdf->Cell(20,6,'Abancay',$marco,1,'C');
// categoria
        $pdf->Rect(10 , 48, 190, 12, 'D');
        $pdf->Cell(5,6,'',$marco,0,'C');
        $pdf->Cell(40,6,'CATEGORIA TARIFARIA:',$marco,0,'C');
        $pdf->Cell(65,6,$tarifas,$marco,0,'C');
        $pdf->Cell(50,6,'Numero de unidades de uso:',$marco,0,'C');
        $pdf->Cell(30,6,count($listUni),$marco,1,'C');

        $pdf->Cell(5,6,'',$marco,0,'C');
        $pdf->Cell(30,6,'TIPO DE PREDIO:',$marco,0,'L');
        $pdf->Cell(155,6,'UNIFAMILIAR',$marco,1,'L');
// DATOS DEL ABASTECIMIENTO
        $pdf->Rect(10 , 60, 190, 12, 'D');
        $pdf->Cell(5,6,'',$marco,0,'L');
        $pdf->Cell(60,6,'DATOS DEL ABASTECIMIENTO:',$marco,0,'L');
        $pdf->Cell(25,6,'Frecuencia del',$marco,0,'L');
        $pdf->Cell(20,6,'A. Diario',$marco,0,'L');
        $pdf->Cell(15,6,'( X )',$marco,0,'C');
        $pdf->Cell(25,6,'Continuidad:',$marco,0,'L');
        $pdf->Cell(25,6,'A. 24 horas',$marco,0,'L');
        $pdf->Cell(15,6,'( X )',$marco,1,'C');

        $pdf->Cell(5,6,'',$marco,0,'L');
        $pdf->Cell(35,6,'Codigo del sector:',$marco,0,'L');
        $pdf->Cell(25,6,'___',$marco,0,'L');
        $pdf->Cell(25,6,'Servicio:',$marco,0,'L');
        $pdf->Cell(20,6,'B. No diario',$marco,0,'L');
        $pdf->Cell(15,6,'(  )',$marco,0,'C');
        $pdf->Cell(25,6,'',$marco,0,'C');
        $pdf->Cell(25,6,'B < 24 horas',$marco,0,'L');
        $pdf->Cell(15,6,'(  )',$marco,1,'C');
// facturas reclamads
        $pdf->Rect(10 , 72, 190, 13.2, 'D');
        $pdf->Cell(5,6,'',$marco,0,'L');
        $pdf->Cell(185,6,'FACTURAS RECLAMADAS',$marco,1,'L');

        $yPosition = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->MultiCell(5, 3, "-", $marco, 'L');
        $pdf->SetXY(15, $yPosition);
        $pdf->MultiCell(25, 3, "Mes reclamado", $marco, 'C');
        $pdf->SetXY(40, $yPosition);
        $pdf->MultiCell(10, 3, utf8_decode("Año"), $marco, 'C');
        $pdf->SetXY(50, $yPosition);
        $pdf->MultiCell(25, 3.6, "Fecha de Vencimiento", $marco, 'C');
        $pdf->SetXY(75, $yPosition);
        $pdf->MultiCell(25, 3.6, "Forma de Facturacion", $marco, 'C');
        $pdf->SetXY(100, $yPosition);
        $pdf->MultiCell(25, 3.6, "Importe facturado S/.", $marco, 'C');
        $pdf->SetXY(125, $yPosition);
        $pdf->MultiCell(25, 3.6, "Volumen Facturado", $marco, 'C');
        $pdf->SetXY(150, $yPosition);
        $pdf->MultiCell(24, 3.6, "Volumen Leido", $marco, 'C');
        $pdf->SetXY(174, $yPosition);
        $pdf->MultiCell(15, 3.6, "Tarifa Tarifa", $marco, 'C');

        $pdf->Rect(10 , 85.2, 190, 12, 'D');
        foreach ($claimed as $claim)
        {
            $pdf->Cell(5,6,'',$marco,0,'L');
            $pdf->Cell(25,6,$claim['monthClaim'],$marco,0,'L');
            $pdf->Cell(10,6,$claim['anioClaim'],$marco,0,'C');
            $pdf->Cell(25,6,$claim['FacVenFec']->format('d/m/Y'),$marco,0,'C');
            $pdf->Cell(25,6,'consumo',$marco,0,'L');//???
            $pdf->Cell(25,6,number_format($claim['FacTotal'],2),$marco,0,'C');
            $pdf->Cell(25,6,$claim['FConsumo'],$marco,0,'C');
            $pdf->Cell(24,6,$claim['FConsumo'],$marco,0,'C');
            $pdf->Cell(15,6,$tarifas,$marco,1,'C');//???
        }
// ultimos 12 meses
        $pdf->Rect(10 , 97.2, 190, 13.2, 'D');
        $pdf->Cell(5,6,'',$marco,0,'L');
        $pdf->Cell(185,6,'INFORMACION DE LOS ULTIMOS 12 MESES ANTERIOR A LAS FACTURAS RECLAMADAS:',$marco,1,'L');
        $yPosition = $pdf->GetY();
        $pdf->SetX(10);
        $pdf->MultiCell(5, 3.6, "", $marco, 'L');
        $pdf->SetXY(15, $yPosition);
        $pdf->MultiCell(10, 3.6, utf8_decode("Nª"), $marco, 'C');
        $pdf->SetXY(25, $yPosition);
        $pdf->MultiCell(20, 3.6, "Mes", $marco, 'C');
        $pdf->SetXY(45, $yPosition);
        $pdf->MultiCell(10, 3.6,utf8_decode("Año"), $marco, 'C');
        $pdf->SetXY(55, $yPosition);
        $pdf->MultiCell(20, 3.6, "Situacion", $marco, 'C');
        $pdf->SetXY(75, $yPosition);
        $pdf->MultiCell(21, 3.6, "Fecha de vencimiento", $marco, 'C');
        $pdf->SetXY(96, $yPosition);
        $pdf->MultiCell(21, 3.6, "Forma de facturacion", $marco, 'C');
        $pdf->SetXY(117, $yPosition);
        $pdf->MultiCell(25, 3.6, "Importe facturado S/.", $marco, 'C');
        $pdf->SetXY(142, $yPosition);
        $pdf->MultiCell(21, 3.6, "Volumen Facturado", $marco, 'C');
        $pdf->SetXY(163, $yPosition);
        $pdf->MultiCell(21, 3.6, "Volumen Leido", $marco, 'C');
        $pdf->SetXY(184, $yPosition);
        $pdf->MultiCell(16, 3.6, "Fecha de pago", $marco, 'C');

        $pdf->Rect(10 , 110.4, 190, 72, 'D');
        foreach ($last12 as $index => $mon)
        {
            $pdf->Cell(5,6,'',$marco,0,'C');
            $pdf->Cell(10,6,$index+1,$marco,0,'C');
            $pdf->Cell(20,6,$mon['monthClaim'],$marco,0,'C');
            $pdf->Cell(10,6,$mon['anioClaim'],$marco,0,'C');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(20,6,(strpos(strtolower($fo2->pmeses), $mon['monthClaim']) !== false?'RECLAMO':'CANCELADO'),$marco,0,'C');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(21,6,$mon['FacVenFec']->format('d/m/Y'),$marco,0,'C');
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(21,6,'CONSUMO',$marco,0,'C');//???
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(25,6,number_format($mon['FacTotal'],2),$marco,0,'C');
            $pdf->Cell(21,6,$mon['FConsumo'],$marco,0,'C');
            $pdf->Cell(21,6,$mon['FConsumo'],$marco,0,'C');
            $pdf->Cell(16,6,$mon['FecPago']->format('d/m/y'),$marco,1,'C');//???
        }
// firma
        $pdf->ln(6);
        $pdf->Cell(5,9,'',0,0,'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(120,9,'jamileth cruz dni 434343',$marco,0,'L');
        $pdf->Cell(65,9,$fo2->dateReg,0,1,'C');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->text(20,200.4,'Nombre, Firma y DNI del responsable de la EPS');
        $pdf->text(162,200.4,'Fecha');
// --------------------------------
// --------------------------------
// --------------------------------

        $pdf->Output();

        exit;
    }
}
