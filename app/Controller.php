<?php
namespace App;

use Zems\BaseController;

class Controller extends BaseController
{
    
    protected function view($view, $data = [])
    {
        extract($data);
        $template = 'Web/View/WebTheme';
		if(isset($theme)){
			$template = $theme;
		}
		if(isset($api) && $this->isApi()){
			unset($data['api']);
			if(isset($theme)){
				unset($data['theme']);
			}
			echo json_encode($data);
			return;
		} 
		$template_part = $this->template_part($template);		
		$content_part = $this->content_part($view, $data);			
		print str_replace("{{content}}", $content_part, $template_part); 
    }
    
    protected function template_part($template=False)
	{
		ob_start();
		require_once dirname(__FILE__)."/".$template.".php";		
		return ob_get_clean();
	}
    protected function content_part($file=False, $data=[])
	{
		ob_start();
        extract($data);
		require_once dirname(__FILE__)."/".$file.".php";
		return ob_get_clean();
	}
	

}
