<?php 
/**
 * Shell backdoor Scanner | galehdotid
 * thx   : Indoxploit - xaisyndicate - all indonesia Hacker Rulez
 * Open Result : shell-found.txt !
 * refensi : IndoXploit
 * Usage :  Usage : php scan.php /home or /public_html/
 */
error_reporting(0);
function ngebaca($iqro){
	$r = fopen("$iqro", "r");
	     fread($r, filesize("$iqro"));
	     fclose($r);
	 return $r;
}
function buka_dir($path){
	 if(is_readable($path)){
	 	$dirna = scandir("$path");
	foreach ($dirna as $key) {
		if($key == "." | $key == ".."){
		}elseif (is_dir("$path/$key")) {
			$open = buka_dir("$path/$key");
		}else{
			$ngecek = ngebaca("$path/$key");
			  if($ngecek){
                 		 $word = "Jumping|SAFE|Fake|cPanel|Jumping|shell|newfile|newfolder|pass|password|text|indoxploit|upload|eval|php|hacked|linux|windows|by|here|base_64|hacker|wso|shell_exec|base64_decode|chmod|eval|php_uname";
			  	if(strpos($word, $ngecek) !== false){
			  		echo "[+] Di temukan shell -> $path/$key\n";
			  		echo "[+] Please waitt..\n";
						$file = fopen("shell-found.txt", "a");
						        fwrite($file, "$path/$key". "\r\n");
						        fclose($file);
					}else{
						echo "[-] Not found : -> $path/$key\n\n";
					}
			  }
		}
	}
 }else{
	echo "[!] Dir Tidak Readable";
}
}
if($argv[1]){
$dir = $argv[1];
$coba = buka_dir("$dir");
// echo $coba;
}else{
	echo "Usage php scan.php /home or /public_html/.";
}
?>
