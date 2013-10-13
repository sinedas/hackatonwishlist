<?php

require_once('objects/Wish.php');

class IndexController extends Controller {

	/**
	 * Main view.
	 */
	function index() {
        $this->defaultView();
        $wishes = DataAccess::getData('SELECT * FROM wish order by id desc');
        $this->view->smarty->assign_by_ref('wishes', $wishes);

	}

    /**
     * Save of post.
     */
    function save() {
        $wish = new Wish();
        $wish->load($_POST);
        $wish->save();

        $this->actionRedirect("?index");
    }

    function like() {
        $wish = new Wish();
        $wish->getByPk($this->getParam('id'));
        $wish->setLikes($wish->getLikes() + 1);
        $wish->save();
        echo $wish->getLikes();
        return;
    }

    function dislike() {
        $wish = new Wish();
        $wish->getByPk($this->getParam('id'));
        $wish->setDisLikes($wish->getDisLikes() + 1);
        $wish->save();
        echo $wish->getDisLikes();
        return;
    }

	
 
}

?>