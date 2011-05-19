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
		$this->result = Doctrine_Query::create()
                        ->select('ua.*, qa.*, q.*')
                        ->from('Questions q')
                        ->leftJoin('q.QuestionsAnswers qa')
                        ->leftJoin('qa.UsersAnswers ua')
                        //->leftJoin('ua.Questions q')
                       // ->leftJoin('ua.QuestionsAnswers qa')
                        //->leftJoin('qa.UsersAnswers ua')
                        ->orderBy('ua.answer_id')
                        //->groupBy('u.id')
                        ->execute();
               
                $this->selfAnswer = Doctrine_Query::create()
                        ->select('ua.*, q.*')
                        ->from('Questions q')
                        ->leftJoin('q.UsersAnswers ua')
                        //->from('UsersAnswers ua')
                        //->leftJoin('ua.Questions q')
                        ->where('ua.answer_id is NULL')
               //         ->groupBy('ua.question_id')
                        ->execute();
                
                
                //var_dump(count($this->selfAnswer[1]['UsersAnswers']));
                //foreach($this->selfAnswer[0]['UsersAnswers'] as $answer)
                {
                //    echo $answer['answer_text'];
                }
                 //echo "<pre>";
                 //print_r($this->selfAnswer[0]['UsersAnswers']->toArray());
                 //echo "</pre>";
                 
                //foreach($this->result['UsersAnswers'] as $test){
                    //echo 'liczba odpowiedzi: '.count($this->result[0]);
                    //echo '<br>'.$this->result['UsersAnswers']['QuestionsAnswers'].'<br>';
                   // echo '<br>odpowiedz: '.$this->result[0]['Questions'][0]['QuestionsAnswers'][0]['UsersAnswers']['value'];
                //echo "<pre>";
                //print_r($this->result->toArray());
                //echo "</pre>";
                //}
//        var_dump($this->result[0]['Questions'][0]['UsersAnswers'][1]['QuestionsAnswers']['value']);
	}
}
