<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('QuestionsAnswers', 'doctrine');

/**
 * BaseQuestionsAnswers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $question_id
 * @property string $value
 * @property timestamp $created_at
 * @property Questions $Questions
 * @property Doctrine_Collection $UsersAnswers
 * 
 * @method integer             getId()           Returns the current record's "id" value
 * @method integer             getQuestionId()   Returns the current record's "question_id" value
 * @method string              getValue()        Returns the current record's "value" value
 * @method timestamp           getCreatedAt()    Returns the current record's "created_at" value
 * @method Questions           getQuestions()    Returns the current record's "Questions" value
 * @method Doctrine_Collection getUsersAnswers() Returns the current record's "UsersAnswers" collection
 * @method QuestionsAnswers    setId()           Sets the current record's "id" value
 * @method QuestionsAnswers    setQuestionId()   Sets the current record's "question_id" value
 * @method QuestionsAnswers    setValue()        Sets the current record's "value" value
 * @method QuestionsAnswers    setCreatedAt()    Sets the current record's "created_at" value
 * @method QuestionsAnswers    setQuestions()    Sets the current record's "Questions" value
 * @method QuestionsAnswers    setUsersAnswers() Sets the current record's "UsersAnswers" collection
 * 
 * @package    ibum
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQuestionsAnswers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('questions_answers');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('question_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Questions', array(
             'local' => 'question_id',
             'foreign' => 'id'));

        $this->hasMany('UsersAnswers', array(
             'local' => 'id',
             'foreign' => 'answer_id'));
    }
}