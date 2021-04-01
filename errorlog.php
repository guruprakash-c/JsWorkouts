<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('track_errors', 1);
ini_set('error_log', dirname(__FILE__).'/Failedlog.log');
error_reporting(0);

mysqli_connect('local','dd','','sdf');

function ErrorDisplay(){
	$err = error_get_last();
	$errArr = array('type'=>'','message'=>'','file'=>'','position'=>'');
	if(is_array($err)){
		$type = FriendlyErrorType($err['type']);
		$alertType = '';
		if(strpos($type,"ERROR") == true){
			$alertType = 'danger';
		} elseif(strpos($type,"WARNING") == true){
			$alertType = 'warning';
		} elseif(strpos($type,"NOTICE") == true){
			$alertType = 'info';
		} elseif(strpos($type,"DEPRECATED") == true){
			$alertType = 'info';
		} else{
			$alertType = 'success';
		}

		$alertMessage = $err['message'];
		$alertFile = $err['file'];
		$alertLine = $err['line'];
		$errArr = array('type'=>$alertType,'message'=>$alertMessage,'file'=>$alertFile,'position'=>$alertLine);
	}
	return $errArr;
}
function FriendlyErrorType($type){
    switch($type)
    {
        case E_ERROR: // 1 //
            return 'E_ERROR';
        case E_WARNING: // 2 //
            return 'E_WARNING';
        case E_PARSE: // 4 //
            return 'E_PARSE';
        case E_NOTICE: // 8 //
            return 'E_NOTICE';
        case E_CORE_ERROR: // 16 //
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: // 32 //
            return 'E_CORE_WARNING';
        case E_COMPILE_ERROR: // 64 //
            return 'E_COMPILE_ERROR';
        case E_COMPILE_WARNING: // 128 //
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: // 256 //
            return 'E_USER_ERROR';
        case E_USER_WARNING: // 512 //
            return 'E_USER_WARNING';
        case E_USER_NOTICE: // 1024 //
            return 'E_USER_NOTICE';
        case E_STRICT: // 2048 //
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: // 4096 //
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: // 8192 //
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: // 16384 //
            return 'E_USER_DEPRECATED';
    }
    return "";
} 
ini_set('track_errors', 0);
?>
<?php 
$get_err = ErrorDisplay();
$typ_=$get_err['type'];
$msg_=$get_err['message'];
$file_=$get_err['file'];
$pos_=$get_err['position'];
?>
<div class="alert alert-<?=($typ_) ?> alert-dismissible fade show" role="alert">
  <strong><?=(strtoupper($typ_).'!') ?></strong> <?=(ucfirst($msg_)) ?> in <?=(basename($file_)) ?> at <?=($pos_) ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>