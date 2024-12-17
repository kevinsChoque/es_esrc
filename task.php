cambios a realizar de la reunion del 25 de noviembre

-q en el formulario de llenado de reclamo en el portal, se pueda
agregar la opcion de escoger elegir responsable o oficial y q pueda subir
su dni obligatorio en ambnos casos y carta poder en caso de responsable

-subir en un solo archivo el f5 y f6 y talvez el formato 7
consultar si es necesario que se genere el formato 7, caso
contrario solo que lo adjunte con los demas archivos

-que ayga un usuario adicional que pueda firmar la declaracion
donde se menciona si es fundado o infundado

-en el proceso ay opcion de reconsideracion tanto en fundado
o infundado, como tambien puede apelar directamente

-



1=>ingresado
9=>terminado

---posiblemente esto traiga errores
private function accordingNew($r)
    {
        // dd($r->all());

        $conSql = $this->connectionSql();
        if($conSql)
        {
            $values = explode('-', $r->suministro);
            $script = "select * from CONEXION c
            left outer join rzcalle rz ON rz.calcod = c.precalle
            where c.PreMzn='".$values[0]."' and c.PreLote='".$values[1]."'";
            $stmt = sqlsrv_query($conSql, $script);
            $reg = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
            if(!$reg)
                return response()->json(['state'=>false,'message'=>"Ocurrio problemas al buscar el registro. "]);
            $ins = trim($reg['InscriNro']);
            ------------------------esta linea
            $existReclaim = TFormat2::where('pnumIns',$ins)->where('process','1')->exists();
            if($existReclaim)
                return response()->json(['state'=>false,'message'=>"El usuario ya cuenta con un reclamo en proceso."]);
        }
