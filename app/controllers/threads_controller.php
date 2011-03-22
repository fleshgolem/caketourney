<?php
class ThreadsController extends AppController {

	var $name = 'Threads';
	var $helpers = array('Text','Bbcode');
	var $paginate = array(
		'limit' => 25,
        'order' => array(
			'Thread.date_modified' => 'desc',  
			//'Post.date_posted' => 'asc'
		)
	);
	function index() {
		$this->Thread->recursive = 1;
		$this->set('threads', $this->paginate());
	}

	function view($id = null) 
	{
		$this->Thread->recursive = 1;
		if(!empty($this->data))
		{
			$current_user = $current_user = $this->Auth->user('id');
			$date = date_create('now');
			$this->data['Post']['user_id']=$current_user;
			$this->data['Post']['date_posted']= $date->format('Y-m-d H:i:s');
			$this->data['Post']['thread_id'] = $id;
			if ($this->Thread->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
			}
		}
		if(empty($this->data))
		{
			$this->data = $this->Thread->read(null, $id);
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid thread', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('thread', $this->Thread->read(null, $id));
		$this->paginate = array(
			'conditions' => array('Post.thread_id' => $id),
			'order'=>array('date_posted asc') ,
			'recursive' => 2,
			'limit' => 20);
		$posts = $this->paginate('Post');
		$this->set('posts', $posts);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Thread->create();
			$this->Thread->Post->create();
			$date = date_create('now');
			$current_user = $current_user = $this->Auth->user('id');
			$this->data['Thread']['original_poster_id']=$current_user;
			$this->data['Thread']['last_poster_id']=$current_user;
			$this->data['Thread']['date_modified']= $date->format('Y-m-d H:i:s');
			
			if ($this->Thread->save($this->data)) {
				$id = $this->Thread->id;
				$this->data['Post']['user_id']=$current_user;
				$this->data['Post']['date_posted']= $date->format('Y-m-d H:i:s');
				$this->data['Post']['thread_id'] = $id;
				$this->Thread->Post->save($this->data);
				$this->Session->setFlash(__('The thread has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thread could not be saved. Please, try again.', true));
			}
		}

		$this->set(compact('users'));
	}


	function delete($id = null) {
		if (!$this->Session->read('Auth.User.admin'))
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Thread->delete($id)) {
			$this->Session->setFlash(__('Thread deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Thread was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>