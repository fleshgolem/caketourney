<?php
class PostsController extends AppController {

	var $name = 'Posts';


	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('controller'=>'threads','action' => 'index'));
		}
		$post = $this->Post->read(null,$id);
		$current_user = $this->Session->read('Auth.User.id');
		
		if (!$this->Session->read('Auth.User.admin') AND $post['Post']['user_id']!=$current_user)
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->saveField('body',$this->data['Post']['body'])) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('controller'=>'threads','action' => 'view',$post['Post']['thread_id']));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
			
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		$post = $this->Post->read(null,$id);
		$current_user = $this->Session->read('Auth.User.id');
		if (!$this->Session->read('Auth.User.admin') AND $post['Post']['user_id']!=$current_user)
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('controller'=>'threads','action' => 'view',$post['Post']['thread_id']));
		}
		$this->Session->setFlash(__('Post was not deleted', true));
		$this->redirect(array('controller'=>'threads','action' => 'view',$post['Post']['thread_id']));
	}
}
?>