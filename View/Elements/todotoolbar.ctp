<?=$this->Html->css(array('/to_do_per_page/css/todo'));?>
<?php 

    $page = array();

    if(isset($this->params->params['prefix'])){
            $page[] = $this->params->params['prefix'];
    }
    if(isset($this->params->params['plugin'])){
            $page[] = $this->params->params['plugin'];
    }
    if(isset($this->params->params['controller'])){
            $page[] = $this->params->params['controller'];
    }
    if(isset($this->params->params['action'])){
		$page[] = $this->params->params['action'];
	}
?>
<div class='todo-toolbar bootstrap-comportado' style="">
    <div class='todo-header'>
        <span id="title">TODO</span>
        <a class='btn btn-small' disabled="disabled" style="display: none">Saved</a>
    </div>	
    <div class='todo-body'>
        <textarea id="editor"></textarea>
    </div>
    <div class='todo-footer'>
        <small><?=join('.', $page)?></small>
    </div>
</div>
<script>
APP = '<?=$this->Html->url('/')?>'; 
var page = '<?=join('.', $page)?>';

$(document).click(function (e)
{
    var container = $(".todo-toolbar");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
       if($('.todo-body').is(":visible")){
          $('.todo-body, .todo-footer, .todo-header a').toggle(); 
       } 
       
    }
});

$(function(){
    
    $('.todo-header span#title').click(function(){
        $('.todo-body, .todo-footer, .todo-header a').toggle();
    });
    
    $.get(APP + 'to_do_per_page/to_do_per_page/getFile/'+ page, '', function(view){
        $('.todo-body #editor').html(view);
    });

    $('.todo-body #editor').click(function(){
        $('.todo-header a').html('Save').removeAttr('disabled').addClass('btn-primary');
    });

    $('.todo-header a').click(function(){
        $('.todo-toolbar, .todo-body #editor').css('cursor', 'wait');
        $('.todo-header a, .todo-body #editor').css('pointerEvents', 'none');
        $.post(APP + 'to_do_per_page/to_do_per_page/saveFile/'+ page, 
        {'page':page,
        'content':$('.todo-body #editor').html()}, 
        function(msg){
                $('.todo-header a, .todo-body #editor').css('pointerEvents', 'initial');
                $('.todo-toolbar, .todo-body #editor').css('cursor', 'initial');
                $('.todo-header a').html('Saved').attr('disabled', 'disabled').removeClass('btn-primary');
        });
        return false;
    });
});


</script>