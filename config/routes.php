<?php
MyImouto\Application::routes()->draw(function() {
    # Admin
    $this->match('admin(/index)', 'admin#index', ['via' => ['get', 'post']]);
    $this->match('admin/edit_user', ['via' => ['get', 'post']]);
    $this->match('admin/reset_password', ['via' => ['get', 'post']]);
    $this->post('admin/recalculate_tag_count');
    $this->post('admin/purge_tags');

    # Advertisements
    $this->resources('advertisements', function() {
        $this->collection(function() {
            $this->post('update_multiple');
        });
        $this->member(function() {
            $this->get('redirect');
        });
    });

    # Artist
    $this->match('artist(/index)(.:format)', 'artist#index', ['via' => ['get', 'post']]);
    $this->match('artist/create(.:format)', ['via' => ['get', 'post']]);
    $this->match('artist/destroy(.:format)(/:id)', 'artist#destroy', ['via' => ['get', 'post']]);
    $this->match('artist/preview', ['via' => ['get', 'post']]);
    $this->match('artist/show(/:id)', 'artist#show', ['via' => ['get', 'post']]);
    $this->match('artist/update(.:format)(/:id)', 'artist#update', ['via' => ['get', 'post']]);

    # Banned
    $this->match('banned(/index)', 'banned#index', ['via' => ['get', 'post']]);

    # Batch
    $this->match('batch(/index)', 'batch#index', ['via' => ['get', 'post']]);
    $this->match('batch/create', ['via' => ['get', 'post']]);
    $this->post('batch/enqueue');
    $this->post('batch/update');

    # Blocks
    $this->post('blocks/block_ip');
    $this->post('blocks/unblock_ip');

    # Comment
    $this->match('comment(/index)', 'comment#index', ['via' => ['get', 'post']]);
    $this->match('comment/edit(/:id)', 'comment#edit', ['via' => ['get', 'post']]);
    $this->match('comment/moderate', ['via' => ['get', 'post']]);
    $this->match('comment/search', ['via' => ['get', 'post']]);
    $this->match('comment/show(.:format)(/:id)', 'comment#show', ['via' => ['get', 'post']]);
    $this->match('comment/destroy(.:format)(/:id)', 'comment#destroy', ['via' => ['post', 'delete']]);
    $this->match('comment/update(/:id)', 'comment#update', ['via' => ['post', 'put']]);
    $this->post('comment/create(.:format)');
    $this->post('comment/mark_as_spam(/:id)', 'comment#mark_as_spam');

    # Dmail
    $this->match('dmail(/inbox)', 'dmail#inbox', ['via' => ['get', 'post']]);
    $this->match('dmail/compose', ['via' => ['get', 'post']]);
    $this->match('dmail/preview', ['via' => ['get', 'post']]);
    $this->match('dmail/show(/:id)', 'dmail#show', ['via' => ['get', 'post']]);
    $this->match('dmail/show_previous_messages', ['via' => ['get', 'post']]);
    $this->post('dmail/create');
    $this->get('dmail/mark_all_read', 'dmail#confirm_mark_all_read');
    $this->post('dmail/mark_all_read');

    # Favorite
    $this->match('favorite/list_users(.:format)', ['via' => ['get', 'post']]);

    # Forum
    $this->match('forum(/index)(.:format)', 'forum#index', ['via' => ['get', 'post']]);
    $this->match('forum/preview', ['via' => ['get', 'post']]);
    $this->match('forum/new', 'forum#blank', ['via' => ['get', 'post']]);
    $this->match('forum/add', ['via' => ['get', 'post']]);
    $this->match('forum/edit(/:id)', 'forum#edit', ['via' => ['get', 'post']]);
    $this->match('forum/show(/:id)', 'forum#show', ['via' => ['get', 'post']]);
    $this->match('forum/search', ['via' => ['get', 'post']]);
    $this->match('forum/mark_all_read', ['via' => ['get', 'post']]);
    $this->match('forum/lock', ['via' => ['post', 'put']]);
    $this->match('forum/stick(/:id)', 'forum#stick', ['via' => ['post', 'put']]);
    $this->match('forum/unlock(/:id)', 'forum#unlock', ['via' => ['post', 'put']]);
    $this->match('forum/unstick(/:id)', 'forum#unstick', ['via' => ['post', 'put']]);
    $this->match('forum/update(/:id)', 'forum#update', ['via' => ['post', 'put']]);
    $this->match('forum/destroy(/:id)', 'forum#destroy', ['via' => ['post', 'delete']]);
    $this->post('forum/create');

    # Help
    $this->match('help(/index)', 'help#index', ['via' => ['get', 'post']]);
    $this->match('help/:action', 'help#:action', ['via' => ['get', 'post']]);

    # History
    $this->match('history(/index)', 'history#index', ['via' => ['get', 'post']]);
    $this->post('history/undo');

    # Inline
    $this->match('inline(/index)', 'inline#index', ['via' => ['get', 'post']]);
    $this->match('inline/add_image(/:id)', 'inline#add_image', ['via' => ['get', 'post']]);
    $this->match('inline/create', ['via' => ['get', 'post']]);
    $this->match('inline/crop(/:id)', 'inline#crop', ['via' => ['get', 'post']]);
    $this->match('inline/edit(/:id)', 'inline#edit', ['via' => ['get', 'post']]);
    $this->match('inline/copy(/:id)', 'inline#copy', ['via' => ['post', 'put']]);
    $this->match('inline/update(/:id)', 'inline#update', ['via' => ['post', 'put']]);
    $this->match('inline/delete(/:id)', 'inline#delete', ['via' => ['post', 'delete']]);
    $this->match('inline/delete_image(/:id)', 'inline#delete_image', ['via' => ['post', 'delete']]);

    # JobTask
    $this->match('job_task(/index)', 'job_task#index', ['via' => ['get', 'post']]);
    $this->match('job_task/destroy(/:id)', 'job_task#destroy', ['via' => ['get', 'post']]);
    $this->match('job_task/restart(/:id)', 'job_task#restart', ['via' => ['get', 'post']]);
    $this->match('job_task/show(/:id)', 'job_task#show', ['via' => ['get', 'post']]);

    # Note
    $this->match('note(/index)(.:format)', 'note#index', ['via' => ['get', 'post']]);
    $this->match('note/history(.:format)(/:id)', 'note#history', ['via' => ['get', 'post']]);
    $this->match('note/search(.:format)', ['via' => ['get', 'post']]);
    $this->match('note/revert(.:format)(/:id)', 'note#revert', ['via' => ['post', 'put']]);
    $this->match('note/update(.:format)(/:id)', 'note#update', ['via' => ['post', 'put']]);

    # Pool
    $this->match('pool(/index)(.:format)', 'pool#index', ['via' => ['get', 'post']]);
    $this->match('pool/add_post(.:format)', 'pool#add_post', ['via' => ['get', 'post']]);
    $this->match('pool/copy(/:id)', 'pool#copy', ['via' => ['get', 'post']]);
    $this->match('pool/create(.:format)', 'pool#create', ['via' => ['get', 'post']]);
    $this->match('pool/destroy(.:format)(/:id)', 'pool#destroy', ['via' => ['get', 'post']]);
    $this->match('pool/import(/:id)', 'pool#import', ['via' => ['get', 'post']]);
    $this->match('pool/order(/:id)', 'pool#order', ['via' => ['get', 'post']]);
    $this->match('pool/remove_post(.:format)', 'pool#remove_post', ['via' => ['get', 'post']]);
    $this->match('pool/select', ['via' => ['get', 'post']]);
    $this->match('pool/show(.:format)(/:id)', 'pool#show', ['via' => ['get', 'post']]);
    $this->match('pool/transfer_metadata', ['via' => ['get', 'post']]);
    $this->match('pool/update(.:format)(/:id)', 'pool#update', ['via' => ['get', 'post']]);
    $this->match('pool/zip/:id/:filename', 'pool#zip', ['constraints' => ['filename' => '/.*/'], 'via' => ['get', 'post']]);

    # Post
    $this->match('post(/index)(.:format)', 'post#index', ['via' => ['get', 'post']]);
    $this->match('post/acknowledge_new_deleted_posts', ['via' => ['get', 'post']]);
    $this->match('post/activate', ['via' => ['get', 'post']]);
    $this->match('post/atom(.:format)', 'post#atom', ['format' => 'atom', 'via' => ['get', 'post']]);
    $this->match('post/browse', ['via' => ['get', 'post']]);
    $this->match('post/delete(/:id)', 'post#delete', ['via' => ['get', 'post']]);
    $this->match('post/deleted_index', ['via' => ['get', 'post']]);
    $this->match('post/download', ['via' => ['get', 'post']]);
    $this->match('post/error', ['via' => ['get', 'post']]);
    $this->match('post/exception', ['via' => ['get', 'post']]);
    // $this->match('post/histogram');
    $this->match('post/moderate', ['via' => ['get', 'post']]);
    $this->match('post/piclens', ['format' => 'rss', 'via' => ['get', 'post']]);
    $this->match('post/popular_by_day', ['via' => ['get', 'post']]);
    $this->match('post/popular_by_month', ['via' => ['get', 'post']]);
    $this->match('post/popular_by_week', ['via' => ['get', 'post']]);
    $this->match('post/popular_recent', ['via' => ['get', 'post']]);
    $this->match('post/random(/:id)', 'post#random', ['via' => ['get', 'post']]);
    $this->match('post/show(/:id)(/*tag_title)', 'post#show', ['constraints' => ['id' => '/^\d+$/'], 'format' => false, 'via' => ['get', 'post']]);
    $this->match('post/similar(/:id)', 'post#similar', ['via' => ['get', 'post']]);
    $this->match('post/undelete(/:id)', 'post#undelete', ['via' => ['get', 'post']]);
    $this->match('post/update_batch', ['via' => ['get', 'post']]);
    $this->match('post/upload', ['via' => ['get', 'post']]);
    $this->match('post/upload_problem', ['via' => ['get', 'post']]);
    $this->match('post/view(/:id)', 'post#view', ['via' => ['get', 'post']]);
    $this->match('post/flag(/:id)', 'post#flag', ['via' => ['post', 'put']]);
    $this->match('post/revert_tags(.:format)(/:id)', 'post#revert_tags', ['via' => ['post', 'put']]);
    $this->match('post/update(.:format)(/:id)', 'post#update', ['via' => ['post', 'put']]);
    $this->match('post/vote(.:format)(/:id)', 'post#vote', ['via' => ['post', 'put']]);
    $this->match('post/destroy(.:format)(/:id)', 'post#destroy', ['via' => ['post', 'delete']]);
    $this->post('post/create(.:format)', 'post#create', ['via' => ['get', 'post']]);
    $this->match('post/import', ['via' => ['get', 'post']]);
    $this->match('post/search_external_data', ['via' => ['get', 'post']]);

    $this->match('atom', 'post#atom', ['format' => 'atom', 'via' => ['get', 'post']]);
    $this->match('download', 'post#download', ['via' => ['get', 'post']]);
    $this->match('histogram', 'post#histogram', ['via' => ['get', 'post']]);

    # PostTagHistory
    $this->match('post_tag_history(/index)', 'post_tag_history#index', ['via' => ['get', 'post']]);

    # Report
    $this->match('report/tag_updates', ['via' => ['get', 'post']]);
    $this->match('report/note_updates', ['via' => ['get', 'post']]);
    $this->match('report/wiki_updates', ['via' => ['get', 'post']]);
    $this->match('report/post_uploads', ['via' => ['get', 'post']]);
    $this->match('report/votes', ['via' => ['get', 'post']]);
    $this->match('report/set_dates', ['via' => ['get', 'post']]);
    
    # Settings
    $this->namespaced('settings', function() {
        $this->resource('api', ['only' => ['show', 'update']]);
    });

    # Static
    $this->match('static/500', ['via' => ['get', 'post']]);
    $this->match('static/more', ['via' => ['get', 'post']]);
    $this->match('static/terms_of_service', ['via' => ['get', 'post']]);
    // $this->match('/opensearch', 'static#opensearch', ['via' => ['get', 'post']]);

    # TagAlias
    $this->match('tag_alias(/index)', 'tag_alias#index', ['via' => ['get', 'post']]);
    $this->match('tag_alias/update', ['via' => ['post', 'put']]);
    $this->post('tag_alias/create');

    # Tag
    $this->match('tag(/index)(.:format)', 'tag#index', ['via' => ['get', 'post']]);
    $this->get('tag/autocomplete_name', ['as' => 'ac_tag_name']);
    $this->match('tag/cloud', ['via' => ['get', 'post']]);
    $this->match('tag/edit(/:id)', 'tag#edit', ['via' => ['get', 'post']]);
    $this->match('tag/edit_preview', ['via' => ['get', 'post']]);
    $this->match('tag/mass_edit', ['via' => ['get', 'post']]);
    $this->match('tag/popular_by_day', ['via' => ['get', 'post']]);
    $this->match('tag/popular_by_month', ['via' => ['get', 'post']]);
    $this->match('tag/popular_by_week', ['via' => ['get', 'post']]);
    $this->match('tag/related(.:format)', 'tag#related', ['via' => ['get', 'post']]);
    $this->match('tag/show(/:id)', 'tag#show', ['via' => ['get', 'post']]);
    $this->match('tag/summary', ['via' => ['get', 'post']]);
    $this->match('tag/update(.:format)', 'tag#update', ['via' => ['get', 'post']]);
    $this->match('tag/fix_count', ['via' => ['get', 'post']]);
    $this->match('tag/delete', ['via' => ['get', 'post']]);

    # TagImplication
    $this->match('tag_implication(/index)', 'tag_implication#index', ['via' => ['get', 'post']]);
    $this->match('tag_implication/update', ['via' => ['post', 'put']]);
    $this->post('tag_implication/create');

    # TagSubscription
    $this->match('tag_subscription(/index)', 'tag_subscription#index', ['via' => ['get', 'post']]);
    $this->match('tag_subscription/create', ['via' => ['get', 'post']]);
    $this->match('tag_subscription/update', ['via' => ['get', 'post']]);
    $this->match('tag_subscription/destroy(/:id)', 'tag_subscription#destroy', ['via' => ['get', 'post']]);

    # User
    $this->get('user/autocomplete_name', ['as' => 'ac_user_name']);
    $this->match('user(/index)(.:format)', 'user#index', ['via' => ['get', 'post']]);
    $this->match('user/activate_user', ['via' => ['get', 'post']]);
    $this->match('user/block(/:id)', 'user#block', ['via' => ['get', 'post']]);
    $this->match('user/change_email', ['via' => ['get', 'post'], 'as' => 'user_change_email']);
    $this->match('user/change_password', ['via' => ['get', 'post'], 'as' => 'user_change_password']);
    $this->match('user/check', ['via' => ['get', 'post']]);
    $this->match('user/edit', ['via' => ['get', 'post']]);
    $this->match('user/error', ['via' => ['get', 'post']]);
    $this->match('user/home', ['via' => ['get', 'post']]);
    $this->match('user/invites', ['via' => ['get', 'post']]);
    $this->match('user/login', ['via' => ['get', 'post']]);
    $this->match('user/logout', ['via' => ['get', 'post']]);
    $this->match('user/remove_from_blacklist', ['via' => ['get', 'post']]);
    $this->match('user/resend_confirmation', ['via' => ['get', 'post']]);
    $this->match('user/reset_password', ['via' => ['get', 'post']]);
    $this->match('user/set_avatar(/:id)', 'user#set_avatar', ['via' => ['get', 'post']]);
    $this->match('user/show(/:id)', 'user#show', ['via' => ['get', 'post']]);
    $this->match('user/show_blocked_users', ['via' => ['get', 'post']]);
    $this->match('user/signup', ['via' => ['get', 'post']]);
    $this->match('user/unblock', ['via' => ['get', 'post']]);
    $this->match('user/authenticate', ['via' => ['post', 'put']]);
    $this->match('user/modify_blacklist', ['via' => ['post', 'put']]);
    $this->match('user/update', ['via' => ['post', 'put']]);
    $this->post('user/create');
    $this->post('user/remove_avatar/:id', 'user#remove_avatar');

    # UserRecord
    $this->match('user_record(/index)', 'user_record#index', ['via' => ['get', 'post']]);
    $this->match('user_record/create(/:id)', 'user_record#create', ['via' => ['get', 'post']]);
    $this->match('user_record/destroy(/:id)', 'user_record#destroy', ['via' => ['post', 'delete']]);

    # Wiki
    $this->match('wiki(/index)(.:format)', 'wiki#index', ['via' => ['get', 'post']]);
    $this->match('wiki/add', ['via' => ['get', 'post']]);
    $this->match('wiki/diff', ['via' => ['get', 'post']]);
    $this->match('wiki/edit', ['via' => ['get', 'post']]);
    $this->match('wiki/history(.:format)(/:id)', 'wiki#history', ['via' => ['get', 'post']]);
    $this->match('wiki/preview', ['via' => ['get', 'post']]);
    $this->match('wiki/recent_changes', ['via' => ['get', 'post']]);
    $this->match('wiki/rename', ['via' => ['get', 'post']]);
    $this->match('wiki/show(.:format)', 'wiki#show', ['via' => ['get', 'post']]);
    $this->match('wiki/lock(.:format)', 'wiki#lock', ['via' => ['post', 'put']]);
    $this->match('wiki/revert(.:format)', 'wiki#revert', ['via' => ['post', 'put']]);
    $this->match('wiki/unlock(.:format)', 'wiki#unlock', ['via' => ['post', 'put']]);
    $this->match('wiki/update(.:format)', 'wiki#update', ['via' => ['post', 'put']]);
    $this->match('wiki/destroy(.:format)', 'wiki#destroy', ['via' => ['post', 'delete']]);
    $this->post('wiki/create(.:format)', 'wiki#create');

    $this->root('static#index');
});
