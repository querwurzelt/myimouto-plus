<?php if ($this->post->is_flagged()) : ?>
  <div class="status-notice">
    <?= $this->t(['.flagged.info', 'user' => $this->h($this->post->flag_detail->author()), 'reason' => $this->h($this->post->flag_detail->reason)]) ?>
    <?php if (current_user()->is_mod_or_higher() or ($this->post->flag_detail && $this->post->flag_detail->user_id == current_user()->id)) : ?>
    (<?= $this->linkToFunction($this->t('.flagged.unflag'), 'Post.unflag('.$this->post->id.', function() { window.location.reload(); })') ?>)
    <?php endif ?>
    <?php if (current_user()->is_janitor_or_higher()) : ?>
      (<?= $this->linkToFunction($this->t('.flagged.delete'), 'Post.prompt_to_delete('.$this->post->id.');') ?></li>)
    <?php endif ?>
  </div>
<?php elseif ($this->post->is_pending()) : ?>
  <div class="status-notice" id="pending-notice">
    <?= $this->t('.pending.info') ?>
    <?php if ($this->post->flag_detail) : ?>
      <?= $this->t('.reason') ?><?= $this->h($this->post->flag_detail->reason()) ?>
    <?php endif ?>
    <?php if (current_user()->is_janitor_or_higher()) : ?>
      (<?= $this->linkToFunction($this->t('.pending.approve._'), "if (confirm('".$this->t('.pending.approve.confirm')."')) {Post.approve(".$this->post->id.")}") ?></li>)
      (<?= $this->linkToFunction($this->t('.pending.delete'), "Post.prompt_to_delete(".$this->post->id.");") ?></li>)
    <?php endif ?>
  </div>
<?php elseif ($this->post->is_deleted()) : ?>
  <div class="status-notice">
    <?= $this->t('.deleted_info') ?>
    <?php if ($this->post->flag_detail) : ?>
      <?php if (current_user()->is_mod_or_higher()) : ?>
        <?= $this->t('.by') ?>: <?= $this->linkTo($this->h($this->post->flag_detail->author()), array('user#show', 'id' => $this->post->flag_detail->user_id)) ?>
      <?php endif ?>

      <?= $this->t('.reason') ?>: <?= $this->h($this->post->flag_detail->reason) ?>. MD5: <?= $this->post->md5 ?>
    <?php endif ?>
  </div>
<?php endif ?>

<?php if ($this->post->is_held) : ?>
  <div class="status-notice" id="held-notice">
    <?= $this->t('.held.info') ?>
    <?php if (current_user()->has_permission($this->post)) : ?>
      (<?= $this->linkToFunction($this->t('.held.activate'), 'Post.activate_post('.$this->post->id.');') ?>)
    <?php endif ?>
  </div>
<?php endif ?>

<?php if (!$this->post->is_deleted() && $this->post->use_sample(current_user()) && $this->post->can_be_seen_by(current_user()) && !isset($this->post->tags()['dakimakura'])) : ?>
  <div class="status-notice" style="display: none;" id="resized_notice">
    <?= $this->t(['.resized.info_html', 'larger' => $this->linkTo($this->t('.resized.view_larger'), $this->post->get_file_jpeg()['url'], ['class' => 'highres-show'])]) ?>
    <!--
    <?php if (!current_user()->is_anonymous() || !CONFIG()->force_image_samples) : ?>
      <?= $this->linkToFunction($this->t('.resized.always_view_original'), 'User.disable_samples()') ?>.
    <?php endif ?>
    -->
    <?= $this->linkToFunction($this->t('.resized.hide'), "$('resized_notice').hide(); Cookie.put('hide_resized_notice', '1')") ?>.
    <script type="text/javascript">
      if (Cookie.get("hide_resized_notice") != "1") {
        $("resized_notice").show()
      }
    </script>
  </div>
  <div class="status-notice" style="display: none;" id="samples_disabled">
    <?= $this->t('.samples_disabled') ?>
  </div>
<?php endif ?>

<?php if (CONFIG()->enable_parent_posts) : ?>
  <?php if ($this->post->parent_id) : ?>
    <div class="status-notice">
      <?= $this->t(['.parent.has_parent_html', 'parent' => $this->linkTo($this->t('.parent.parent'), array('#show', 'id' => $this->post->parent_id))]) ?><?php
      ?><span class="advanced-editing"> (<?= $this->linkToFunction($this->t('.parent.make_parent'), 'Post.reparent_post('.$this->post->id.', '.$this->post->parent_id.', '.($this->post->get_parent()->parent_id ? "true":"false").')') ?>)</span>
    </div>
  <?php endif ?>

  <?php if ($this->post->has_children) : ?>
    <?php $children = $this->post->children; $s = $this; ?>
    <div class="status-notice">
      <?= $this->t(['.parent.has_child_html', 'child' => $this->linkTo(($children->size() == 1? $this->t('.parent.child'):$this->t('.parent.children')), array('#index', 'tags' => 'parent:'.$this->post->id))]) ?> (<?= $this->t(['.parent.child_post_html', 'child' =>  implode(', ', array_map(function($child){return $this->linkTo($child->id, array('#show', 'id' => $child->id));}, $children->members()))]) ?>).
    </div>
  <?php endif ?>
<?php endif ?>

<?php foreach ($this->pools as $pool) : ?>
  <?= $this->partial("post/show_partials/pool", array('pool' => $pool, 'pool_post' => PoolPost::where("pool_id = ? AND post_id = ?", $pool->id, $this->post->id)->first())) ?>
<?php endforeach ?>
