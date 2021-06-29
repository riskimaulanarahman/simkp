<select style="cursor:pointer;" class="form-control m-5" id="tag_select" name="year">
    <option value="0"> Pilih Tahun</option>
        <?php 
        $year = date('Y');
        $min = $year - 60;
            $max = $year;
        for( $i=$max; $i>=$min; $i-- ) {
        echo '<option value='.$i.'>'.$i.'</option>';
    }?>
</select>
<select style="cursor:pointer;" class="form-control m-5" id="tag_select" name="month">
    <option value="0"> Pilih Bulan</option>
    <option value="01"> Januari</option>
    <option value="02"> Februari</option>
    <option value="03"> Maret</option>  
    <option value="04"> April</option>
    <option value="05"> Mei</option>
    <option value="06"> Juni</option>
    <option value="07"> Juli</option>
    <option value="08"> Agustus</option>
    <option value="09"> September</option>
    <option value="10"> Oktober</option>
    <option value="11"> November</option>
    <option value="12"> Desember</option>
       
</select>
{{-- <select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" class="form-control m-5" id="tag_select" name="month">
    <option value="0" selected disabled> Pilih Bulan</option>
    <option value="01"> Januari</option>
    <option value="02"> Februari</option>
    <option value="03"> Maret</option>
    <option value="04"> April</option>
    <option value="05"> Mei</option>
    <option value="06"> Juni</option>
    <option value="07"> Juli</option>
    <option value="08"> Agustus</option>
    <option value="09"> September</option>
    <option value="10"> Oktober</option>
    <option value="11"> November</option>
    <option value="12"> Desember</option>
</select> --}}
<input class="btn btn-info m-5" type="submit" value="Cari Data"/>