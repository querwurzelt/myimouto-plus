<?php
class TagHelper extends Rails\ActionView\Helper
{
    public function tag_link($name, array $options = array())
    {
        !$name && $name = 'UNKNOWN';
        $prefix = isset($options['prefix']) ? $options['prefix'] : '';
        $obsolete = isset($options['obsolete']) ? $options['obsolete'] : array();

        $tag_type = Tag::type_name($name);
        $obsolete_tag = (array($name) != $obsolete) ? '' : ' obsolete';
        $html = !$prefix ? '' : $this->contentTag('span', $prefix, array('class' => $obsolete_tag));
        $html .= $this->contentTag(
                                    'span',
                                    $this->linkTo($name, array('post#index', 'tags' => $name)),
                                    array('class' => "tag-type-".$tag_type.$obsolete_tag)
                                  );
        return $html;
    }
    
    public function tag_links($tags, array $options = array())
    {
        if (!$tags)
            return '';
        
        $prefix = isset($options['prefix']) ? $options['prefix'] : "";

        $html = "";
        
        if (is_string(current($tags))) {
            if (key($tags) !== 0)
                $tags = array_keys($tags);
            
            $tags = Tag::where("name in (?)", $tags)->select("tag_type, name, post_count, id")->order('name')->take();
            $tags = $tags->reduce(array(), function($all, $x) {$all[] = [ $x->type_name, $x->name, $x->post_count, $x->id ]; return $all;});
        } elseif (is_array(current($tags))) {
            # $x is expected to have name as first value and post_count as second.
            $tags = array_map(function($x){return array(array_shift($x), array_shift($x));}, $tags);
            $tags_type = Tag::batch_get_tag_types(array_map(function($data){return $data[0];}, $tags));
            
            $i = 0;
            foreach ($tags_type as $k => $type) {
                array_unshift($tags[$i], $type);
                $i++;
            }
        } elseif (current($tags) instanceof Tag) {
            $tags = array_map(function($x){return array($x->type_name, $x->name, $x->post_count, $x->id);}, $tags->members());
        }
        // switch ($this->controller()->action_name()) {
            // case 'show':
                usort($tags, function($a, $b){
                    $aidx = array_search($a[0], CONFIG()->tag_order);
                    false === $aidx && $aidx = 9;
                    $bidx = array_search($b[0], CONFIG()->tag_order);
                    false === $bidx && $bidx = 9;
                    if ($aidx == $bidx)
                        return strcmp($a[1], $b[1]);
                    return ($aidx > $bidx) ? 1 : -1;
                });
                // vde($tags);
                // break;
            // case 'index':
                // usort($tags, function($a, $b){
                    // $aidx = array_search($a[0], CONFIG()->tag_order);
                    // false === $aidx && $aidx = 9;
                    // $bidx = array_search($b[0], CONFIG()->tag_order);
                    // false === $bidx && $bidx = 9;
                    // if ($aidx == $bidx)
                        // return 0;
                    // return ($aidx > $bidx) ? 1 : -1;
                // });
                // break;
        // }
        
    // case controller.action_name
    // when 'show'
      // tags.sort_by! { |a| [Tag::TYPE_ORDER[a[0]], a[1]] }
    // when 'index'
      // tags.sort_by! { |a| [Tag::TYPE_ORDER[a[0]], -a[2].to_i, a[1]] }
    // end
    
        foreach ($tags as $t) {
            $tag_type = array_shift($t);
            $name     = array_shift($t);
            $count    = array_shift($t);
            $id       = array_shift($t);
            !$name && $name = 'UNKNOWN';
            
            // $tag_type = Tag::type_name($name);
            
            // $html .= '<li class="tag-type-' . $tag_type . '">';
            $html .= '<li class="tag-link tag-type-' . $tag_type . '" data-name="' . $name . '" data-type="' . $tag_type . '">';
            
            if (CONFIG()->enable_artists && $tag_type == 'artist')
                $html .= '<a href="/artist/show?name=' . $this->u($name) . '">?</a> ';
            else
                $html .= '<a href="/wiki/show?title=' . $this->u($name) . '">?</a> ';
            
            if (current_user()->is_privileged_or_higher()) {
                $html .= '<a href="/post?tags=' . $this->u($name) . '+' . $this->u($this->params()->tags) . '" class="no-browser-link">+</a> ';
                $html .= '<a href="/post?tags=-' . $this->u($name) . '+' .$this->u($this->params()->tags) . '" class="no-browser-link">&ndash;</a> ';
            }
            
            if (!empty($options['with_hover_highlight'])) {
                $mouseover = ' onmouseover="Post.highlight_posts_with_tag(\'' . $this->escapeJavascript($name) . '\')"';
                $mouseout  = ' onmouseout="Post.highlight_posts_with_tag(null)"';
            } else
                $mouseover = $mouseout = '';
            
            $html .= '<a href="/post?tags=' . $this->u($name) . '"' . $mouseover . $mouseout . '>' . (str_replace("_", " ", $name)) . '</a> ';
            $html .= '<span class="post-count">' . $count . '</span> ';
            $html .= '</li>';
        }
        
        return $html;
    }
    
    public function cloud_view($tags, $divisor = 6)
    {
        $html = "";
        
        foreach ($tags as $tag) {
            if ($tag instanceof Rails\ActiveRecord\Base)
                $tag = $tag->attributes();
            
            $size = log($tag['post_count']) / $divisor;
            $size < 0.8 && $size = 0.8;
            $html .= '<a href="/post/index?tags='.$this->u($tag['name']).'" style="font-size: '.$size.'em;" title="'.$tag['post_count'].' '.($tag['post_count'] == 1 ? 'post' : 'posts').'">'.$this->h($tag['name']).'</a> ';
        }

        return $html;
    }
}
