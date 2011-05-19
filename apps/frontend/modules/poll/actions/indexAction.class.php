<?php
class indexAction extends sfAction
{
	public function preExecute()
	{
		$this->user = $this->getContext()->get('userFromBase');
		$this->getContext()->getConfiguration()->loadHelpers('Url');
	}
       
        public function execute($request)
	{		
                if (!$this->request->hasParameter('name'))
                    $this->redirect(url_for2('default', array('module' => 'missing', 'action' => 'index'), true));
              
                $this->poll = PollTable::getInstance()->findOneByName($this->request->getParameter('name'));
                
                if (!$this->poll)
                    $this->redirect(url_for2('default', array('module' => $this->request->getParameter('name') , 'action' => 'index'), true));
            
		$this->questions = Doctrine_Query::create()
			->select('q.*, qa.*')
			->from('Questions q')
			->leftJoin('q.QuestionsAnswers qa')
                        ->where('q.poll_id =? ',$this->poll['id'])
			//->useResultCache(true, 3600, 'question')
			->execute();
                
                $optionQuizzCollection = array(
                       'questions' => $this->questions,
                       'multi' => $this->poll['type'],
                       'points' => $this->poll['type'],  
                );
                      if ($this->poll['self_answers'])
                      {
                       for($i=0;$i<count($this->questions);$i++)
                        $optionQuizzCollection['self'.$i] = "self";
                      }
                
                if ($this->poll['demographic'])
                {
                    $this->demographicForm = new demogrphicForm();

                    if ($request->hasParameter('demographic'))
                    {
                            $this->demographicForm->bind($request->getParameter('demographic'));

                            if ($this->demographicForm->isValid())
                            {
                                var_dump($this->demographicForm->getValue('age'));
                                var_dump($this->demographicForm->getValue('sex'));

                            }   
                    }
                }
                $this->quizzCollectionForm = new quizzCollectionForm(null, $optionQuizzCollection);
                
		if ($request->hasParameter('quizzCollection'))
		{
			$this->quizzCollectionForm->bind($request->getParameter('quizzCollection'));
                        
			if ($this->quizzCollectionForm->isValid())
			{
				if ($this->user->UsersAnswers->count() == 0)
				{
                                
                                    $requestQuizzCollection = $request->getParameter('quizzCollection');
                                    for($i=0;$i<count($requestQuizzCollection)-1;$i++)
                                    {
                                        foreach($requestQuizzCollection[$i]['answers'] as $answers)
                                        {
                                            $userAnswer = explode('___', $answers);
                                            $last = count($userAnswer)-1;
                                            $answer = new UsersAnswers();
                                            $answer->fromArray(array(
                                                    'user_id' => $this->user['id'],
                                                    'question_id' => $userAnswer[0],
                                                    'points' => $userAnswer[$last]
                                            ));
                                            if ($userAnswer[1] != 'null')
                                                $answer['answer_id'] = $userAnswer[1];
                                            else
                                                $answer['answer_text'] = $request->getParameter('self'.$i);
                                            $answer->save();
                                        }
                                    }
                                    
//					$this->getUser()->setFlash('answers', $answers);
//					$this->redirect(url_for2('default_index', array('module' => 'quizResult'), true));
				}
			}
		}

	}
}
