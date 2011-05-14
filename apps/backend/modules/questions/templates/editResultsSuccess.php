<?php if(count($resultsCollectionForm) > 1){ ?>
<?php echo $resultsCollectionForm->renderFormTag(url_for2('default', array('module' => 'questions', 'action' => 'editResults'), true), array('id' => 'resultsForm'));?>
<?php echo $resultsCollectionForm['_csrf_token']->render();?>
<?php $layers = array('Słabo', 'Dobrze', 'Super'); ?>
<?php $i = 0; ?>
<span class="results"><h3>Wyniki quizu:</h3> Wyniki przedstawiaja się w kolejności Najsłabszy - Najlepszy</span>
	<ul>
		<?php foreach($resultsCollectionForm as $resultForm){ ?>
			<?php if(get_class($resultForm) === 'sfFormFieldSchema'){ ?>
				<li>
							<?php echo $resultForm['id']->render()?>
					<label><?php echo $layers[$i] ?></label>
							<?php echo $resultForm['result']->render()?>
							<?php if($resultForm['result']->hasError()){ ?>
								<span class="error"><?php echo $resultForm['result']->getError() ?></span>
							<?php }?>
				</li>
			<?php $i++; }?>
		<?php }?>
<?php }?>
	</ul>
<input type="submit" value="Zapisz">
</form>