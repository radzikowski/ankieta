<?php
class singleAction extends sfAction
{
	public function preExecute()
	{
		$this->user = $this->getContext()->get('userFromBase');
		$this->getContext()->getConfiguration()->loadHelpers('Url');
                
                if (!$this->request->hasParameter('poll'))
                    $this->redirect (url_for2 ('default', array('module' => 'result', 'action' => 'index'), true));
                
                $this->poll = PollTable::getInstance()->findOneById($this->request->getParameter('poll'));
                if (!$this->poll)
                    $this->redirect (url_for2 ('default', array('module' => 'result', 'action' => 'index'), true));
	}
	public function execute($request)
	{
		$this->result = Doctrine_Query::create()
                        ->select('ua.*, qa.*, q.*, p.*')
                        ->from('Questions q')
                        ->leftJoin('q.QuestionsAnswers qa')
                        ->leftJoin('qa.UsersAnswers ua')
                        ->leftJoin('q.Poll p')
                        ->where('p.id = ?',$this->poll->id)
                        ->orderBy('ua.answer_id')
                        ->execute();
            if (!$this->result)
                $this->redirect (url_for2 ('default', array('module' => 'result', 'action' => 'index'), true));
                    
            if ($this->poll['self_answers'])
                {
                $this->selfAnswer = Doctrine_Query::create()
                        ->select('ua.*, q.*')
                        ->from('Questions q')
                        ->leftJoin('q.UsersAnswers ua')
                        ->leftJoin('q.Poll p')
                        ->where('p.id = ?', $this->poll->id)
                        ->addWhere('ua.answer_id is NULL')
                        ->execute();
                
                $this->bestAnswers = Doctrine_Query::create()
                        ->select('u.*, ba.*, q.*')
                        ->from('Questions q')
                        ->leftjoin('q.BestAnswers ba')
                        ->leftJoin('ba.Users u')
                        ->orderBy('q.id')
                        ->execute();
                }
                
                $this->comments = Doctrine_Query::create()
                        ->select('c.*, u.*')
                        ->from('PollComment c')
                        ->leftJoin('c.Users u')
                        ->where('c.poll_id =?',$this->poll->id)
                        ->addWhere('c.is_visible =?',1)
                        ->orderBy('c.id DESC')
                        ->execute();
                        
                    $this->commentForm = new commentForm();

                    if ($request->hasParameter('comment'))
                    {
                            $this->commentForm->bind($request->getParameter('comment'));

                            if ($this->commentForm->isValid())
                            {
                                $comment = new PollComment();
                                $comment->fromArray(array(
                                    'user_id' => $this->user['id'],
                                    'poll_id' => $this->poll['id'],
                                    'comment' => $this->commentForm->getValue('comment')
                                ));
                                $comment->save();
                                $this->redirect (url_for2 ('default', array('module' => 'result', 'action' => 'single'), true).'/poll/'.$this->poll->id);
                             }   
                    }

	}
}
