# ToDoPerPage CakePHP 2.x Plugin

* CakePHP 2.x
* Cria um botão de TODO no canto da página
* Cada texto inserido no TODO será exclusivo da página ao qual foi criado
* Os arquivos da lista de TODO fica na pasta webroot/files do plugin

## Instalar

* Fazer o download do Plugin
* Copiar conteúdo para Plugin/ToDoPerPage
* No bootstrap.php => CakePlugin::load('ToDoPerPage');
* Include jquery on page
* No Layout, antes de </body> => 
    <?php echo (Configure::read('debug')>0)?$this->element('ToDoPerPage.todotoolbar'):''?>  

