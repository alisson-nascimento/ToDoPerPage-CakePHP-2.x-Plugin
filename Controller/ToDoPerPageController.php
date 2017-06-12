<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('Security', 'Utility');
App::uses('ToDoPerPageAppController', 'ToDoPerPage.Controller');

class ToDoPerPageController extends ToDoPerPageAppController {
	var $uses = array();
        
        public $components = array('Security');
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->Security->validatePost = false;
        }
	
	function getFile($f = null){
		$folder = APP . 'Plugin'.DS.'ToDoPerPage'.DS.'webroot'.DS.'files';
		
		$c = '';
		if(file_exists($folder . DS . $f)){
                    $file = new File($folder . DS . $f);	
                    $c = $file->read();	
                    $file->close();	
		}
		
		exit($c);
		
	}
	
	function saveFile($f=null){
		$folder = APP . 'Plugin'.DS.'ToDoPerPage'.DS.'webroot'.DS.'files';
		$file = new File($folder . DS . $f, true, 0644);		
		$file->write($this->request->data['content']);
		$file->close();
		exit(pr($this->request->data));		
	}
}
