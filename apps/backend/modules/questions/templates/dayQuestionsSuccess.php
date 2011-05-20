<div style="margin:40px">
<?php if(count($questionsCollectionForm) > 1){ ?>
<?php echo $questionsCollectionForm->renderFormTag(null, array('id' => 'questionForm'));?>
<?php echo $questionsCollectionForm['_csrf_token']->render();?>
<?php $i = 0; ?>
<span class="day"><h3>Dzień: <?php echo $dayNumber; ?></h3></span>
	<ol>
		<?php foreach($questionsCollectionForm as $questionForm){ ?>
			<?php if(get_class($questionForm) === 'sfFormFieldSchema'){ ?>
				<li>
							<?php echo $questionForm['id']->render()?>
							<?php echo $questionForm['question']->render()?>
							<a class="deleteQuestion" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'deleteQuestion'), true).'?id='.$questionForm['id']->getValue() ?>">Usuń pytanie</a>
							<a class="answers" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'answers'), true).'?id='.$questionForm['id']->getValue() ?>">Pokaż pytanie</a>
				</li>
			<?php $i++; }?>
		<?php }?>
	</ol>
<input type="submit" value="Zapisz">
</form>
<?php }else{?>
	<h2 style="margin: 20px;">Ten dzień nie posiada jeszcze przydzielonych pytań!</h2>
<?php } ?>

<?php if(count($questionsCollectionForm) <= 6){ ?>
<a class="addQuestion" href="<?php echo url_for2('default', array('module' => 'questions', 'action' => 'addQuestion'), true).'?nr='.$dayNumber ?>">Dodaj nowe pytanie</a>
<?php }?>

</div>
<script>
$('.deleteQuestion').live('click', function(){
	if (!confirm("Czy na pewno usunąć te pytanie?"))
		return false;
});
</script>