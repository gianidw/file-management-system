<?php
if (!defined('BASEPATH')) exit("No direct script access allowed");


//custom loader file to load header and footer between modules
class MY_Loader extends CI_Loader{

	function __construct(){
		parent::__construct();
	}

	function template($viewfile, $vars = array(), $return = FALSE, $HeaderFooter = TRUE)
	{
		$HeaderFooter = ($HeaderFooter == 0) ? FALSE : $HeaderFooter;
		$paramCount = func_num_args();
		$viewFileList = [];

		if(!is_array($viewfile))
		{
			$viewFileList[] = $viewfile;
		}


		foreach($viewFileList as $pathViewFile)
		{
			if(!file_exists(APPPATH.'views'.DIRECTORY_SEPARATOR.$pathViewFile.".php"))
			{
				show_404();
				break;
			}

		}

		$return = (!is_bool($return)) ? FALSE : $return;
		$HeaderFooter = (!is_bool($HeaderFooter)) ? TRUE : $HeaderFooter;
		$vars = (!is_array($vars)) ? array() : $vars;
		$vars['title'] = @$vars['title'];
		$vars['headerfooter'] = $HeaderFooter;

		if($return)
		{
			//Return with Content HTML Only
			$content = $this->view('template/header', $vars, $return);
			foreach($viewFileList as $pathViewFile)
			{
				$content .= $this->view($pathViewFile, $vars, $return);
			}
			$content .= $this->view('template/footer', $vars, $return);
			return $content;
		}
		else
		{
			$this->view('template/header', $vars, $return);
			foreach($viewFileList as $pathViewFile)
			{
				$this->view($pathViewFile, $vars, $return);
			}
			$this->view('template/footer', $vars, $return);
		}
	}
}
?>