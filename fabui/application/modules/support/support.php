<?php 
class Support extends Module {

	public function __construct()
	{
		parent::__construct();
        
        $this->lang->load($_SESSION['language']['name'], $_SESSION['language']['name']);
        
        
	}

	public function index(){
		
		$this->load->helper('file');
		
		$this->config->load('fabtotum', TRUE);
		
		
		$data['support_url'] = $this->config->item('fabtotum_support_url', 'fabtotum');
		$data['manual_url']  = $this->config->item('fabtotum_manual_url', 'fabtotum');
		$data['wiki_url']    = $this->config->item('fabtotum_wiki_url', 'fabtotum');
		$data['blog_url']    = $this->config->item('fabtotum_blog_url', 'fabtotum');
		$data['forum_url']   = $this->config->item('fabtotum_forum_url', 'fabtotum');
		
		
		// if faq file doesn't exists, create it
		if(!file_exists($this->config->item('fabtotum_faq', 'fabtotum'))){
			shell_exec('sudo php '.SCRIPTPATH.'faq.php');
		}
		
		// if now faq file doens't exists it means there's no internet connettivity 
		if(!file_exists($this->config->item('fabtotum_faq', 'fabtotum'))){
			
			$data['no_faq'] = true;
			
		}else{
			$data['faq'] = json_decode(read_file($this->config->item('fabtotum_faq', 'fabtotum')), true);
		}
		
		
		
		$this->layout->view('index/index', $data);
	  
		
	}
    

}

?>