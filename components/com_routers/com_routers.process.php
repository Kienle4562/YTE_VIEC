<?php defined( '_VALID_MOS' ) or die( 'Warning: access denied !' );
class routersClass {
	public function router(){
		$csp_global_config = new csp_global_config;
		$front_end_com = trim( $_GET["com"] );
			switch ( $front_end_com ) {
			case "":
				include_once($csp_global_config->front_end_com_folder . "/com_default/com_default.html.php");
			break;
			default:
				$file_path = $csp_global_configfront_end_com_folder . "/$front_end_com/$front_end_com.html.php";
				if($this->routers( $file_path )){
					include_once( $file_path );
				} else {
					$this->redirect(".");
				}
			break;
		}
	}
}
?>