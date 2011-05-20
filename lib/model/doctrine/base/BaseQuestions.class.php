<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Questions', 'doctrine');

/**
 * BaseQuestions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $poll_id
 * @property string $question
 * @property timestamp $created_at
 * @property Poll $Poll
 * @property Doctrine_Collection $BestAnswers
 * @property Doctrine_Collection $QuestionsAnswers
 * @property Doctrine_Collection $UsersAnswers
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getPollId()           Returns the current record's "poll_id" value
 * @method string              getQuestion()         Returns the current record's "question" value
 * @method timestamp           getCreatedAt()        Returns the current record's "created_at" value
 * @method Poll                getPoll()             Returns the current record's "Poll" value
 * @method Doctrine_Collection getBestAnswers()      Returns the current record's "BestAnswers" collection
 * @method Doctrine_Collection getQuestionsAnswers() Returns the current record's "QuestionsAnswers" collection
 * @method Doctrine_Collection getUsersAnswers()     Returns the current record's "UsersAnswers" collection
 * @method Questions           setId()               Sets the current record's "id" value
 * @method Questions           setPollId()           Sets the current record's "poll_id" value
 * @method Questions           setQuestion()         Sets the current record's "question" value
 * @method Questions           setCreatedAt()        Sets the current record's "created_at" value
 * @method Questions           setPoll()             Sets the current record's "Poll" value
 * @method Questions           setBestAnswers()      Sets the current record's "BestAnswers" collection
 * @method Questions           setQuestionsAnswers() Sets the current record's "QuestionsAnswers" collection
 * @method Questions           setUsersAnswers()     Sets the current record's "UsersAnswers" collection
 * 
 * @package    ibum
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseQuestions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('questions');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('poll_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('question', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
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
        $this->hasOne('Poll', array(
             'local' => 'poll_id',
             'foreign' => 'id'));

        $this->hasMany('BestAnswers', array(
             'local' => 'id',
             'foreign' => 'question_id'));

        $this->hasMany('QuestionsAnswers', array(
             'local' => 'id',
             'foreign' => 'question_id'));

        $this->hasMany('UsersAnswers', array(
             'local' => 'id',
             'foreign' => 'question_id'));
    }
}