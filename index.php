<?php
$template = new PHPTAL(TEMPLATEPATH . '/tmp.html');
class Item {
    public $id;
    public $title;
    public $content;
    public $permalink;
    public $date;
function Item($id,$title,$content,$permalink,$date) {
        $this->id = 'post-'.$id;
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
$myposts[] = new Item(get_the_ID(),get_the_title(),get_the_content(),get_permalink(),get_the_date());
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
