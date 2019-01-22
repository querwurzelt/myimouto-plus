<div style="margin-bottom: 1em;">
  <h5><?= $this->t('.title') ?></h5>
  <?= $this->formTag('post#index', array('method' => 'get', 'accept-charset' => 'UTF-8'), function(){ ?>
    <div style="margin:0;padding:0;display:inline"></div>
    <div>
      <?= $this->textFieldTag("tags", $this->h($this->params()->tags), array('size' => '20', 'autocomplete' => 'off')) ?>
      <?= $this->submitTag($this->t('.search'), array('style' => 'display: none;', 'name' => '')) ?>
    </div>
  <?php }) ?>
</div>
<?= $this->tag_completion_box('$("tags")', ['$("tags").up("form")', '$("tags")', null], true) ?> 
