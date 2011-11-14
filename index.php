<?php
$template = new PHPTAL(TEMPLATEPATH . '/tmp.html');
function phptal_tales_postclass($src, $nothrow=false) {
    return 'get_post_class("",'.phptal_tales($src,$nothrow).')';
}
function phptal_tales_postid($src, $nothrow=false) {
    return 'sprintf("post-%d",'.phptal_tales($src,$nothrow).')';
}
function phptal_tales_permalink($src, $nothrow=false) {
    return 'get_permalink('.phptal_tales($src,$nothrow).')';
}
class Item {
    public $id;
    public $title;
    public $content;
    public $permalink;
    public $date;
function Item($id,$title,$content,$permalink,$date) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->permalink = $permalink;
        $this->date = $date;
    }
}
// let's create an array of objects for test purpose
//$template->title = get_bloginfo("name");
$myposts = array();
while( have_posts() ) : the_post();
$myposts[] = new Item(get_the_ID(),get_the_title(),apply_filters('the_content', get_the_content()),get_permalink(),get_the_date());
endwhile;
// put some data into the template context
$template->item = $myposts;
// execute the template
try {
    echo $template->execute();
}
catch (Exception $e){
    echo $e;
}
