<div id="resultModule" style="height: 1000px">

<?php if (!$polls){ ?>
    <div class="title">Niedługo pierwsze wyniki ankiet</div>
<?php }else{ ?>
    <div class="title">Zobacz wyniki ankiet</div>
    <?php foreach($polls as $poll){ ?>
    <div class="pollName"><a href="<?php echo url_for2('default', array('module' => 'result', 'action' => 'single'),true ).'/poll/'.$poll['id'] ?>"><?php echo $poll['name']; ?></a></div>
    <?php } ?>
    
<?php } ?>
</div>