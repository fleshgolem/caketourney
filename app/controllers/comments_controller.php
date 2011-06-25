<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comment', true));
			$this->redirect(array('controller'=>'matches','action' => 'index'));
		}
		$comment = $this->Comment->read(null,$id);
		$current_user = $this->Session->read('Auth.User.id');
		
		if (!$this->Session->read('Auth.User.admin') AND $comment['Comment']['user_id']!=$current_user)
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('controller'=>'matches','action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->saveField('body',$this->data['Comment']['body'])) {
				if($this->Session->read('Auth.User.admin')){
					$this->Comment->saveField('edit_reason','[edit]Last edit by [b][blue]'.$this->Session->read('Auth.User.username').'[/blue][/b] because of: '.$this->data['Comment']['edit_reason'].'[/edit]');
				}
				else{
					$this->Comment->saveField('edit_reason','[edit]Last edit by [b]'.$this->Session->read('Auth.User.username').'[/b] because of: '.$this->data['Comment']['edit_reason'].'[/edit]');
				}
				$this->Session->setFlash(__('The Comment has been saved', true));
				$this->redirect(array('controller'=>'matches','action' => 'view',$comment['Comment']['match_id']));
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
			
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comment', true));
			$this->redirect(array('action'=>'index'));
		}
		$Comment = $this->Comment->read(null,$id);
		$current_user = $this->Session->read('Auth.User.id');
		if (!$this->Session->read('Auth.User.admin') AND $Comment['Comment']['user_id']!=$current_user)
		{
			$this->Session->setFlash(__('Access denied', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(__('Comment deleted', true));
			$this->redirect(array('controller'=>'matches','action' => 'view',$Comment['Comment']['match_id']));
		}
		$this->Session->setFlash(__('Comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>