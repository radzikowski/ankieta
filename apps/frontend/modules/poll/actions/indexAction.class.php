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
                $this->poll = PollTable::getInstance()->findOneByName($this->request->getParameter('name'));
                
                if (!$this->poll)
                    $this->redirect(url_for2('default', array('module' => 'result', 'action' => 'index'), true));
            
		$this->questions = Doctrine_Query::create()
			->select('q.*, qa.*')
			->from('Questions q')
			->leftJoin('q.QuestionsAnswers qa')
                        ->where('q.poll_id =? ',$this->poll['id'])
			//->useResultCache(true, 3600, 'question')
			->execute();
		$this->quizzCollectionForm = new quizzCollectionForm(null, array(
                       'questions' => $this->questions,
                       'multi' => $this->poll['type'],
                       'points' => $this->poll['type']
                ));
                
		if ($request->hasParameter('quizzCollection'))
		{
			$this->quizzCollectionForm->bind($request->getParameter('quizzCollection'));
                        echo "<pre>";
                        print_r($request->getParameter('quizzCollection'));
                        echo "</pre>";
                                    
			if ($this->quizzCollectionForm->isValid())
			{
				if ($this->user->UsersAnswers->count() == 0)
				{
                                    echo "<pre>";
                                    print_r($this->quizzCollectionForm->getValues());
                                    echo "</pre>";
                                    
					foreach($this->quizzCollectionForm->getValues() as $question)
					{
                                            
                                            
                                            //foreach($question['answers'] as $answers)
                                           {
                                            echo $question['answers'];
/*						$userAnswer = explode('___', $answers);
                                                $last = count($userAnswer);
						$answer = new UsersAnswers();
						$answer->fromArray(array(
							'user_id' => $this->user['id'],
							'question_id' => $userAnswer[0],
							'answer_id' => $userAnswer[1],
							'points' => $userAnswer[$last+1]
						));
						$answer->save();
						//$answers[] =  $userAnswer[2];
						$userAnswer = array();
                                                var_dump($last.': '.$userAnswer[$last]);
 */                                           }
					}
                                        
//					$this->getUser()->setFlash('answers', $answers);
//					$this->redirect(url_for2('default_index', array('module' => 'quizResult'), true));
				}
			}
                        var_dump('wyslal formularz');
		}

	}
}
