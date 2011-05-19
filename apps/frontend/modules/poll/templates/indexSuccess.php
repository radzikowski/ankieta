<div id="quizModule">
    <div class="header"><img src="/uploads/<?php ?>" /></div>
    <div class="background" style="background-image: url('/uploads/<?php ?>');">
	<div class="clear" style="height: 1px"></div>
	<?php echo $quizzCollectionForm->renderFormTag(null, array('id' => 'quizForm'));?>
	<?php echo $quizzCollectionForm['_csrf_token']->render();?>
	<?php $i = 0; ?>
            <ul>
                <?php if ($poll['demographic']){ ?>
                <?php echo $demographicForm->renderFormTag(null, array('id' => 'demographicForm'));?>
                <?php echo $demographicForm['_csrf_token']->render();?>
                <li class="<?php echo $i ?> <?php if($i === 0) echo 'active'; ?>"  iterate="<?php echo $i; ?>" style="<?php if($i !== 0) echo 'display:none'; ?>">
                    <div class="question"> Wypełnij część demograficzną ankiety</div>
                    <div class="">Wiek: <?php echo $demographicForm['age']->render() ?></div>
                    <div class="">Płeć: <?php echo $demographicForm['sex']->render() ?></div>
                    <?php if ($demographicForm->hasErrors()){ ?>
                    <div class="errors"><?php ?> </div>
                    <?php } ?>
                    </form>
                <?php $i++; ?>
                </li>
                <?php } ?>
                <?php foreach($quizzCollectionForm as $quizzForm){ ?>
                    <?php if(get_class($quizzForm) === 'sfFormFieldSchema'){ ?>
                        <li class="<?php echo $i ?> <?php if($i === 0) echo 'active'; ?>"  iterate="<?php echo $i; ?>" style="<?php if($i !== 0) echo 'display:none'; ?>">
                            <div class="question"> <?php echo $quizzForm['question']->getValue()?> </div>
                            <div class="answers">
                                <?php echo $quizzForm['answers']->render();?>
                            </div>					
                            <div class="clear"></div>
                        </li>
                    <?php $i++; }?>
                <?php }?>
            </ul>
            <input type="hidden" name="signed_request" value="<?php echo sfContext::getInstance()->getUser()->getAttribute('signed_request', null, 'signed_request') ?>" />
	</form>
	<div class="prevQuestion right"></div>
	<div class="nextQuestion right"></div>
    </div>
    <div class="footer"><img src="/uploads/<?php ?>" /></div>
</div>
<script type="text/javascript">

var app = {};

app.functions = {};

<?php if ($poll['self_answers']){ ?>
    $("label[for*='null']").each(function(i,e){
        $(this).replaceWith('<input class="'+i+'" onBlur="check($(\'input.'+i+'\'))" type=text name="self'+$(this).parent().parent().parent().parent().attr('iterate')+'" value=""/>');                
    });        

    check = function(element){
        element.parent().children().attr('checked',"checked");
    };
<?php }?>


<?php if ($poll['type'] == 'points'){ ?>
    $('.checkbox_list li').prepend(
    '<select><option value="0">0</option>'+
        '<option value="1">1</option>'+
        '<option value="2">2</option>'+
        '<option value="3">3</option>'+
        '<option value="4">4</option>'+
        '<option value="5">5</option>'+
        '<option value="6">6</option>'+
        '<option value="7">7</option>'+
        '<option value="8">8</option>'+
        '<option value="9">9</option>'+
        '<option value="10">10</option>'+
    '</select>');

    $('.checkbox_list li input[name*="quizzCollection"]').hide();

    $("input[name*='quizzCollection']").each(function() {
	this.checked = true;
    });

    $(':input[value*="null"]').each(function(){
        $(this).attr('checked',"");
    });
    
    $("select").change(function () {
                $(this).parent() .children('input[name*="quizzCollection"]').val($(this).parent() .children('input[name*="quizzCollection"]').val()+'___'+$(this).val() );
                $(this).next().attr('checked',"checked");  
    });
<?php } ?>    


app.functions.showHidePrevButton = function()
{
	var i = $('ul li.active').attr('iterate');
	if(i == 0)
		$('.prevQuestion').hide();
	else if(i > 0)
		$('.prevQuestion').show();
};
app.functions.showHidePrevButton();

$('.prevQuestion').live('click', function(){
	var i = $('ul li.active').attr('iterate');
	var next = parseInt(i)-1;
	$("ul li.active").hide().removeClass('active');
	$("ul li."+next+"").show().addClass('active');
	app.functions.showHidePrevButton();
});

$('.nextQuestion').live('click', function(){
	if($('ul li.active ul li input:checked').length > 0){
                if ((<?php echo $poll['demographic'] ?>) && ($('ul li.active').hasClass(1)))
                {    
                    $('form#demographicForm').submit();
                }
		if($('ul li.active').hasClass('<?php echo ($poll['demographic']) ? count($questions) : count($questions)-1; ?>'))
		{
                    $('form#quizForm').submit();
		}
		if((parseInt($('ul li.active').attr('iterate'))+1) < 4)
		{
                    var i = $('ul li.active').attr('iterate');
                    var next = parseInt(i)+1;
                    $("ul li.active").hide().removeClass('active');
                    $("ul li."+next+"").show().addClass('active');
                    app.functions.showHidePrevButton();
		}
	}
	else
	{
		alert('Wybierz odpowiedź');
	}
});
jQuery.preLoadImages(
		'/images/aa.png' 
		
);
</script>