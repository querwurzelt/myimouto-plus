<div class="help">
  <h1>Help</h1>
  <ul class="link-page">
    <li><a href="/help/about">About Danbooru</a></li>
    <li><a href="/help/faq">Frequently Asked Questions</a></li>
    <li><a href="/help/start">Getting Started</a></li>
    <li><a href="/help/users">Accounts</a></li>
    <li><a href="/help/api">API</a></li>
    <?php if(CONFIG()->enable_artists): ?>
      <li><a href="/help/artists">Artists</a></li>
    <?php endif ?>
    <li><a href="/help/bookmarklet">Bookmarklet</a></li>
    <li><a href="/help/trac">Bugs</a></li>
    <li><a href="/help/cheatsheet">Cheat Sheet</a></li>
    <li><a href="/help/comments">Comments</a></li>
    <li><a href="/help/dtext">DText</a></li>
    <li><a href="/help/extension">Firefox Extension</a></li>
    <?php if(CONFIG()->image_samples): ?>
      <li><a href="/help/image_sampling">Image Sampling</a></li>
    <?php endif ?>
    <li><a href="/help/irc">IRC</a></li>
    <li><a href="/help/notes">Notes</a></li>
    <li><a href="/help/pools">Pools</a></li>
    <li><a href="/help/posts">Posts</a></li>
    <?php if(CONFIG()->enable_parent_posts): ?>
      <li><a href="/help/post_relationships">Post Relationships</a></li>
    <?php endif ?>
    <li><a href="/help/ratings">Ratings</a></li>
    <li><a href="/help/source_code">Source Code</a></li>
    <li><a href="/help/tag_scripts">Tag Scripts</a></li>
    <li><a href="/help/tags">Tags</a></li>
    <li><a href="/help/tag_aliases">Tag Aliases</a></li>
    <li><a href="/help/tag_implications">Tag Implications</a></li>
    <li><a href="/help/mass_tag_edit">Mass Tag Edit</a></li>
    <li><a href="/help/trac">Suggestions</a></li>
    <li><a href="/help/voting">Voting</a></li>
    <li><a href="/help/wiki">Wiki</a></li>
  </ul>
</div>

<?php $this->contentFor("subnavbar", function() { ?>
  <li><?= $this->linkTo("Help", "#index") ?></li>
<?php }) ?>
